<?php

use MadeITBelgium\Domainbox\Domainbox;

class ContactTest extends \PHPUnit_Framework_TestCase
{
    private $wsdl = 'tests/domainbox.wsdl';

    public function setUp()
    {
        parent::setUp();
    }

    public function testQueryDomain()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $contact = new stdClass();
        $contact->ContactId = 62873737;
        $contact->Name = 'Tjebbe Lievens';
        $contact->Organisation = 'Made I.T.';
        $contact->Street1 = 'Somewhere 1';
        $contact->Street2 = null;
        $contact->Street3 = null;
        $contact->City = 'Geel';
        $contact->State = null;
        $contact->Postcode = '2440';
        $contact->CountryCode = 'BE';
        $contact->Telephone = '+32.485000000';
        $contact->TelephoneExtension = null;
        $contact->Fax = null;
        $contact->Email = 'info@madeit.be';

        $result = new stdClass();
        $result->Contact = $contact;
        $result->Linked = true;
        $result->TLDs = ['.com', '.net'];
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';

        $data = new stdClass();
        $data->QueryContactResult = $result;

        $soapClientMock->expects($this->any())
            ->method('QueryContact')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $contact = $domainbox->contact();
        $response = $contact->queryContact(62873737);

        $this->assertEquals(62873737, $response->getContactId());
        $this->assertEquals('Tjebbe Lievens', $response->getName());
        $this->assertEquals('Made I.T.', $response->getOrganisation());
        $this->assertEquals('Somewhere 1', $response->getStreet1());
        $this->assertEquals(null, $response->getStreet2());
        $this->assertEquals(null, $response->getStreet3());
        $this->assertEquals('Geel', $response->getCity());
        $this->assertEquals(null, $response->getState());
        $this->assertEquals('2440', $response->getPostcode());
        $this->assertEquals('BE', $response->getCountryCode());
        $this->assertEquals('+32.485000000', $response->getTelephone());
        $this->assertEquals(null, $response->getTelephoneExtension());
        $this->assertEquals(null, $response->getFax());
        $this->assertEquals('info@madeit.be', $response->getEmail());
    }

    /**
     * @expectedException Exception
     */
    public function testQueryDomainFailed()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $contact = new stdClass();
        $contact->Linked = false;
        $contact->ResultCode = 322;
        $contact->ResultMsg = 'Contact not in your reseller account: 62873731';
        $contact->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';

        $data = new stdClass();
        $data->QueryContactResult = $contact;

        $soapClientMock->expects($this->any())
            ->method('QueryContact')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $contact = $domainbox->contact();
        $response = $contact->queryContact(62873731);
    }
}
