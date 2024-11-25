<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Commande;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with('commande')->orderBy('date_paiement', 'desc')->paginate(10);
        return view('paiements.index', ['paiements' => $paiements]);
    }

    public function create()
    {
        $paiement = new Paiement();
        $commandes = Commande::where('etat', 'terminee')->get();
        return view('paiements.create', ['paiement' => $paiement, 'commandes' => $commandes]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'commande_id' => 'required|exists:commandes,id',
            'montant' => 'required|numeric',
        ]);

        $paiement = new Paiement();
        $paiement->commande_id = $request->commande_id;
        $paiement->montant = $request->montant;
        $paiement->date_paiement = now();
        $paiement->save();

        $commande = Commande::find($request->commande_id);
        $commande->etat = 'payee';
        $commande->save();

        return redirect()->route('paiements.index')->with('success', 'Paiement enregistré avec succès');
    }

    public function show(string $id)
    {
        $paiement = Paiement::with('commande')->findOrFail($id);
        return view('paiements.show', ['paiement' => $paiement]);
    }

    // Les méthodes edit, update, et destroy ne sont généralement pas nécessaires pour les paiements,
    // car ils ne devraient pas être modifiés ou supprimés une fois créés.
}
