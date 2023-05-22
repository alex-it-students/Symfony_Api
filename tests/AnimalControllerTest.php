<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AnimalControllerTest extends WebTestCase
{

    // Méthode pour vérifier l'intégrité du fichier JSON
    public function assertJsonData($responseData)
    {
        // Vérifie que Name est bien une chaîne de caractères
        $this->assertIsString(json_decode($responseData, true)[0]['Name']);
        // Vérifie que AverageSize est bien un nombre
        $this->assertIsNumeric(json_decode($responseData, true)[0]['AverageSize']);
        // Vérifie que AverageLifeExpectancy est bien un nombre
        $this->assertIsNumeric(json_decode($responseData, true)[0]['AverageLifeExpectancy']);
        // Vérifie que PhoneNumber est bien une chaîne de caractères
        $this->assertIsString(json_decode($responseData, true)[0]['PhoneNumber']);
        // Vérifie que MartialArt est bien une chaîne de caractères
        $this->assertIsString(json_decode($responseData, true)[0]['MartialArt']);
        // Vérifie que Country est bien un tableau
        $this->assertIsArray(json_decode($responseData, true)[0]['Country']);
    }
    public function testGetAnimals()
    {
        $client = static::createClient();

        // Envoie une requête GET à l'URL de l'API pour récupérer les animaux
        $client->request('GET', '/animal/');
        // Vérifie le code de réponse attendu
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        // Vérifie que la réponse contient des données
        $this->assertNotEmpty($client->getResponse()->getContent());
        // Vérifie que la réponse est bien du JSON
        $this->assertJson($client->getResponse()->getContent());
        // Vérifie que la réponse contient bien un tableau d'animaux
        $this->assertArrayHasKey('Name', json_decode($client->getResponse()->getContent(), true)[0]);

        // Vérifie l'intégrité du fichier JSON
        $this->assertJsonData($client->getResponse()->getContent());
    }

    // Méthode pour tester la récupération d'un animal
    public function testGetAnimal()
    {
        $client = static::createClient();

        // Envoie une requête GET à l'URL de l'API pour récupérer un animal
        $client->request('GET', '/animal/1');
        // Vérifie le code de réponse attendu
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        // Vérifie que la réponse contient des données (animal)
        $this->assertNotEmpty($client->getResponse()->getContent());
        // Vérifie que la réponse est bien du JSON
        $this->assertJson($client->getResponse()->getContent());
        // Vérifie que la réponse contient bien un animal
        $this->assertArrayHasKey('Name', json_decode($client->getResponse()->getContent(), true));

        // Vérifie l'intégrité du fichier JSON
        $this->assertJsonData($client->getResponse()->getContent());
    }

    public function testCreateAnimal()
    {
        $client = static::createClient();

        // Envoie une requête POST à l'URL de l'API pour créer un animal
        $client->request('POST', '/animal/new', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{
                "Name": "Test",
                "Country": {
                    "id": 260,
                    "name": "Egypte",
                    "isoCode": "BG"
                },
                "AverageSize": 1,
                "AverageLifeExpectancy": 1,
                "PhoneNumber": "0123456789",
                "MartialArt": "Test"
            }'
        );
        // Vérifie le code de réponse attendu
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        // Vérifie que la réponse contient des données (animal)
        $this->assertNotEmpty($client->getResponse()->getContent());
        // Vérifie que la réponse est bien du JSON
        $this->assertJson($client->getResponse()->getContent());
        // Vérifie que la réponse contient bien un animal
        $this->assertArrayHasKey('Name', json_decode($client->getResponse()->getContent(), true));

        // Vérifie l'intégrité du fichier JSON
        $this->assertJsonData($client->getResponse()->getContent());
    }

    public function testEditAnimal()
    {
        // Création d'un client pour pouvoir faire des requêtes
        $client = static::createClient();

        // Envoie une requête PUT à l'URL de l'API pour modifier un animal
        $client->request('PATCH', '/animal/1/edit', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{
                "Name": "Test",
                "Country": {
                    "id": 260,
                    "name": "Egypte",
                    "isoCode": "BG"
                },
                "AverageSize": 1,
                "AverageLifeExpectancy": 1,
                "PhoneNumber": "0123456789",
                "MartialArt": "Test"
            }'
        );
        // Vérifie le code de réponse attendu
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        // Vérifie que la réponse contient des données (animal)
        $this->assertNotEmpty($client->getResponse()->getContent());
        // Vérifie que la réponse est bien du JSON
        $this->assertJson($client->getResponse()->getContent());
        // Vérifie que la réponse contient bien un animal
        $this->assertArrayHasKey('Name', json_decode($client->getResponse()->getContent(), true));

        // Vérifie l'intégrité du fichier JSON
        $this->assertJsonData($client->getResponse()->getContent());
    }

    public function testDeleteAnimal()
    {
        // Création d'un client pour pouvoir faire des requêtes
        $client = static::createClient();

        // Envoie une requête DELETE à l'URL de l'API pour supprimer un animal
        $client->request('DELETE', '/animal/1/delete');
        // Vérifie le code de réponse attendu
        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }
}
