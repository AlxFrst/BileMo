<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    private $client;
    private $token;

    public function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost:8000', // Assurez-vous de mettre l'URL correcte
            'http_errors' => false
        ]);

        // Authentification pour obtenir le token JWT
        $response = $this->client->post('/api/auth/login_check', [
            'json' => [
                'username' => 'user@bilemo0.com', // Remplacez par des informations d'identification valides
                'password' => 'sdqqfdsrfser'
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        $this->token = $data['token'] ?? null;
    }

    public function testGetProductList()
    {
        $response = $this->client->get('/api/smartphones', [
            'headers' => ['Authorization' => "Bearer {$this->token}"]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertNotEmpty($data);
    }

    public function testGetProductDetails()
    {
        // Récupérer la liste des produits pour obtenir un ID dynamique
        $listResponse = $this->client->get('/api/smartphones', [
            'headers' => ['Authorization' => "Bearer {$this->token}"]
        ]);
        $listData = json_decode($listResponse->getBody(), true);
        $this->assertNotEmpty($listData);

        $firstProductUuid = $listData['hydra:member'][0]['uuid'];

        // Utiliser l'ID récupéré pour le détail du produit
        $response = $this->client->get("/api/smartphones/{$firstProductUuid}", [
            'headers' => ['Authorization' => "Bearer {$this->token}"]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        print_r($data); // Ajout de l'affichage de la réponse pour diagnostic
        $this->assertArrayHasKey('name', $data);
    }

    public function testGetCustomerList()
    {
        $response = $this->client->get('/api/customers', [
            'headers' => ['Authorization' => "Bearer {$this->token}"]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertNotEmpty($data);
    }

    public function testGetCustomerDetails()
    {
        // Récupérer la liste des clients pour obtenir un ID dynamique
        $listResponse = $this->client->get('/api/customers', [
            'headers' => ['Authorization' => "Bearer {$this->token}"]
        ]);
        $listData = json_decode($listResponse->getBody(), true);
        $this->assertNotEmpty($listData);

        $firstCustomerUuid = $listData['hydra:member'][0]['@id'];
        $firstCustomerUuid = str_replace('/api/customers/', '', $firstCustomerUuid); // Extraire uniquement l'UUID

        // Utiliser l'ID récupéré pour le détail du client
        $response = $this->client->get("/api/customers/{$firstCustomerUuid}", [
            'headers' => ['Authorization' => "Bearer {$this->token}"]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        print_r($data); // Ajout de l'affichage de la réponse pour diagnostic
        $this->assertArrayHasKey('lastName', $data);
    }

}
