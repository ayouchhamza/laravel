<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class OffreController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Affiche le formulaire de recherche.
     */
    public function showForm()
    {
        return view('offres.formulaire');
    }

    /**
     * Traite la recherche d'offres et affiche les résultats.
     */
    public function search(Request $request)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'code_postal' => 'required|string|max:10',
            'ville' => 'required|string|max:100',
            'rue' => 'required|string|max:255',
            'voie' => 'required|string|max:10',
        ]);

        // Log des données envoyées
        \Log::info('Payload envoyé à l\'API :', $validated);

        // Appel à l'API via ApiService
        $response = $this->apiService->post('/adresse/recherche', $validated);

        // Log de la réponse API
        \Log::info('Réponse de l\'API :', $response);

        // Vérifier si l'API retourne une erreur
        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        // Retourner les résultats à la vue
        return view('offres.resultats', ['results' => $response['data'] ?? []]);
    }

    /**
     * Récupère les détails d'un pays à partir de son code alpha-2.
     */
    public function getCountryDetails($iso_alpha2)
    {
        // Appel à l'API pour obtenir les détails du pays
        $response = $this->apiService->get('/endpoint/country', [
            'iso_alpha2' => $iso_alpha2,
        ]);

        // Log de la réponse API
        \Log::info('Réponse API pour le pays :', $response);

        // Vérifier si l'API retourne une erreur
        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        // Retourner les données du pays à la vue
        return view('offres.resultats', ['country' => $response]);
    }
}
