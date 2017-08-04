<?php

namespace MadeITBelgium\Domainbox\Object;

/**
 * Domainbox API.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2017 Made I.T. (http://www.madeit.be)
 * @author     Made I.T. <info@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Contact
{
    private $contactId;
    private $name;
    private $organisation;
    private $street1;
    private $street2;
    private $street3;
    private $city;
    private $state;
    private $postcode;
    private $countryCode;
    private $telephone;
    private $telephoneExtension;
    private $fax;
    private $email;

    public function __construct($name = null, $organisation = null, $street1 = null, $street2 = null, $street3 = null, $city = null, $state = null, $postcode = null, $countryCode = null, $telephone = null, $telephoneExtension = null, $fax = null, $email = null, $contactId = null)
    {
        $this->setName($name);
        $this->setOrganisation($organisation);
        $this->setStreet1($street1);
        $this->setStreet2($street2);
        $this->setStreet3($street3);
        $this->setCity($city);
        $this->setState($state);
        $this->setPostcode($postcode);
        $this->setCountryCode($countryCode);
        $this->setTelephone($telephone);
        $this->setTelephoneExtension($telephoneExtension);
        $this->setFax($fax);
        $this->setEmail($email);
        $this->setContactId($contactId);
    }

    public function loadData($command, $response)
    {
        if ($command == 'QueryContact') {
            $this->loadDataQueryContact($response);
        }
    }

    private function loadDataQueryContact($response)
    {
        $this->setName($response->Contact->Name);
        $this->setOrganisation($response->Contact->Organisation);
        $this->setStreet1($response->Contact->Street1);
        $this->setStreet2($response->Contact->Street2);
        $this->setStreet3($response->Contact->Street3);
        $this->setCity($response->Contact->City);
        $this->setState($response->Contact->State);
        $this->setPostcode($response->Contact->Postcode);
        $this->setCountryCode($response->Contact->CountryCode);
        $this->setTelephone($response->Contact->Telephone);
        $this->setTelephoneExtension($response->Contact->TelephoneExtension);
        $this->setFax($response->Contact->Fax);
        $this->setEmail($response->Contact->Email);
        $this->setContactId($response->Contact->ContactId);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getOrganisation()
    {
        return $this->organisation;
    }

    public function setOrganisation($organisation)
    {
        $this->organisation = $organisation;
    }

    public function getStreet1()
    {
        return $this->street1;
    }

    public function setStreet1($street1)
    {
        $this->street1 = $street1;
    }

    public function getStreet2()
    {
        return $this->street2 ?: '';
    }

    public function setStreet2($street2)
    {
        $this->street2 = $street2;
    }

    public function getStreet3()
    {
        return $this->street3 ?: '';
    }

    public function setStreet3($street3)
    {
        $this->street3 = $street3;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getPostcode()
    {
        return $this->postcode;
    }

    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    public function getTelephoneExtension()
    {
        return $this->telephoneExtension ?: '';
    }

    public function setTelephoneExtension($telephoneExtension)
    {
        $this->telephoneExtension = $telephoneExtension;
    }

    public function getFax()
    {
        return $this->fax ?: '';
    }

    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getContactId()
    {
        return $this->contactId;
    }

    public function setContactId($contactId)
    {
        $this->contactId = $contactId;
    }

    public function generateDomainboxCommand()
    {
        $data = [];
        if($this->contactId != 0 && $this->contactId != null) {
            $data['ContactId'] = $this->getContactId();
        }
        $data = $data + [
            'Name'               => $this->getName(),
            'Organisation'       => $this->getOrganisation(),
            'Street1'            => $this->getStreet1(),
            'Street2'            => $this->getStreet2(),
            'Street3'            => $this->getStreet3(),
            'City'               => $this->getCity(),
            'State'              => $this->getState(),
            'Postcode'           => $this->getPostcode(),
            'CountryCode'        => $this->getCountryCode(),
            'Telephone'          => $this->getTelephone(),
            'TelephoneExtension' => $this->getTelephoneExtension(),
            'Fax'                => $this->getFax(),
            'Email'              => $this->getEmail(),
        ];
        return $data;
    }
}
