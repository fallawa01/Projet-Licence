@extends('navbar')

@section('content')
    <div class="container">
        <h1>Commander {{ $burger->nom }}</h1>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/images/burgers/' . $burger->image) }}" class="img-fluid" alt="{{ $burger->nom }}">
            </div>
            <div class="col-md-6">
                <h2>{{ $burger->nom }}</h2>
                <p>{{ $burger->description }}</p>
                <p><strong>Prix: {{ $burger->prix }} €</strong></p>
                <form action="{{ route('clients.passer-commande') }}" method="POST">
                    @csrf
                    <input type="hidden" name="burger_id" value="{{ $burger->id }}">
                    <div class="form-group">
                        <label for="quantite">Quantité</label>
                        <input type="number" name="quantite" id="quantite" class="form-control" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Passer la commande</button>
                </form>
            </div>
        </div>
    </div>
@endsection
