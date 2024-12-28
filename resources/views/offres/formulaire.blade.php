<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche d'offres</title>
</head>
<body>
    <h1>Recherche d'offres par adresse</h1>
    <form method="POST" action="{{ route('offres.adresse') }}">
    @csrf
    <label for="code_postal">Code Postal :</label>
    <input type="text" name="code_postal" id="code_postal" required><br>

    <label for="ville">Ville :</label>
    <input type="text" name="ville" id="ville" required><br>

    <label for="rue">Rue :</label>
    <input type="text" name="rue" id="rue" required><br>

    <label for="voie">N° de Voie :</label>
    <input type="text" name="voie" id="voie" required><br>

    <button type="submit">Rechercher</button>
</form>

</body>
</html>
