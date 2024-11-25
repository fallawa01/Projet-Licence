@extends('navbar')

@section('title', 'Liste des Burgers')

@section('content')
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Liste des Produits</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('burgers.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ajouter un produit
            </a>
        </div>
    </div>

    <div class="row">
        @foreach ($burgers as $burger)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <img src="{{ asset('storage/images/burgers/' . $burger->image) }}" class="card-img-top" alt="{{ $burger->nom }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $burger->nom }}</h5>
                        <p class="card-text">{{ Str::limit($burger->description, 100) }}</p>
                        <p class="card-text"><strong>Prix:</strong> {{ number_format($burger->prix, 2) }} €</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="{{ route('burgers.edit', $burger->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('burgers.destroy', $burger->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce burger?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $burgers->links() }}
    </div>
@endsection
