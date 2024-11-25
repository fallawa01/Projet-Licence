@extends('navbar')

@section('title', 'Liste des Commandes')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1><i class="fas fa-clipboard-list"></i> Liste des Commandes</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('commandes.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Nouvelle commande
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
                            <th>Client</th>
                            <th>Burger</th>
                            <th>État</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($commandes as $commande)
                            <tr>
                                <td>{{ $commande->id }}</td>
                                <td>{{ $commande->client->name }} {{ $commande->client->prenom }}</td>
                                <td>{{ $commande->burger->nom }}</td>
                                <td>
                                <span class="badge bg-{{ $commande->etat == 'en_cours' ? 'warning' : ($commande->etat == 'terminee' ? 'success' : ($commande->etat == 'payee' ? 'info' : 'danger')) }}">
                                    {{ ucfirst(str_replace('_', ' ', $commande->etat)) }}
                                </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette commande?')">
                                            <i class="fas fa-trash"></i> Annuler
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $commandes->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Add any JavaScript here
    </script>
@endsection
