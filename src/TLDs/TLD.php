<?php

namespace MadeITBelgium\Domainbox\TLDs;

/**
 * Domainbox API.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2017 Made I.T. (http://www.madeit.be)
 * @author     Made I.T. <info@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class TLD
{
    private $tld;
    private $idnTLD;
    private $dnsName;

    private $periods;
    private $fee_registry;
    private $fee_renew;
    private $fee_transfer;
    private $fee_domainbox;
    private $fee_icann;
    private $fee_setup;
    private $fee_application;
    private $fee_total;
    private $fee_restore;
    private $fee_backorder;
    private $numberOfCategories;
    private $categories;

    private $type; //gTLD, ccTLD, pTLD
    private $launchPhase; //SR, LR, EAP, GA

    private $applyLock;
    private $autoRenew;
    private $autoRenewDays;
    private $autoRenewDaysDefault;
    private $applyPrivacy;
    private $acceptTerms;
    private $numberOfNameServers;

    private $extension;

    private $launchDate;
    private $dnssec;
    private $ipv6;
    private $ipv4;

    private $canCHangeContact;
    private $canChangeContactOrganisation;
    private $canChangeContactName;
    private $canChangeContactBirth;
    private $canChangeContactFax;
    private $canChangeContactCountryCode;
    private $canChangeContactEntityType;
    private $canChangeContactNationality;
    private $canChangeContactRegCode;

    private $domainRenewBeforeMin; //0days
    private $domainRenewBeforeMax; //6months
    private $renewPeriods; //array with values

    public function __construct()
    {
    }

    public static function getAllTLDs($type = 'object')
    {
        $tlds = [];
        $phpFiles = scandir(__DIR__);
        foreach ($phpFiles as $fileName) {
            if (!in_array($fileName, ['.', '..', 'TLD.php'])) {
                $class = 'MadeITBelgium\\Domainbox\\TLDs\\'.substr($fileName, 0, strpos($fileName, '.'));
                $object = new $class();
                if ($type == 'object') {
                    $tlds[$object->getTld()] = $object;
                } elseif ($type == 'array') {
                    $tlds[] = $object->getTld();
                }
            }
        }

        return $tlds;
    }

    public function getTld()
    {
        return $this->tld;
    }
}
