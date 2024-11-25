@extends('navbar')

@section('title', 'Nouveau Paiement')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0"><i class="fas fa-plus-circle"></i> Nouveau Paiement</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('paiements.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="commande_id" class="form-label">Commande</label>
                                <select class="form-select @error('commande_id') is-invalid @enderror" id="commande_id" name="commande_id" required>
                                    <option value="">Sélectionnez une commande</option>
                                    @foreach($commandes as $commande)
                                        <option value="{{ $commande->id }}" {{ old('commande_id') == $commande->id ? 'selected' : '' }}>
                                            {{ $commande->id }} - {{ $commande->client->nom }} {{ $commande->client->prenom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('commande_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="montant" class="form-label">Montant</label>
                                <div class="input-group">
                                    <span class="input-group-text">€</span>
                                    <input type="number" step="0.01" class="form-control @error('montant') is-invalid @enderror" id="montant" name="montant" value="{{ old('montant') }}" required>
                                </div>
                                @error('montant')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <a href="{{ route('paiements.index') }}" class="btn btn-secondary">Annuler</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Enregistrer le paiement
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
