@extends('navbar')

@section('content')
    <div class="container">
        <h1>Détails du Burger</h1>
        <div class="card mb-4">
            <img src="{{ asset('storage/images/burgers/' . $burger->image) }}" class="card-img-top" alt="{{ $burger->nom }}">
            <div class="card-body">
                <h5 class="card-title">{{ $burger->nom }}</h5>
                <p class="card-text">{{ $burger->description }}</p>
                <p class="card-text">Prix: {{ $burger->prix }} €</p>
            </div>
        </div>
        <a href="{{ route('client.catalogue') }}" class="btn btn-primary">Retour au catalogue</a>
    </div>
@endsection
