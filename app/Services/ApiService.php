<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiService
{
    protected $client;
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = env('API_BASE_URL');
        $this->token = env('API_TOKEN'); // Récupération du token depuis le fichier .env
    }

    /**
     * Effectue une requête POST vers l'API.
     *
     * @param string $endpoint
     * @param array $payload
     * @return array
     */
    public function post($endpoint, $payload = [])
    {
        return $this->request('POST', $endpoint, $payload);
    }

    /**
     * Effectue une requête GET vers l'API.
     *
     * @param string $endpoint
     * @param array $payload
     * @return array
     */
    public function get($endpoint, $payload = [])
    {
        return $this->request('GET', $endpoint, $payload);
    }

    /**
     * Effectue une requête HTTP (GET ou POST).
     *
     * @param string $method
     * @param string $endpoint
     * @param array $payload
     * @return array
     */
    private function request($method, $endpoint, $payload = [])
    {
        try {
            $options = [
                'headers' => [
                    'Authorization' => "Bearer {$this->token}", // Ajout du token dans l'entête
                ],
                'verify' => false, // Désactiver SSL pour les tests (pas recommandé en production)
            ];

            // Ajout des données JSON pour POST ou des paramètres pour GET
            if ($method === 'POST') {
                $options['json'] = $payload;
            } elseif ($method === 'GET') {
                $options['query'] = $payload;
            }

            $response = $this->client->request($method, $this->baseUrl . $endpoint, $options);

            // Retourner la réponse décodée
            return json_decode($response->getBody(), true);

        } catch (RequestException $e) {
            \Log::error('Request failed: ' . $e->getMessage());
            return ['error' => 'API request failed. Please try again later.'];
        }
    }
}
