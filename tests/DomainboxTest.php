<?php

use MadeITBelgium\Domainbox\Domainbox;
use PHPUnit\Framework\TestCase;

class DomainboxTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testConstructor()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);
    }
}
