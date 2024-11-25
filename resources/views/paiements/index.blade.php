@extends('navbar')

@section('title', 'Liste des Paiements')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1><i class="fas fa-credit-card"></i> Liste des Paiements</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('paiements.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Nouveau paiement
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Commande</th>
                            <th>Montant</th>
                            <th>Date de Paiement</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($paiements as $paiement)
                            <tr>
                                <td>{{ $paiement->id }}</td>
                                <td>{{ $paiement->commande->id }} - {{ $paiement->commande->client->nom }} {{ $paiement->commande->client->prenom }}</td>
                                <td>{{ number_format($paiement->montant, 2) }} €</td>
                                <td>{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('paiements.show', $paiement->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> Voir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $paiements->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Add any JavaScript here
    </script>
@endsection
