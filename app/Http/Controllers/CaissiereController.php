<?php

namespace App\Http\Controllers;

use App\Mail\FactureEmail;
use App\Models\Commande;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class CaissiereController extends Controller
{
    public function index()
    {
        $commandes = Commande::with(['client', 'burger'])
            ->orderBy('date_commande', 'desc')
            ->paginate(10);
        return view('caissieres.index', compact('commandes'));
    }

    public function show(Commande $commande)
    {
        return view('caissieres.show', compact('commande'));
    }

    public function updateStatus(Request $request, Commande $commande)
    {
        $request->validate([
            'etat' => 'required|in:en_cours,terminee,annulee',
        ]);

        $commande->etat = $request->etat;
        $commande->save();

        if ($request->etat == 'terminee') {
            // Envoyer l'email avec la facture
            $this->envoyerFacture($commande);
        }

        return redirect()->route('caissieres.show', $commande)
            ->with('success', "L'état de la commande a été mis à jour.");
    }

    public function enregistrerPaiement(Request $request, Commande $commande)
    {
        $request->validate([
            'montant' => 'required|numeric|min:0',
        ]);

        $paiement = new Paiement();
        $paiement->commande_id = $commande->id;
        $paiement->montant = $request->montant;
        $paiement->date_paiement = now();
        $paiement->save();

        $commande->etat = 'payee';
        $commande->save();

        return redirect()->route('caissieres.show', $commande)
            ->with('success', 'Le paiement a été enregistré avec succès.');
    }

    public function recherche(Request $request)
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

        $commandes = $query->with(['client', 'burger'])->paginate(10);

        return view('caissieres.index', compact('commandes'));
    }

    private function envoyerFacture(Commande $commande)
    {
        // Générer le PDF
        $pdf = Pdf::loadView('emails.commande', ['commande' => $commande]);
        $pdfContent = $pdf->output();

        // Envoyer l'email avec le PDF en pièce jointe
        Mail::to($commande->client->email)->send(new FactureEmail($commande, $pdfContent));
    }
}
