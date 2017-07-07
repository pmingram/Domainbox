<?php

use MadeITBelgium\Domainbox\Domainbox;
use MadeITBelgium\Domainbox\Object\Domain;

class QueryDomainTest extends \PHPUnit_Framework_TestCase
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
        $result->Status = ['OK', 'VERIFIED'];
        $result->DomainId = 57438421;
        $result->ExpiryDate = '2017-10-04';
        $result->CreatedDate = '2014-10-04';
        $result->ApplyLock = false;
        $result->AutoRenew = false;
        $result->AutoRenewDays = 14;
        $result->ApplyPrivacy = true;
        $result->Nameservers = [
            'NS1'  => 'ns1.dnsfarm.org',
            'NS2'  => 'ns2.dnsfarm.org',
            'NS3'  => 'ns3.dnsfarm.org',
            'NS4'  => '',
            'NS5'  => '',
            'NS6'  => '',
            'NS7'  => '',
            'NS8'  => '',
            'NS9'  => '',
            'NS10' => '',
            'NS11' => '',
            'NS12' => '',
            'NS13' => '',
        ];
        $result->Contacts = [
            'Registrant' => $contact,
            'Admin'      => $contact,
            'Billing'    => $contact,
            'Tech'       => $contact,
        ];

        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';

        $data = new stdClass();
        $data->QueryDomainResult = $result;

        $soapClientMock->expects($this->any())
            ->method('QueryDomain')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->queryDomain('emeraldcloudhosting.com');

        $this->assertEquals('Unavailable', $response->getStatus());
        $this->assertEquals(false, $response->isAvailable());
        $this->assertEquals(false, $response->canBackOrder());
        $this->assertEquals(null, $response->getDropDate());
        $this->assertEquals(null, $response->getLaunchPhase());

        $this->assertEquals('57438421', $response->getDomainId());
        $this->assertEquals('2017-10-04', $response->getExpiryDate());
        $this->assertEquals('2014-10-04', $response->getCreatedDate());
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

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->DomainId = 0;
        $result->ApplyLock = false;
        $result->AutoRenew = false;
        $result->AutoRenewDays = 0;
        $result->ApplyPrivacy = false;
        $result->ResultCode = 295;
        $result->ResultMsg = 'Domain not in your reseller account: tjebbelievens.be';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';

        $data = new stdClass();
        $data->QueryDomainResult = $result;

        $soapClientMock->expects($this->any())
            ->method('QueryDomain')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->queryDomain('tjebbelievens.be');

        $this->assertEquals('Available', $response->getStatus());
        $this->assertEquals(true, $response->isAvailable());
        $this->assertEquals(false, $response->canBackOrder());
        $this->assertEquals(null, $response->getDropDate());
        $this->assertEquals(null, $response->getLaunchPhase());

        $this->assertEquals('0', $response->getDomainId());
        $this->assertEquals(false, $response->getApplyLock());
        $this->assertEquals(false, $response->getAutoRenew());
        $this->assertEquals(0, $response->getAutoRenewDays());
        $this->assertEquals(false, $response->getApplyPrivacy());
    }
}
