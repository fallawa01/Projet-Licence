<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('id', 'asc')->paginate(10);
        return view('clients.index', ['clients' => $clients]);
    }

    public function create()
    {
        $client = new Client();
        return view('clients.create', ['client' => $client]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => 'required',
            'email' => 'required|email|unique:clients',
        ]);

        $client = new Client();
        $client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->telephone = $request->telephone;
        $client->email = $request->email;
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès');
    }

    public function edit(string $id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', ['client' => $client]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => 'required',
            'email' => 'required|email|unique:clients,email,' . $id,
        ]);

        $client = Client::findOrFail($id);
        $client->nom = $request->nom;
        $client->prenom = $request->prenom;
        $client->telephone = $request->telephone;
        $client->email = $request->email;
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client modifié avec succès');
    }

    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès');
    }
}
