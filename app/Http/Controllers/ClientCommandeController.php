<?php

namespace App\Http\Controllers;

use App\Models\Burger;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientCommandeController extends Controller
{


    public function catalogue()
    {
        $burgers = Burger::where('statut', 'actif')->paginate(12);
        return view('clients.catalogue', compact('burgers'));
    }

    public function commander(Burger $burger)
    {
        return view('clients.commander', compact('burger'));
    }

    public function passerCommande(Request $request)
    {
        $request->validate([
            'burger_id' => 'required|exists:burgers,id',
            'quantite' => 'required'
        ]);

        $burger = Burger::find($request->burger_id);

        $commande = new Commande();
        $commande->client_id = Auth::id();
        $commande->burger_id = $request->burger_id;
        $commande->etat = 'en_cours';
        $commande->date_commande = now();
        $commande->quantite = $request->quantite;
        $commande->montant = $burger->prix * $request->quantite;
        $commande->save();

        return redirect()->route('clients.mes-commandes')->with('success', 'Votre commande a été passée avec succès.');
    }

    public function mesCommandes()
    {
        $commandes = Auth::user()->commandes()->orderBy('date_commande', 'desc')->paginate(10);
        return view('clients.mes-commandes', compact('commandes'));
    }

    public function detailCommande(Commande $commande)
    {
        if ($commande->client_id !== Auth::id()) {
            abort(403);
        }

        return view('clients.detail-commande', compact('commande'));
    }
}
