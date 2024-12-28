<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats</title>
</head>
<body>
    <h1>Résultats des offres</h1>

    @if(!empty($results))
        <ul>
            @foreach($results as $result)
                <li>
                    <strong>{{ $result['title'] }}</strong><br>
                    <p>{{ $result['description'] }}</p>
                    <p><strong>Prix :</strong> {{ $result['price'] }} €</p>
                </li>
            @endforeach
        </ul>
    @else
        <p>Aucune offre disponible.</p>
    @endif
</body>
</html>
