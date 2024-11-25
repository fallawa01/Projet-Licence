@extends('navbar')

@section('title', 'Nouvelle Commande')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0"><i class="fas fa-plus-circle"></i> Nouvelle Commande</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('commandes.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="client_id" class="form-label">Client</label>
                                <select class="form-select @error('client_id') is-invalid @enderror" id="client_id" name="client_id" required>
                                    <option value="">Sélectionnez un client</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                            {{ $client->name }}
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
                                    <option value="">Sélectionnez un burger</option>
                                    @foreach($burgers as $burger)
                                        <option value="{{ $burger->id }}" {{ old('burger_id') == $burger->id ? 'selected' : '' }}>
                                            {{ $burger->nom }} - {{ number_format($burger->prix, 2) }} €
                                        </option>
                                    @endforeach
                                </select>
                                @error('burger_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <a href="{{ route('commandes.index') }}" class="btn btn-secondary">Annuler</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Enregistrer la commande
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
