<?php

use MadeITBelgium\Domainbox\Domainbox;
use MadeITBelgium\Domainbox\Object\Contact;
use MadeITBelgium\Domainbox\Object\Domain;

class DomainTest extends \PHPUnit_Framework_TestCase
{
    private $wsdl = 'tests/domainbox.wsdl';

    public function setUp()
    {
        parent::setUp();
    }

    //checkDomainAvailability
    public function testUnavailableDomain()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 101;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->AvailabilityStatus = 1;
        $result->AvailabilityStatusDescr = 'Unavailable';
        $result->LaunchPhase = 'GA';
        $result->DropDate = '2017-01-01';
        $result->BackOrderAvailable = false;
        $result->AdditionalResults = null;
        $result->LaunchStep = null;

        $data = new stdClass();
        $data->CheckDomainAvailabilityResult = $result;

        $soapClientMock->expects($this->any())
            ->method('CheckDomainAvailability')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->checkDomainAvailability('madeit.be', 'GA');

        $this->assertEquals('Unavailable', $response->getStatus());
        $this->assertEquals(false, $response->isAvailable());
        $this->assertEquals(false, $response->canBackOrder());
        $this->assertEquals('2017-01-01', $response->getDropDate());
        $this->assertEquals('GA', $response->getLaunchPhase());
    }

    public function testUnavailableBackOrderDomain()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->AvailabilityStatus = 1;
        $result->AvailabilityStatusDescr = 'Unavailable';
        $result->LaunchPhase = 'GA';
        $result->DropDate = '2017-01-01';
        $result->BackOrderAvailable = true;
        $result->AdditionalResults = null;
        $result->LaunchStep = null;

        $data = new stdClass();
        $data->CheckDomainAvailabilityResult = $result;

        $soapClientMock->expects($this->any())
            ->method('CheckDomainAvailability')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->checkDomainAvailability('madeit.be', 'GA');

        $this->assertEquals('Unavailable', $response->getStatus());
        $this->assertEquals(false, $response->isAvailable());
        $this->assertEquals(true, $response->canBackOrder());
    }

    public function testUnavailableOfflineDomain()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->AvailabilityStatus = 8;
        $result->AvailabilityStatusDescr = 'UnavailableUsingOfflineLookup';
        $result->LaunchPhase = 'GA';
        $result->DropDate = '2017-01-01';
        $result->BackOrderAvailable = true;
        $result->AdditionalResults = null;
        $result->LaunchStep = null;

        $data = new stdClass();
        $data->CheckDomainAvailabilityResult = $result;

        $soapClientMock->expects($this->any())
            ->method('CheckDomainAvailability')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->checkDomainAvailability('madeit.be', 'GA', true);

        $this->assertEquals('UnavailableOfflineLookup', $response->getStatus());
        $this->assertEquals(false, $response->isAvailable());
        $this->assertEquals(true, $response->canBackOrder());
    }

    public function testAvailableOfflineDomain()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->AvailabilityStatus = 7;
        $result->AvailabilityStatusDescr = 'AvailableUsingOfflineLookup';
        $result->LaunchPhase = 'GA';
        $result->DropDate = '2017-01-01';
        $result->BackOrderAvailable = false;
        $result->AdditionalResults = null;
        $result->LaunchStep = null;

        $data = new stdClass();
        $data->CheckDomainAvailabilityResult = $result;

        $soapClientMock->expects($this->any())
            ->method('CheckDomainAvailability')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->checkDomainAvailability('madeit.be', 'GA', true);

        $this->assertEquals('AvailableOfflineLookup', $response->getStatus());
        $this->assertEquals(true, $response->isAvailable());
        $this->assertEquals(false, $response->canBackOrder());
    }

    public function testAvailableDomain()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->AvailabilityStatus = 0;
        $result->AvailabilityStatusDescr = 'Available';
        $result->LaunchPhase = 'GA';
        $result->DropDate = null;
        $result->BackOrderAvailable = false;
        $result->AdditionalResults = null;
        $result->LaunchStep = null;

        $data = new stdClass();
        $data->CheckDomainAvailabilityResult = $result;

        $soapClientMock->expects($this->any())
            ->method('CheckDomainAvailability')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->checkDomainAvailability('madeit.be', 'GA', true);

        $this->assertEquals('Available', $response->getStatus());
        $this->assertEquals(true, $response->isAvailable());
        $this->assertEquals(false, $response->canBackOrder());
    }

    //checkDomainAvailabilityPlus
    public function testUnavailableDomainPlus()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        // Create a mock and queue two responses.
        /*
                $stream = Psr7\stream_for('{
        
            "NameSuggestions": {
              "ResultCode": 500,
              "ResultMsg": "Name Suggestions failed. Unable to get name Suggestions"
            },
            "TypoSuggestions": {
              "ResultCode": 500,
              "ResultMsg": "Typo Suggestions failed. Unable to get Typo Suggestions"
            },
            "PrefixSuffixSuggestions": {
              "ResultCode": 500,
              "ResultMsg": "Suffix/Prefix Suggestions failed. Unable to get Suffix/Prefix Suggestions"
            },
            "PremiumDomains": {
              "ResultCode": 100,
              "ResultMsg": "Command Successful",
              "Domains": [
                {
                  "DomainName": "madeitmine.com",
                  "Price": "1495.00",
                  "FastTransfer": true
                },
                {
                  "DomainName": "madeitup.com",
                  "Price": "6099.00",
                  "FastTransfer": true
                },
                {
                  "DomainName": "madeitmatter.com",
                  "Price": "1895.00",
                  "FastTransfer": true
                },
                {
                  "DomainName": "madeiteasy.com",
                  "Price": "3599.00",
                  "FastTransfer": true
                },
                {
                  "DomainName": "madeityet.com",
                  "Price": "349.00",
                  "FastTransfer": true
                },
                {
                  "DomainName": "madeitfunny.com",
                  "Price": "250.00",
                  "FastTransfer": false
                },
                {
                  "DomainName": "MadeItHappen.com",
                  "Price": "2288.00",
                  "FastTransfer": true
                },
                {
                  "DomainName": "madeitright.com",
                  "Price": "2695.00",
                  "FastTransfer": false
                },
                {
                  "DomainName": "madeitsimple.com",
                  "Price": "899.00",
                  "FastTransfer": false
                },
                {
                  "DomainName": "madeitdesign.com",
                  "Price": "877.00",
                  "FastTransfer": false
                }
              ]
            },
            "ResultCode": 100,
            "ResultMsg": "The following items failed (Name Suggestions, Typo Suggestions, Suffix/Prefix Suggestions)",
            "TxID": "9fb8f585-c43e-4d29-8fae-86110cd89adc"
          }
        }'); //ResultCode changed from 210
                */

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $domains = [];
        $domain = new stdClass();
        $domain->ResultCode = 100;
        $domain->ResultMsg = 'Command Successful';
        $domain->DomainName = 'madeit.be';
        $domain->AvailabilityStatus = 1;
        $domain->AvailabilityStatusDescr = 'Unavailable';
        $domain->LaunchPhase = 'GA';
        $domain->DropDate = null;
        $domain->BackOrderAvailable = false;
        $domain->LaunchStep = null;
        $domain->AdditionalResults = [];
        $domains[] = $domain;

        $domain = new stdClass();
        $domain->ResultCode = 100;
        $domain->ResultMsg = 'Command Successful';
        $domain->DomainName = 'madeit.com';
        $domain->AvailabilityStatus = 1;
        $domain->AvailabilityStatusDescr = 'Unavailable';
        $domain->LaunchPhase = 'GA';
        $domain->DropDate = null;
        $domain->BackOrderAvailable = true;
        $domain->LaunchStep = null;
        $domain->AdditionalResults = [];
        $domains[] = $domain;

        $domain = new stdClass();
        $domain->ResultCode = 100;
        $domain->ResultMsg = 'Command Successful';
        $domain->DomainName = 'madeit.nl';
        $domain->AvailabilityStatus = 0;
        $domain->AvailabilityStatusDescr = 'Available';
        $domain->LaunchPhase = 'GA';
        $domain->DropDate = null;
        $domain->BackOrderAvailable = false;
        $domain->LaunchStep = null;
        $domain->AdditionalResults = [];
        $domains[] = $domain;

        $domainCheck = new stdClass();
        $domainCheck->ResultCode = 100;
        $domainCheck->ResultMsg = 'Domain Check completed successfully';
        $domainCheck->Domains = $domains;

        $domains = [];
        $domain = new stdClass();
        $domain->DomainName = 'madeitmine.com';
        $domain->Price = 899.00;
        $domain->FastTransfer = false;
        $domains[] = $domain;

        $domain = new stdClass();
        $domain->DomainName = 'madeitdesign.com';
        $domain->Price = 877.00;
        $domain->FastTransfer = false;
        $domains[] = $domain;

        $premiumDomains = new stdClass();
        $premiumDomains->ResultCode = 100;
        $premiumDomains->ResultMsg = 'Command Successful';
        $premiumDomains->Domains = $domains;

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->DomainCheck = $domainCheck;
        $result->PremiumDomains = $premiumDomains;

        $data = new stdClass();
        $data->CheckDomainAvailabilityPlusResult = $result;

        $soapClientMock->expects($this->any())
            ->method('CheckDomainAvailabilityPlus')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);

        $domain = $domainbox->domain();
        $response = $domain->checkDomainAvailabilityPlus('madeit.be');

        $this->assertEquals(3, count($response));

        $this->assertEquals('madeit.be', $response[0]->getDomainName());
        $this->assertEquals('Unavailable', $response[0]->getStatus());
        $this->assertEquals(false, $response[0]->isAvailable());
        $this->assertEquals(false, $response[0]->canBackOrder());

        $this->assertEquals('madeit.com', $response[1]->getDomainName());
        $this->assertEquals('Unavailable', $response[1]->getStatus());
        $this->assertEquals(false, $response[1]->isAvailable());
        $this->assertEquals(true, $response[1]->canBackOrder());

        $this->assertEquals('madeit.nl', $response[2]->getDomainName());
        $this->assertEquals('Available', $response[2]->getStatus());
        $this->assertEquals(true, $response[2]->isAvailable());
        $this->assertEquals(false, $response[2]->canBackOrder());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_UK()
    {
        //UK Domains
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.co.uk',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_US()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.us',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_IM()
    {
        //IM Domains
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.im',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_IN()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.in',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => true,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_EU()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.eu',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_BE()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.be',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_ES()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.es',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_AF()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.af',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_TEL()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.tel',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_AT()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.at',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 30,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_NL()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.nl',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_TK()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.tk',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_qA()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.qa',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_FR()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.fr',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_DE()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.de',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_MX()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.mx',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_IT()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.it',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_CO_ZA()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.co.za',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_FM()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.fm',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_PL()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.pl',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_IO()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.io',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_JP()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.jp',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    //register
    public function testRegisterGenerateDomainboxCommand_LV()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.lv',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    public function testRegisterGenerateDomainboxCommand_GG()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.gg',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    public function testRegisterGenerateDomainboxCommand_CH()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.ch',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    public function testRegisterGenerateDomainboxCommand_DM()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.dm',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    public function testRegisterGenerateDomainboxCommand_CO_NZ()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.co.nz',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    public function testRegisterGenerateDomainboxCommand_SX()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.sx',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    public function testRegisterGenerateDomainboxCommand_PRO()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.pro',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    public function testRegisterGenerateDomainboxCommand_CAT()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.cat',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    public function testRegisterGenerateDomainboxCommand_ACADEMY()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.academy',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    public function testRegisterGenerateDomainboxCommand_AUDIO()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.audio',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    public function testRegisterGenerateDomainboxCommand_ACTOR()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.actor',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    public function testRegisterGenerateDomainboxCommand_ARCHI()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.archi',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    public function testRegisterGenerateDomainboxCommand_SCOT()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $this->assertEquals([
            'DomainName'    => 'maideit.scot',
            'LaunchPhase'   => 'GA',
            'Period'        => 1,
            'ApplyLock'     => false,
            'AutoRenew'     => true,
            'AutoRenewDays' => 7,
            'AcceptTerms'   => true,
            'ApplyPrivacy'  => false,
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
        ], $registerDomain->generateDomainboxCommand());
    }

    public function testRegisterCommand()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);

        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 200;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->OrderId = 13477;
        $result->DomainId = 24957;
        $result->RegistrantContactId = 12187;
        $result->AdminContactId = 12190;
        $result->TechContactId = 12190;
        $result->BillingContactId = 12187;

        $data = new stdClass();
        $data->RegisterDomainResult = $result;

        $soapClientMock->expects($this->any())
            ->method('RegisterDomain')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->registerDomain($registerDomain);

        $this->assertEquals(13477, $response->getOrderId());
        $this->assertEquals(24957, $response->getDomainId());
        $this->assertEquals(12187, $response->getRegistrantContactId());
        $this->assertEquals(12190, $response->getAdminContactId());
        $this->assertEquals(12190, $response->getTechContactId());
        $this->assertEquals(12187, $response->getBillingContactId());
    }

    public function testRenewCommand()
    {
        $contact = new Contact('Tjebbe Lievens', 'Made I.T.', 'Somewhere in belgium', null, null, 'Geel', 'Antwerp', '2440', 'BE', '+32.123456789', null, null, 'info@madeit.be');

        $registerDomain = new Domain();
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
        $registerDomain->create($domainName, $launchPhase, $period, $applyLock, $autoRenew, $autoRenewDays, $applyPrivacy, $acceptTerms, $nameServers, $glueRecords, $registrant, $admin, $tech, $billing, $trademark, $extension, $sunriseData, $commandOptions);
        $registerDomain->setExpiryDate('2018-01-01');
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        // Create a mock and queue two responses.
        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 200;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->ExpiryDate = '2019-01-01';

        $data = new stdClass();
        $data->RenewDomainResult = $result;
        $soapClientMock->expects($this->any())
            ->method('RenewDomain')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->renewDomain($registerDomain, 1);

        $this->assertEquals('2019-01-01', $response->getExpiryDate());
    }

    public function providerDeleteDomainTrue()
    {
        return [
            [
                'domain.me',
                date('Y-m-d', strtotime('- 2days')),
            ],
            [
                'domain.af',
                date('Y-m-d', strtotime('- 1day')),
            ],
            [
                'domain.br.com',
                date('Y-m-05'),
            ],
            [
                'domain.co.uk',
                date('Y-m-05'),
            ],
        ];
    }

    /**
     * This is kind of a smoke test.
     *
     * @dataProvider providerDeleteDomainTrue
     **/
    public function testDeleteCommand($domainname, $createdDate)
    {
        $registerDomain = new Domain();
        $registerDomain->create($domainname);
        $registerDomain->setCreatedDate($createdDate);

        $this->assertEquals(true, $registerDomain->canDeleteDomain());
    }

    public function providerDeleteDomainFalse()
    {
        return [
            [
                'domain.me',
                date('Y-m-d', strtotime('- 3days')),
            ],
            [
                'domain.af',
                date('Y-m-d', strtotime('- 2day')),
            ],
            [
                'domain.br.com',
                date('Y-m-05', strtotime(' -1 month')),
            ],
            [
                'domain.co.uk',
                date('Y-m-05', strtotime(' -1 month')),
            ],
            [
                'domain.be',
                date('Y-m-d'),
            ],
            [
                'domain.com',
                date('Y-m-d'),
            ],
        ];
    }

    /**
     * This is kind of a smoke test.
     *
     * @dataProvider providerDeleteDomainFalse
     **/
    public function testNotDeleteCommand($domainname, $createdDate)
    {
        $registerDomain = new Domain();
        $registerDomain->create($domainname);
        $registerDomain->setCreatedDate($createdDate);

        $this->assertEquals(false, $registerDomain->canDeleteDomain());
    }

    public function testDeleteOk()
    {
        $registerDomain = new Domain();
        $domainName = 'maideit.be';

        $registerDomain->create($domainName);
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->Refunded = false;
        $result->MonthlyDeletesRemaining = 0;
        $result->RenewRefunded = false;
        $result->RenewMonthlyDeletesRemaining = 0;
        $result->TransferRefunded = false;
        $result->TransferMonthlyDeletesRemaining = 0;

        $data = new stdClass();
        $data->DeleteDomainResult = $result;

        $soapClientMock->expects($this->any())
            ->method('DeleteDomain')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->deleteDomain($registerDomain);
        $this->assertEquals(true, $response);
    }

    /**
     * @expectedException Exception
     */
    public function testDeleteNOK()
    {
        $registerDomain = new Domain();
        $domainName = 'maideit.be';

        $registerDomain->create($domainName);
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 260;
        $result->ResultMsg = 'Invalid Parameter: ForceDelete must be true. Refunds not available for .be domains';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';
        $result->Refunded = false;
        $result->MonthlyDeletesRemaining = 0;
        $result->RenewRefunded = false;
        $result->RenewMonthlyDeletesRemaining = 0;
        $result->TransferRefunded = false;
        $result->TransferMonthlyDeletesRemaining = 0;

        $data = new stdClass();
        $data->DeleteDomainResult = $result;
        $soapClientMock->expects($this->any())
            ->method('DeleteDomain')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $domain = $domainbox->domain();
        $response = $domain->deleteDomain($registerDomain);
    }
}
