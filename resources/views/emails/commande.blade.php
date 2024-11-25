<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Facture</title>
</head>
<body>
<h1>Facture pour la commande #{{ $commande->id }}</h1>
<p><strong>Client:</strong> {{ $commande->client->nom }} {{ $commande->client->prenom }}</p>
<p><strong>Date:</strong> {{ $commande->date_commande }}</p>
<p><strong>Burger:</strong> {{ $commande->burger->nom }}</p>
<p><strong>Prix:</strong> {{ $commande->burger->prix }} €</p>
<p><strong>Total:</strong> {{ $commande->burger->prix }} €</p>
<p>Etat: {{ $commande->etat }}</p>
</body>
</html>
