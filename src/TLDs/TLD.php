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
    protected $tld;
    protected $idnTLD;
    protected $dnsName;

    protected $periods;
    protected $fee_registry;
    protected $fee_renew;
    protected $fee_transfer;
    protected $fee_domainbox;
    protected $fee_icann;
    protected $fee_setup;
    protected $fee_application;
    protected $fee_total;
    protected $fee_restore;
    protected $fee_backorder;
    protected $numberOfCategories;
    protected $categories;

    protected $type; //gTLD, ccTLD, pTLD
    protected $launchPhase; //SR, LR, EAP, GA

    protected $applyLock;
    protected $autoRenew;
    protected $autoRenewDays;
    protected $autoRenewDaysDefault;
    protected $applyPrivacy;
    protected $acceptTerms;
    protected $numberOfNameServers;

    protected $extension;

    protected $launchDate;
    protected $dnssec;
    protected $ipv6;
    protected $ipv4;

    protected $canCHangeContact;
    protected $canChangeContactOrganisation;
    protected $canChangeContactName;
    protected $canChangeContactBirth;
    protected $canChangeContactFax;
    protected $canChangeContactCountryCode;
    protected $canChangeContactEntityType;
    protected $canChangeContactNationality;
    protected $canChangeContactRegCode;
    
    protected $domainRenewBeforeMin; //0days
    protected $domainRenewBeforeMax; //6months
    protected $renewPeriods; //array with values

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
