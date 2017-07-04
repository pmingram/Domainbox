<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Response;
use MadeITBelgium\Domainbox\Domainbox;
use MadeITBelgium\Domainbox\Object\Contact;
use MadeITBelgium\Domainbox\Object\Domain;

class ContactTest extends \PHPUnit_Framework_TestCase
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
    "Contact": {
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
    "Linked": true,
    "TLDs": [
      ".com",
      ".net"
    ],
    "ResultCode": 100,
    "ResultMsg": "Contact Queried Successfully",
    "TxID": "531d1f67-16b3-4fec-b118-638f3518a073"
  }
}');
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], $stream),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $domainbox->setClient($client);
        $contact = $domainbox->contact();
        $response = $contact->queryContact(62873737);

        $this->assertEquals(62873737, $response->getContactId());
        $this->assertEquals("Tjebbe Lievens", $response->getName());
        $this->assertEquals("Made I.T.", $response->getOrganisation());
        $this->assertEquals("Somewhere 1", $response->getStreet1());
        $this->assertEquals(null, $response->getStreet2());
        $this->assertEquals(null, $response->getStreet3());
        $this->assertEquals("Geel", $response->getCity());
        $this->assertEquals(null, $response->getState());
        $this->assertEquals("2440", $response->getPostcode());
        $this->assertEquals("BE", $response->getCountryCode());
        $this->assertEquals("+32.485000000", $response->getTelephone());
        $this->assertEquals(null, $response->getTelephoneExtension());
        $this->assertEquals(null, $response->getFax());
        $this->assertEquals("info@madeit.be", $response->getEmail());
        
    }
    
    /**
     * @expectedException Exception
     */
    public function testQueryDomainFailed()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        // Create a mock and queue two responses.

        $stream = Psr7\stream_for('{
  "d": {
    "Linked": false,
    "ResultCode": 322,
    "ResultMsg": "Contact not in your reseller account: 62873731",
    "TxID": "83d726bc-4af9-4cd4-ab1a-2ec7ad8b4cf8"
  }
}');
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], $stream),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $domainbox->setClient($client);
        $contact = $domainbox->contact();
        $response = $contact->queryContact(62873731);
        
    }
}
