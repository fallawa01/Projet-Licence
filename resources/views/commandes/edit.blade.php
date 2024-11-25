@extends('navbar')

@section('title', 'Modifier la Commande')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0"><i class="fas fa-edit"></i> Modifier la Commande #{{ $commande->id }}</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('commandes.update', $commande->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="client_id" class="form-label">Client</label>
                                <select class="form-select @error('client_id') is-invalid @enderror" id="client_id" name="client_id" required>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ old('client_id', $commande->client_id) == $client->id ? 'selected' : '' }}>
                                            {{ $client->nom }} {{ $client->prenom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('client_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="burger_id" class="form-label">Burger</label>
                                <select class="form-select @error('burger_id') is-invalid @enderror" id="burger_id" name="burger_id" required>
                                    @foreach($burgers as $burger)
                                        <option value="{{ $burger->id }}" {{ old('burger_id', $commande->burger_id) == $burger->id ? 'selected' : '' }}>
                                            {{ $burger->nom }} - {{ number_format($burger->prix, 2) }} €
                                        </option>
                                    @endforeach
                                </select>
                                @error('burger_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="etat" class="form-label">État de la commande</label>
                                <select class="form-select @error('etat') is-invalid @enderror" id="etat" name="etat" required>
                                    <option value="en_cours" {{ old('etat', $commande->etat) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="terminee" {{ old('etat', $commande->etat) == 'terminee' ? 'selected' : '' }}>Terminée</option>
                                    <option value="payee" {{ old('etat', $commande->etat) == 'payee' ? 'selected' : '' }}>Payée</option>
                                    <option value="annulee" {{ old('etat', $commande->etat) == 'annulee' ? 'selected' : '' }}>Annulée</option>
                                </select>
                                @error('etat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <a href="{{ route('commandes.index') }}" class="btn btn-secondary">Annuler</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Mettre à jour la commande
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
