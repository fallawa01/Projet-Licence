@extends('navbar')

@section('content')
    <div class="container">
        <h1>Gestion des Commandes</h1>

        <form action="{{ route('caissiere.recherche') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <input type="date" name="date" class="form-control" placeholder="Date">
                </div>
                <div class="col-md-3">
                    <select name="etat" class="form-control">
                        <option value="">Tous les états</option>
                        <option value="en_cours">En cours</option>
                        <option value="terminee">Terminée</option>
                        <option value="payee">Payée</option>
                        <option value="annulee">Annulée</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" name="client_id" class="form-control" placeholder="ID Client">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </div>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Article</th>
                <th>Date</th>
                <th>État</th>
                <th>Montant</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($commandes as $commande)
                <tr>
                    <td>{{ $commande->id }}</td>
                    <td>{{ $commande->client->name }}</td>
                    <td>{{ $commande->burger->nom }}</td>
                    <td>{{ $commande->date_commande }}</td>
                    <td>{{ $commande->etat }}</td>
                    <td>{{ $commande->montant }} €</td>
                    <td>
                        <a href="{{ route('caissieres.show', $commande) }}" class="btn btn-sm btn-info">Détails</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $commandes->links() }}
    </div>
@endsection
