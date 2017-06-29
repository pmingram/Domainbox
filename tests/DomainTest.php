<?php

use MadeITBelgium\Domainbox\Domainbox;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class DomainTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testAvailableDomain()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);
        
        
        // Create a mock and queue two responses.
        
        $stream = Psr7\stream_for('{"d": {"AvailabilityStatus": 1, "AvailabilityStatusDescr": "Unavailable", "LaunchPhase": "GA", "DropDate": "", "BackOrderAvailable": false, "AdditionalResults": {}, "LaunchStep": "", "ResultCode": 100, "ResultMsg": "Command Successful", "TxID": "1b68172f-ca79-4fc4-9a04-f15a17b6abfc"}}');
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], $stream)
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        
        $domainbox->setClient($client);
        $domain = $domainbox->domain();
        $response = $domain->checkDomainAvailability("madeitbelgium.be", "GA");
        
        $this->assertEquals('Unavailable', $response->getStatus());
        $this->assertEquals(false, $response->isAvailable());
    }
}
