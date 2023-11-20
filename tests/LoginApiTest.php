<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginApiTest extends WebTestCase
{
    public function testLoginCheck()
    {
        $client = static::createClient();

        $username = 'test1@test.com';
        $password = 'test1';

        $payload = [
            'username' => $username,
            'password' => $password,
        ];

        $client->request('POST', 'api/login_check', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($payload));

        $response = $client->getResponse();

        // Vérifiez le code de réponse HTTP
        // assetSame permets de vérfier que le type et la valeur des 2 valeurs passées sont identiques
        // ici que 200 == code HTTP de la réponse du point d'API
        $this->assertSame(200, $response->getStatusCode());
    }
}
