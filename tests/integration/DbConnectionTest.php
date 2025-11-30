<?php

use PHPUnit\Framework\TestCase;

final class DbConnectionTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $host = getenv('DB_HOST') ?: 'db';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASSWORD') ?: 'password';
        $db = getenv('DB_NAME') ?: 'tickets_db';

        $this->conn = new mysqli($host, $user, $pass, $db);
        
        if ($this->conn->connect_error) {
            $this->markTestSkipped('Database connection failed: ' . $this->conn->connect_error);
        }
    }

    public function testDatabaseConnection(): void
    {
        $this->assertNotNull($this->conn);
        $this->assertEquals(0, $this->conn->connect_errno);
    }

    public function testTicketsTableExists(): void
    {
        $result = $this->conn->query("SHOW TABLES LIKE 'tickets'");
        $this->assertNotFalse($result, 'Query failed');
        $this->assertGreaterThan(0, $result->num_rows, 'Tickets table does not exist');
    }

    public function testTicketsTableStructure(): void
    {
        $result = $this->conn->query("DESCRIBE tickets");
        $this->assertNotFalse($result, 'Query failed');
        
        $columns = [];
        while ($row = $result->fetch_assoc()) {
            $columns[] = $row['Field'];
        }
        
        $this->assertContains('id', $columns);
        $this->assertContains('title', $columns);
        $this->assertContains('description', $columns);
        $this->assertContains('created_at', $columns);
    }

    protected function tearDown(): void
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
