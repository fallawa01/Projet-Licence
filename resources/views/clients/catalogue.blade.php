@extends('navbar')

@section('content')
    <div class="container">
        <h1>Catalogue des produits</h1>
        <div class="row">
            @foreach ($burgers as $burger)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/images/burgers/' . $burger->image) }}" class="card-img-top" alt="{{ $burger->nom }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $burger->nom }}</h5>
                            <p class="card-text">{{ $burger->description }}</p>
                            <p class="card-text"><strong>Prix: {{ $burger->prix }} €</strong></p>
                            <a href="{{ route('clients.commander', $burger) }}" class="btn btn-primary">Commander</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $burgers->links() }}
    </div>
@endsection

