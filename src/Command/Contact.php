<?php

namespace MadeITBelgium\Domainbox\Command;

use MadeITBelgium\Domainbox\Object\Contact as ObjectContact;

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
    private $domainbox;

    /**
     * set Domainbox.
     *
     * @param $domainbox
     */
    public function setDomainbox($domainbox)
    {
        $this->domainbox = $domainbox;
    }
    
    /**
     * get Domainbox.
     *
     * @param $domainbox
     */
    public function getDomainbox()
    {
        return $this->domainbox;
    }

    /**
     * createContact.
     *
     * @param $contact
     */
    public function createContact($contact, $tld, $launchPhase = 'GA')
    {
        $response = $this->domainbox->call('CreateContact', [
            'TLD'         => $tld,
            'LaunchPhase' => $launchPhase,
            'Contact'     => [
                'Name'               => $contact->getName(),
                'Organisation'       => $contact->getOrganisation(),
                'Street1'            => $contact->getStreet1(),
                'Street2'            => $contact->getStreet2(),
                'Street3'            => $contact->getStreet3(),
                'City'               => $contact->getCity(),
                'State'              => $contact->getState(),
                'Postcode'           => $contact->getPostcode(),
                'CountryCode'        => $contact->getCountryCode(),
                'Telephone'          => $contact->getTelephone(),
                'TelephoneExtension' => $contact->getTelephoneExtension(),
                'Fax'                => $contact->getFax(),
                'Email'              => $contact->getEmail(),
            ],
        ]);

        $contact->setContactId($response['d']['ContactId']);

        return $contact;
    }

    /**
     * ModifyContact.
     *
     * @param $contact
     */
    public function modifyContact($contact)
    {
        $response = $this->domainbox->call('ModifyContact', [
            'TLD'         => $tld,
            'LaunchPhase' => $launchPhase,
            'Contact'     => [
                'Name'               => $contact->getName(),
                'Organisation'       => $contact->getOrganisation(),
                'Street1'            => $contact->getStreet1(),
                'Street2'            => $contact->getStreet2(),
                'Street3'            => $contact->getStreet3(),
                'City'               => $contact->getCity(),
                'State'              => $contact->getState(),
                'Postcode'           => $contact->getPostcode(),
                'CountryCode'        => $contact->getCountryCode(),
                'Telephone'          => $contact->getTelephone(),
                'TelephoneExtension' => $contact->getTelephoneExtension(),
                'Fax'                => $contact->getFax(),
                'Email'              => $contact->getEmail(),
            ],
        ]);

        return $contact;
    }

    /**
     * queryContact.
     *
     * @param $contactId
     */
    public function queryContact($contactId)
    {
        $response = $this->domainbox->call('QueryContact', [
            'ContactId'        => $contactId,
        ]);

        $contact = new ObjectContact();
        $contact->loadData('QueryContact', $response);

        return $contact;
    }

    /**
     * DeleteContact.
     *
     * @param $contact
     */
    public function deleteContact($contact)
    {
        $response = $this->domainbox->call('DeleteContact', [
            'ContactId'        => $contact->getContactId(),
        ]);

        return true;
    }
}
