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

    protected $periods = [1];
    protected $fee_registry = 0.00;
    protected $fee_renew = 0.00;
    protected $fee_transfer = 0.00;
    protected $fee_domainbox = 0.00;
    protected $fee_icann = 0.00;
    protected $fee_setup = 0.00;
    protected $fee_application = 0.00;
    protected $fee_total = 0.00;
    protected $fee_restore = 0.00;
    protected $fee_backorder = 0.00;
    protected $numberOfCategories = 0;
    protected $categories = null;

    protected $type = "gTLD"; //gTLD, ccTLD, pTLD
    protected $launchPhase = "GA"; //SR, LR, EAP, GA

    protected $applyLock = false;
    protected $autoRenew = true;
    protected $autoRenewDays = null;
    protected $autoRenewDaysDefault = 14;
    protected $applyPrivacy = false;
    protected $acceptTerms = true;
    protected $numberOfNameServers = 13;

    protected $extension = null;
    protected $additionalData = null;

    protected $launchDate = null;
    protected $dnssec = false;
    protected $ipv6 = true;
    protected $ipv4 = true;
    

    protected $canChangeContact = true;
    protected $canChangeContactOrganisation = true;
    protected $canChangeContactName = true;
    protected $canChangeContactBirth = false;
    protected $canChangeContactFax = true;
    protected $canChangeContactCountryCode = true;
    protected $canChangeContactEntityType = true;
    protected $canChangeContactNationality = true;
    protected $canChangeContactRegCode = false;
    
    protected $domainRenewBeforeMin = 0; //0days
    protected $domainRenewBeforeMax = round(strtotime('-6months') / (60*60*24)); //6months
    protected $renewPeriods = [1]; //array with values

    protected $refund = false;
    protected $refundPeriodAdd = null;
    protected $refundPeriodTransfer = null;
    protected $refundPeriodRenew = null;
    protected $refundLimit = 0;
    
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
