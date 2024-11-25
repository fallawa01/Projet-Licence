<?php

namespace App\Http\Controllers;

use App\Mail\FactureEmail;
use App\Models\Commande;
use App\Models\User; // Remplace Client par User
use App\Models\Burger;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with(['client', 'burger'])->orderBy('date_commande', 'desc')->paginate(10);
        return view('commandes.index', ['commandes' => $commandes]);
    }

    public function create()
    {
        $commande = new Commande();
        $clients = User::where('role', 'client')->get(); // Récupère les utilisateurs ayant le rôle "client"
        $burgers = Burger::where('statut', 'actif')->get();
        return view('commandes.create', ['commande' => $commande, 'clients' => $clients, 'burgers' => $burgers]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:users,id',
            'burger_id' => 'required|exists:burgers,id',
        ]);

        $commande = new Commande();
        $commande->client_id = $request->client_id;
        $commande->burger_id = $request->burger_id;
        $commande->date_commande = now();
        $commande->save();

        return redirect()->route('commandes.index')->with('success', 'Commande créée avec succès');
    }

    public function edit(string $id)
    {
        $commande = Commande::findOrFail($id);
        $clients = User::where('role', 'client')->get();
        $burgers = Burger::where('statut', 'actif')->get();
        return view('commandes.edit', ['commande' => $commande, 'clients' => $clients, 'burgers' => $burgers]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:users,id',
            'burger_id' => 'required|exists:burgers,id',
            'etat' => 'required|in:en_cours,terminee,payee,annulee',
        ]);

        $commande = Commande::findOrFail($id);
        $commande->client_id = $request->client_id;
        $commande->burger_id = $request->burger_id;
        $commande->etat = $request->etat;
        $commande->save();

        if ($request->etat == 'terminee') {
            $this->envoyerFacture($commande);
        }

        return redirect()->route('commandes.index')->with('success', 'Commande mise à jour avec succès');
    }

    public function destroy(string $id)
    {
        $commande = Commande::findOrFail($id);
        $commande->delete();
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès');
    }

    private function envoyerFacture(Commande $commande)
    {
        $pdf = Pdf::loadView('emails.commande', ['commande' => $commande]);
        $pdfContent = $pdf->output();

        Mail::to($commande->client->email)->send(new FactureEmail($commande, $pdfContent));
    }

    public function filtrer(Request $request)
    {
        $query = Commande::query();

        if ($request->has('burger_id')) {
            $query->where('burger_id', $request->burger_id);
        }

        if ($request->has('date')) {
            $query->whereDate('date_commande', $request->date);
        }

        if ($request->has('etat')) {
            $query->where('etat', $request->etat);
        }

        if ($request->has('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        $commandes = $query->paginate(10);
        return view('commandes.index', ['commandes' => $commandes]);
    }

    public function statistiques()
    {
        $today = now()->toDateString();

        $commandesEnCours = Commande::where('etat', 'en_cours')->whereDate('date_commande', $today)->count();
        $commandesValidees = Commande::where('etat', 'terminee')->whereDate('date_commande', $today)->count();
        $commandesAnnulees = Commande::where('etat', 'annulee')->whereDate('date_commande', $today)->count();

        return view('commandes.statistiques', [
            'commandesEnCours' => $commandesEnCours,
            'commandesValidees' => $commandesValidees,
            'commandesAnnulees' => $commandesAnnulees,
        ]);
    }
}
