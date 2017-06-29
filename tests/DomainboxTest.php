<?php

use MadeITBelgium\Domainbox\Domainbox;

class DomainboxTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testConstructor()
    {
        $domainbox = new Domainbox();
    }
}
