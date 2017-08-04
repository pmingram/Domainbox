<?php

use MadeITBelgium\Domainbox\Domainbox;
use MadeITBelgium\Domainbox\Object\Domain;
use MadeITBelgium\Domainbox\Object\Contact;

class ModifyDomainTest extends \PHPUnit_Framework_TestCase
{
    private $wsdl = 'tests/domainbox.wsdl';

    public function setUp()
    {
        parent::setUp();
    }

    public function testModifyDomainContacts()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);
        $newContact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be', 62873737);

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
        $result->DomainName = "ech.be";
        
        $result->Contacts = [
            'Registrant' => $contact,
        ];

        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->RegistrantContactId = 62873737;
        $result->AdminContactId = 62873737;
        $result->TechContactId = 62873737;
        $result->BillingContactId = 62873737;

        $data = new stdClass();
        $data->ModifyDomainContactsResult = $result;

        $soapClientMock->expects($this->any())
            ->method('ModifyDomainContacts')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->modifyDomainContacts('emeraldcloudhosting.com', 'Registrant', $newContact);

        $this->assertEquals('62873737', $response->getRegistrantContactId());
    }

    public function testModifyDomainAuthcode()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);
        
        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->AuthCode = "ABC123";
        $result->AdminContactId = 62873737;
        $result->TechContactId = 62873737;
        $result->BillingContactId = 62873737;

        $data = new stdClass();
        $data->ModifyDomainAuthcodeResult = $result;

        $soapClientMock->expects($this->any())
            ->method('ModifyDomainAuthcode')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->modifyDomainAuthcode('emeraldcloudhosting.com');

        $this->assertEquals('ABC123', $response->getAuthCode());
    }

    public function testModifyDomainAuthcodeSelfChoisen()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);
        
        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->AuthCode = "123456";
        $result->AdminContactId = 62873737;
        $result->TechContactId = 62873737;
        $result->BillingContactId = 62873737;

        $data = new stdClass();
        $data->ModifyDomainAuthcodeResult = $result;

        $soapClientMock->expects($this->any())
            ->method('ModifyDomainAuthcode')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->modifyDomainAuthcode('emeraldcloudhosting.com', false, '123456');

        $this->assertEquals('123456', $response->getAuthCode());
    }

    public function testModifyDomainLock()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);
        
        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';

        $data = new stdClass();
        $data->ModifyDomainLockResult = $result;

        $soapClientMock->expects($this->any())
            ->method('ModifyDomainLock')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->modifyDomainLock('emeraldcloudhosting.com', true);

        $this->assertEquals(true, $response);
    }

    public function testModifyDomainRenewalSettings()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);
        
        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->AutoRenew = true;
        $result->AutoRenewDays = 7;

        $data = new stdClass();
        $data->ModifyDomainRenewalSettingsResult = $result;

        $soapClientMock->expects($this->any())
            ->method('ModifyDomainRenewalSettings')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->modifyDomainRenewalSettings('emeraldcloudhosting.com', true, 7);

        $this->assertEquals(true, $response->getAutoRenew());
        $this->assertEquals(7, $response->getAutoRenewDays());
    }


    public function testModifyDomainPrivacy()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);
        
        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';

        $data = new stdClass();
        $data->ModifyDomainPrivacyResult = $result;

        $soapClientMock->expects($this->any())
            ->method('ModifyDomainPrivacy')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->modifyDomainPrivacy('emeraldcloudhosting.com', true);

        $this->assertEquals(true, $response);
    }
}
