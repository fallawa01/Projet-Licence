@extends('navbar')

@section('title', 'Détails du Paiement')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0"><i class="fas fa-credit-card"></i> Détails du Paiement</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label"><strong>ID du Paiement :</strong></label>
                            <p>{{ $paiement->id }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>ID de la Commande :</strong></label>
                            <p>{{ $paiement->commande->id }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Client :</strong></label>
                            <p>{{ $paiement->commande->client->nom }} {{ $paiement->commande->client->prenom }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Montant :</strong></label>
                            <p>{{ number_format($paiement->montant, 2) }} €</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Date de Paiement :</strong></label>
                            <p>{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('paiements.index') }}" class="btn btn-secondary">Retour</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
