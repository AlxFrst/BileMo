<?php

// tests/ApiTest.php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTest extends WebTestCase
{
    private $token;

    protected function setUp(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/auth/login_check', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'username' => 'user@bilemo0.com',
            'password' => 'sdqqfdsrfser',
        ]));
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->token = $data['token'];
    }

    public function testLogin()
    {
        $client = static::createClient();
        $client->request('POST', '/api/auth/login_check', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'username' => 'user@bilemo0.com',
            'password' => 'sdqqfdsrfser',
        ]));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('token', $data);
    }

    public function testGetCustomers()
    {
        $client = static::createClient();
        $client->request('GET', '/api/customers', [], [], [
            'HTTP_AUTHORIZATION' => 'Bearer ' . $this->token,
        ]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('hydra:member', $data);
    }

    public function testAddCustomer()
    {
        $client = static::createClient();
        $client->request('POST', '/api/customers', [], [], [
            'HTTP_AUTHORIZATION' => 'Bearer ' . $this->token,
            'CONTENT_TYPE' => 'application/ld+json',
        ], json_encode([
            'lastName' => 'Doe',
            'firstName' => 'John',
            'facturationAddress' => '123 Main St',
            'email' => 'john.doe@example.com'
        ]));

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('uuid', $data);
    }

    public function testDeleteCustomer()
    {
        $client = static::createClient();
        // Ajoutez un client pour ensuite le supprimer
        $client->request('POST', '/api/customers', [], [], [
            'HTTP_AUTHORIZATION' => 'Bearer ' . $this->token,
            'CONTENT_TYPE' => 'application/ld+json',
        ], json_encode([
            'lastName' => 'Doe',
            'firstName' => 'Jane',
            'facturationAddress' => '456 Main St',
            'email' => 'jane.doe@example.com'
        ]));

        $data = json_decode($client->getResponse()->getContent(), true);
        $customerId = $data['uuid'];

        // Supprimez le client
        $client->request('DELETE', '/api/customers/' . $customerId, [], [], [
            'HTTP_AUTHORIZATION' => 'Bearer ' . $this->token,
        ]);

        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }

    public function testGetSmartphones()
    {
        $client = static::createClient();
        $client->request('GET', '/api/smartphones');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('hydra:member', $data);
    }
}
