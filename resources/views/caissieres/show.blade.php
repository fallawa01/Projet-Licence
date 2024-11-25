@extends('navbar')

@section('content')
    <div class="container">
        <h1>Détails de la commande #{{ $commande->id }}</h1>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Informations de la commande</h5>
                <p><strong>Client:</strong> {{ $commande->client->name }}</p>
                <p><strong>Burger:</strong> {{ $commande->burger->nom }}</p>
                <p><strong>Date:</strong> {{ $commande->date_commande }}</p>
                <p><strong>État:</strong> {{ $commande->etat }}</p>
                <p><strong>Montant:</strong> {{ $commande->montant }} €</p>
                <p><strong>Instructions:</strong> {{ $commande->instructions ?: 'Aucune' }}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Mise à jour de l'état</h5>
                <form action="{{ route('caissieres.update-status', $commande) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <select name="etat" class="form-control">
                            <option value="en_cours" {{ $commande->etat == 'en_cours' ? 'selected' : '' }}>En cours</option>
                            <option value="terminee" {{ $commande->etat == 'terminee' ? 'selected' : '' }}>Terminée</option>
                            <option value="annulee" {{ $commande->etat == 'annulee' ? 'selected' : '' }}>Annulée</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Mettre à jour l'état</button>
                </form>
            </div>
        </div>

        @if($commande->etat == 'terminee' && !$commande->paiement)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Enregistrer le paiement</h5>
                    <form action="{{ route('caissieres.enregistrer-paiement', $commande) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="montant">Montant payé</label>
                            <input type="number" name="montant" id="montant" class="form-control" value="{{ $commande->montant }}" step="0.01" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Enregistrer le paiement</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
