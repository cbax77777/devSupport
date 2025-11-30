<?php

use PHPUnit\Framework\TestCase;

final class SmokeTest extends TestCase
{
    public function testTrue(): void
    {
        $this->assertTrue(true);
    }

    public function testCanIncludeDb(): void
    {
        $this->assertFileExists('/var/www/html/db.php');
    }

    public function testCanIncludeGetTickets(): void
    {
        $this->assertFileExists('/var/www/html/get_tickets.php');
    }

    public function testCanIncludeAddTicket(): void
    {
        $this->assertFileExists('/var/www/html/add_ticket.php');
    }
}
