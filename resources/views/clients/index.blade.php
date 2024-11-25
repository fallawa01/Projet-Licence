@extends('navbar')

@section('title', 'Liste des Clients')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1><i class="fas fa-users"></i> Liste des Clients</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('clients.create') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Ajouter un client
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->nom }}</td>
                                <td>{{ $client->prenom }}</td>
                                <td>{{ $client->telephone }}</td>
                                <td>{{ $client->email }}</td>
                                <td>
                                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client?')">
                                            <i class="fas fa-trash"></i> Supprimer
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
            {{ $clients->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Add any JavaScript here
    </script>
@endsection
