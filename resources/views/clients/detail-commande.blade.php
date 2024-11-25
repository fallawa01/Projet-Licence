@extends('navbar')

@section('content')
    <div class="container">
        <h1>Détails de la commande</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $commande->burger->nom }}</h5>
                <p class="card-text">Date de commande: {{ $commande->date_commande }}</p>
                <p class="card-text">État: {{ $commande->etat }}</p>
                <p class="card-text">Quantité: {{ $commande->quantite }}</p>
                <p class="card-text">Montant: {{ $commande->montant }} €</p>
            </div>
        </div>
    </div>
@endsection
