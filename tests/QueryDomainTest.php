<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Response;
use MadeITBelgium\Domainbox\Domainbox;
use MadeITBelgium\Domainbox\Object\Contact;
use MadeITBelgium\Domainbox\Object\Domain;

class QueryDomainTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testQueryDomain()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        // Create a mock and queue two responses.

        $stream = Psr7\stream_for('{
  "d": {
    "Status": [
      "OK",
      "VERIFIED"
    ],
    "DomainId": 57438421,
    "ExpiryDate": "2017-10-04",
    "CreatedDate": "2014-10-04",
    "ApplyLock": false,
    "AutoRenew": false,
    "AutoRenewDays": 14,
    "ApplyPrivacy": true,
    "Nameservers": {
      "NS1": "ns1.dnsfarm.org",
      "NS2": "ns2.dnsfarm.org",
      "NS3": "ns3.dnsfarm.org",
      "NS4": "",
      "NS5": "",
      "NS6": "",
      "NS7": "",
      "NS8": "",
      "NS9": "",
      "NS10": "",
      "NS11": "",
      "NS12": "",
      "NS13": ""
    },
    "Contacts": {
      "Registrant": {
        "ContactId": 62873737,
        "Name": "Tjebbe Lievens",
        "Organisation": "Made I.T.",
        "Street1": "Somewhere 1",
        "Street2": "",
        "Street3": "",
        "City": "Geel",
        "State": "",
        "Postcode": "2440",
        "CountryCode": "BE",
        "Telephone": "+32.485000000",
        "TelephoneExtension": "",
        "Fax": "",
        "Email": "info@madeit.be"
      },
      "Admin": {
        "ContactId": 62873737,
        "Name": "Tjebbe Lievens",
        "Organisation": "Made I.T.",
        "Street1": "Somewhere 1",
        "Street2": "",
        "Street3": "",
        "City": "Geel",
        "State": "",
        "Postcode": "2440",
        "CountryCode": "BE",
        "Telephone": "+32.485000000",
        "TelephoneExtension": "",
        "Fax": "",
        "Email": "info@madeit.be"
      },
      "Tech": {
        "ContactId": 62873737,
        "Name": "Tjebbe Lievens",
        "Organisation": "Made I.T.",
        "Street1": "Somewhere 1",
        "Street2": "",
        "Street3": "",
        "City": "Geel",
        "State": "",
        "Postcode": "2440",
        "CountryCode": "BE",
        "Telephone": "+32.485000000",
        "TelephoneExtension": "",
        "Fax": "",
        "Email": "info@madeit.be"
      },
      "Billing": {
        "ContactId": 62873737,
        "Name": "Tjebbe Lievens",
        "Organisation": "Made I.T.",
        "Street1": "Somewhere 1",
        "Street2": "",
        "Street3": "",
        "City": "Geel",
        "State": "",
        "Postcode": "2440",
        "CountryCode": "BE",
        "Telephone": "+32.485000000",
        "TelephoneExtension": "",
        "Fax": "",
        "Email": "info@madeit.be"
      }
    },
    "ResultCode": 100,
    "ResultMsg": "Domain Queried Successfully",
    "TxID": "96b81455-752c-4210-88ef-9bdbb591a7b2"
  }
}');
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], $stream),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $domainbox->setClient($client);
        $domain = $domainbox->domain();
        $response = $domain->queryDomain('emeraldcloudhosting.com');

        $this->assertEquals('Unavailable', $response->getStatus());
        $this->assertEquals(false, $response->isAvailable());
        $this->assertEquals(false, $response->canBackOrder());
        $this->assertEquals(null, $response->getDropDate());
        $this->assertEquals(null, $response->getLaunchPhase());
        
        $this->assertEquals("57438421", $response->getDomainId());
        $this->assertEquals("2017-10-04", $response->getExpiryDate());
        $this->assertEquals("2014-10-04", $response->getCreatedDate());
        $this->assertEquals(false, $response->getApplyLock());
        $this->assertEquals(false, $response->getAutoRenew());
        $this->assertEquals(14, $response->getAutoRenewDays());
        $this->assertEquals(true, $response->getApplyPrivacy());
    }
    
    /**
     * @expectedException Exception
     */
    public function testQueryDomainNotInAccount()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        // Create a mock and queue two responses.

        $stream = Psr7\stream_for('{
  "d": {
    "DomainId": 0,
    "ApplyLock": false,
    "AutoRenew": false,
    "AutoRenewDays": 0,
    "ApplyPrivacy": false,
    "ResultCode": 295,
    "ResultMsg": "Domain not in your reseller account: tjebbelievens.be",
    "TxID": "97007562-d838-48c6-9e38-0d2048c823e8"
  }
}');
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], $stream),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $domainbox->setClient($client);
        $domain = $domainbox->domain();
        $response = $domain->queryDomain('tjebbelievens.be');

        $this->assertEquals('Available', $response->getStatus());
        $this->assertEquals(true, $response->isAvailable());
        $this->assertEquals(false, $response->canBackOrder());
        $this->assertEquals(null, $response->getDropDate());
        $this->assertEquals(null, $response->getLaunchPhase());
        
        $this->assertEquals("0", $response->getDomainId());
        $this->assertEquals(false, $response->getApplyLock());
        $this->assertEquals(false, $response->getAutoRenew());
        $this->assertEquals(0, $response->getAutoRenewDays());
        $this->assertEquals(false, $response->getApplyPrivacy());
    }
}
