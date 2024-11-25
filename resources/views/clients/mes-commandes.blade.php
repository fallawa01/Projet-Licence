@extends('navbar')

@section('content')
    <div class="container">
        <h1>Mes commandes</h1>
        @foreach ($commandes as $commande)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $commande->burger->nom }}</h5>
                    <p class="card-text">Date de commande: {{ $commande->date_commande }}</p>
                    <p class="card-text">État: {{ $commande->etat }}</p>
                    <p class="card-text">Quantité: {{ $commande->quantite }}</p>
                    <p class="card-text">Montant: {{ $commande->montant }} €</p>
                    <a href="{{ route('clients.detail-commande', $commande) }}" class="btn btn-primary">Voir les détails</a>
                </div>
            </div>
        @endforeach
        {{ $commandes->links() }}
    </div>
@endsection
