<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

final class ApiEndpointsTest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'http://api/',
            'http_errors' => false,
            'timeout' => 10
        ]);
    }

    public function testGetTicketsEndpoint(): void
    {
        try {
            $response = $this->client->get('get_tickets.php');
            
            $this->assertEquals(200, $response->getStatusCode(), 
                'Expected HTTP 200, got ' . $response->getStatusCode() . ' ' . (string)$response->getBody());
            
            $contentType = $response->getHeader('Content-Type');
            $this->assertStringContainsString('application/json', implode(', ', $contentType));
            
            $data = json_decode((string)$response->getBody(), true);
            $this->assertIsArray($data, 'Response body should be valid JSON array');
        } catch (RequestException $e) {
            $this->markTestSkipped('API not available: ' . $e->getMessage());
        }
    }

    public function testAddTicketEndpoint(): void
    {
        try {
            $response = $this->client->post('add_ticket.php', [
                'form_params' => [
                    'title' => 'Test Ticket',
                    'description' => 'Test Description'
                ]
            ]);
            
            $this->assertGreaterThanOrEqual(200, $response->getStatusCode());
            $this->assertLessThan(400, $response->getStatusCode(), 
                'Expected success status, got ' . $response->getStatusCode());
        } catch (RequestException $e) {
            $this->markTestSkipped('API not available: ' . $e->getMessage());
        }
    }

    public function testIndexPageLoads(): void
    {
        try {
            $response = $this->client->get('index.php');
            
            $this->assertEquals(200, $response->getStatusCode());
            $body = (string)$response->getBody();
            $this->assertStringContainsString('Ticket Control System', $body);
        } catch (RequestException $e) {
            $this->markTestSkipped('API not available: ' . $e->getMessage());
        }
    }
}
