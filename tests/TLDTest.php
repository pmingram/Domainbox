<?php

use MadeITBelgium\Domainbox\TLDs\TLD;

class TLDTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testObjects()
    {
        $this->assertEquals([
            new MadeITBelgium\Domainbox\TLDs\Academy(),
            new MadeITBelgium\Domainbox\TLDs\Com(),
        ], TLD::getAllTLDs());
    }
}
