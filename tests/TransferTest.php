<?php

use MadeITBelgium\Domainbox\Domainbox;
use MadeITBelgium\Domainbox\Object\Contact;
use MadeITBelgium\Domainbox\Object\Domain;

class TransferTest extends \PHPUnit_Framework_TestCase
{
    private $wsdl = 'tests/domainbox.wsdl';

    public function setUp()
    {
        parent::setUp();
    }

    //CheckTransferAvailability
    public function testDomainnameIsTransferable()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->AvailabilityStatus = 1;
        $result->AvailabilityStatusDescr = 'Transferrable';
        $result->CurrentRegistrar = 'TEST';

        $data = new stdClass();
        $data->CheckTransferAvailabilityResult = $result;

        $soapClientMock->expects($this->any())
            ->method('CheckTransferAvailability')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $transfer = $domainbox->transfer();
        $response = $transfer->checkTransferAvailabilty('madeit.be');

        $this->assertEquals('Transferrable', $response->getStatus());
        $this->assertEquals(true, $response->isTransferable());
        $this->assertEquals("TEST", $response->getCurrentRegistar());
    }
    
    public function testDomainnameIsNotTransferable()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->AvailabilityStatus = 2;
        $result->AvailabilityStatusDescr = 'Invalid domain supplied';
        $result->CurrentRegistrar = 'TEST';

        $data = new stdClass();
        $data->CheckTransferAvailabilityResult = $result;

        $soapClientMock->expects($this->any())
            ->method('CheckTransferAvailability')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $transfer = $domainbox->transfer();
        $response = $transfer->checkTransferAvailabilty('madeit.be');

        $this->assertEquals('InvalidDomainSupplied', $response->getStatus());
        $this->assertEquals(false, $response->isTransferable());
        $this->assertEquals("TEST", $response->getCurrentRegistar());
    }
    
    //transfer
    public function testTransferGenerateDomainboxCommand_UK()
    {
        //UK Domains
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.co.uk';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.co.uk',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,
            'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                    'AdditionalData'     => ['UKAdditionalData' => ''],
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Extension'   => ['UKDirectData' => ['RelatedDomainId' => 0]],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_US()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.us';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.us',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                    'AdditionalData'     => ['USAdditionalData' => ''],
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_IM()
    {
        //IM Domains
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.im';
        $launchPhase = 'GA';
        $period = 3;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.im',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_IN()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.in';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = true;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.in',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_EU()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.eu';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = true;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.eu',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_BE()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.be';
        $launchPhase = 'GA';
        $period = 2;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = true;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.be',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_ES()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.es';
        $launchPhase = 'GA';
        $period = 6;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = true;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.es',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_AF()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.af';
        $launchPhase = 'GA';
        $period = 6;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.af',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_TEL()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.tel';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.tel',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_AT()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.at';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 31;
        $applyPrivacy = true;
        $acceptTerms = false;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.at',
            'AutoRenew'     => true,
            'AutoRenewDays' => 30,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_NL()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.nl';
        $launchPhase = 'GA';
        $period = 2;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = true;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.nl',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_TK()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.tk';
        $launchPhase = 'GA';
        $period = 10;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.tk',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_qA()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.qa';
        $launchPhase = 'GA';
        $period = 6;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.qa',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_FR()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.fr';
        $launchPhase = 'GA';
        $period = 2;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = true;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.fr',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_DE()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.de';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = false;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.de',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Extension'   => ['DeBillingData' => ['MonthlyBilling' => false]],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_MX()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.mx';
        $launchPhase = 'GA';
        $period = 6;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.mx',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_IT()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.it';
        $launchPhase = 'GA';
        $period = 2;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.it',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_CO_ZA()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.co.za';
        $launchPhase = 'GA';
        $period = 2;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = true;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.co.za',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_FM()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.fm';
        $launchPhase = 'GA';
        $period = 6;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.fm',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_PL()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.pl';
        $launchPhase = 'GA';
        $period = 2;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = true;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.pl',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_IO()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.io';
        $launchPhase = 'GA';
        $period = 2;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.io',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_JP()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.jp';
        $launchPhase = 'GA';
        $period = 2;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = true;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.jp',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Extension'   => ['JPProxyServiceData' => ['UseProxyService' => true]],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    //transfer
    public function testTransferGenerateDomainboxCommand_LV()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.lv';
        $launchPhase = 'GA';
        $period = 2;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.lv',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    public function testTransferGenerateDomainboxCommand_GG()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.gg';
        $launchPhase = 'GA';
        $period = 3;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.gg',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    public function testTransferGenerateDomainboxCommand_CH()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.ch';
        $launchPhase = 'GA';
        $period = 2;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.ch',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    public function testTransferGenerateDomainboxCommand_DM()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.dm';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = true;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.dm',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    public function testTransferGenerateDomainboxCommand_CO_NZ()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.co.nz';
        $launchPhase = 'GA';
        $period = 2;
        $applyLock = true;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = true;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.co.nz',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    public function testTransferGenerateDomainboxCommand_SX()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.sx';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.sx',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    public function testTransferGenerateDomainboxCommand_PRO()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.pro';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = true;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.pro',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    public function testTransferGenerateDomainboxCommand_CAT()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.cat';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.cat',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Extension'   => ['CatParameterData' => ['Maintainer' => '', 'AuthId' => '', 'AuthKey' => '', 'IntendedUse' => '']],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    public function testTransferGenerateDomainboxCommand_ACADEMY()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.academy';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.academy',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,             'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Extension'   => ['DonutsPriceCategoryData' => ['PriceCategory' => '']],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    public function testTransferGenerateDomainboxCommand_AUDIO()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.audio';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.audio',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,
            'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Extension'   => ['ChallengeParameters' => ['Challenges' => '.audio']],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    public function testTransferGenerateDomainboxCommand_ACTOR()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.actor';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.actor',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,
            'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Extension'   => ['PremiumPriceCategory' => ['PriceCategory' => 'Category16']],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    public function testTransferGenerateDomainboxCommand_ARCHI()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.archi';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = true;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.archi',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers' => true,
            'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    public function testTransferGenerateDomainboxCommand_SCOT()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.scot';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $this->assertEquals([
            'DomainName'    => 'maideit.scot',
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'KeepExistingNameservers'  => true,
            'AuthCode' => 'ABC',
            'Contacts'      => [
                'Registrant' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Admin' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Billing' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
                'Tech' => [
                    'Name'               => 'Tjebbe Lievens',
                    'Organisation'       => 'Made I.T.',
                    'Street1'            => 'Somewhere in belgium',
                    'Street2'            => '',
                    'Street3'            => '',
                    'City'               => 'Geel',
                    'State'              => 'Antwerp',
                    'Postcode'           => '2440',
                    'CountryCode'        => 'BE',
                    'Telephone'          => '+32.123456789',
                    'TelephoneExtension' => '',
                    'Fax'                => '',
                    'Email'              => 'info@madeit.be',
                ],
            ],
            'Extension'   => ['IntendedUseParams' => ['IntendedUse' => '', 'ReferenceUrl' => '', 'TrademarkId' => '', 'TrademarkIssuer' => '']],
            'Nameservers' => [
                'NS1'         => 'ns1.madeit.be',
                'NS2'         => 'ns2.madeit.be',
                'NS3'         => '',
                'NS4'         => '',
                'NS5'         => '',
                'NS6'         => '',
                'NS7'         => '',
                'NS8'         => '',
                'NS9'         => '',
                'NS10'        => '',
                'NS11'        => '',
                'NS12'        => '',
                'NS13'        => '',
                'GlueRecords' => [],
            ],
        ], $transferDomain->generateTransferDomainboxCommand());
    }

    public function testRegisterCommand()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $transferDomain = new Domain();
        $domainName = 'maideit.be';
        $launchPhase = 'GA';
        $period = 1;
        $applyLock = false;
        $autoRenew = true;
        $autoRenewDays = 7;
        $applyPrivacy = false;
        $acceptTerms = true;
        $nameServers = ['ns1.madeit.be', 'ns2.madeit.be'];
        $glueRecords = [];
        $registrant = $contact;
        $admin = $contact;
        $tech = $contact;
        $billing = $contact;
        $trademark = null;
        $extension = null;
        $sunriseData = null;
        $commandOptions = null;
        $transferDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $transferDomain->setAuthCode("ABC");
        
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Transfer Requested Successfully';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->OrderId = 13477;
        $result->DomainId = 24957;
        $result->RegistrantContactId = 12187;
        $result->AdminContactId = 12190;
        $result->TechContactId = 12190;
        $result->BillingContactId = 12187;

        $data = new stdClass();
        $data->RequestTransferResult = $result;

        $soapClientMock->expects($this->any())
            ->method('RequestTransfer')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $transfer = $domainbox->transfer();
        $response = $transfer->transferDomain($transferDomain);

        $this->assertEquals(13477, $response->getOrderId());
        $this->assertEquals(24957, $response->getDomainId());
        $this->assertEquals(12187, $response->getRegistrantContactId());
        $this->assertEquals(12190, $response->getAdminContactId());
        $this->assertEquals(12190, $response->getTechContactId());
        $this->assertEquals(12187, $response->getBillingContactId());
    }

    public function testTransferQuery()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Transfer Queried Successfully';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->DomainId = 87953;
        $result->TransferStatus = 1;
        $result->AvailabilityStatusDescr = 'PendingOwnerApproval';
        $result->AdminEmailSent = true;
        $result->AdminEmailSentDate = "2014-02-14 22:31:02";
        $result->AdminEmailAddress = "jimmy@email.com";
        $result->LosingRegistrar = 'TEST';

        $data = new stdClass();
        $data->QueryTransferResult = $result;

        $soapClientMock->expects($this->any())
            ->method('QueryTransfer')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $transfer = $domainbox->transfer();
        $response = $transfer->queryTransfer('madeit.be');

        $this->assertEquals('PendingOwnerApproval', $response->getStatus());
        $this->assertEquals(true, $response->isTransferAdminEmailSend());
        $this->assertEquals("TEST", $response->getCurrentRegistar());
        $this->assertEquals("jimmy@email.com", $response->getTransferAdminEmailAddress());
        $this->assertEquals("2014-02-14 22:31:02", $response->getTransferAdminEmailSendDate());
    }

    
    public function testCancelTransfer()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Transfer Cancelled Successfully';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';

        $data = new stdClass();
        $data->CancelTransferResult = $result;

        $soapClientMock->expects($this->any())
            ->method('CancelTransfer')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $transfer = $domainbox->transfer();
        $response = $transfer->cancelTransfer('madeit.be', 1);

        $this->assertEquals(true, $response);
    }
    
    public function testResendTransferAdminEmail()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Transfer Queried Successfully';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->AdminEmailAddress = "jimmy@email.com";
        $result->LosingRegistrar = 'TEST';

        $data = new stdClass();
        $data->ResendTransferAdminEmailResult = $result;

        $soapClientMock->expects($this->any())
            ->method('ResendTransferAdminEmail')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $transfer = $domainbox->transfer();
        $response = $transfer->resendTransferAdminEmail('madeit.be', 1);
        
        $this->assertEquals("TEST", $response->getCurrentRegistar());
        $this->assertEquals("jimmy@email.com", $response->getTransferAdminEmailAddress());
    }
    
    public function testRestartTransfer()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Transfer Restarted Successfully';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';

        $data = new stdClass();
        $data->RestartTransferResult = $result;

        $soapClientMock->expects($this->any())
            ->method('RestartTransfer')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $transfer = $domainbox->transfer();
        $response = $transfer->restartTransfer('madeit.be', 1);

        $this->assertEquals(true, $response);
    }
}
