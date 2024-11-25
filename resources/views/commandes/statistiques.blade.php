@extends('navbar')

@section('title', 'Statistiques')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1><i class="fas fa-chart-bar"></i> Statistiques du Jour</h1>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h4>Commandes en cours de la journée</h4>
                        <p class="fs-4">{{ $commandesEnCours }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h4>Commandes Validées</h4>
                        <p class="fs-4">{{ $commandesValidees }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h4>Recettes Journalières</h4>
                        <p class="fs-4"> €</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h4>Commandes Annulées</h4>
                        <p class="fs-4">{{ $commandesAnnulees }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
