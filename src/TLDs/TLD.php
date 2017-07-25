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

    protected $type = 'gTLD'; //gTLD, ccTLD, pTLD
    protected $launchPhase = 'GA'; //SR, LR, EAP, GA

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
    protected $domainRenewBeforeMax = null;
    protected $renewPeriods = [1]; //array with values

    protected $refund = false;
    protected $refundPeriodAdd = null;
    protected $refundPeriodTransfer = null;
    protected $refundPeriodRenew = null;
    protected $refundLimit = 0;

    protected $dnsVerification = false;
    protected $registerText = null;

    public function __construct()
    {
        if ($this->domainRenewBeforeMax == null) {
            $this->domainRenewBeforeMax = round(strtotime('-6months') / (60 * 60 * 24)); //6months
        }
    }

    public static function getAllTLDs($type = 'object')
    {
        $tlds = [];
        $phpFiles = scandir(__DIR__);
        foreach ($phpFiles as $fileName) {
            if (!in_array($fileName, ['.', '..', 'TLD.php', 'TLDGenerator.php'])) {
<<<<<<< HEAD
                if ($fileName == "Global.php") {
                    $className = "GlobalTld";
                }
                else {
                    $className = str_replace('.', '', substr($fileName, 0, strlen($fileName) - strlen('.php')));
                }
                $class = 'MadeITBelgium\\Domainbox\\TLDs\\' . $className;
=======
                $class = 'MadeITBelgium\\Domainbox\\TLDs\\'.str_replace('.', '', substr($fileName, 0, strlen($fileName) - strlen('.php')));
>>>>>>> aff88f5d8729e688afafc6cc7eebcf5711c89fb5
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

    public function setTld($tld)
    {
        $this->tld = $tld;
    }

    public function getIdnTLD()
    {
        return $this->idnTLD;
    }

    public function setIdnTLD($idnTLD)
    {
        $this->idnTLD = $idnTLD;
    }

    public function getDnsName()
    {
        return $this->dnsName;
    }

    public function setDnsName($dnsName)
    {
        $this->dnsName = $dnsName;
    }

    public function getPeriods()
    {
        return $this->periods;
    }

    public function setPeriods($periods)
    {
        $this->periods = $periods;
    }

    public function getFee_registry()
    {
        return $this->fee_registry;
    }

    public function setFee_registry($fee_registry)
    {
        $this->fee_registry = $fee_registry;
    }

    public function getFee_renew()
    {
        return $this->fee_renew;
    }

    public function setFee_renew($fee_renew)
    {
        $this->fee_renew = $fee_renew;
    }

    public function getFee_transfer()
    {
        return $this->fee_transfer;
    }

    public function setFee_transfer($fee_transfer)
    {
        $this->fee_transfer = $fee_transfer;
    }

    public function getFee_domainbox()
    {
        return $this->fee_domainbox;
    }

    public function setFee_domainbox($fee_domainbox)
    {
        $this->fee_domainbox = $fee_domainbox;
    }

    public function getFee_icann()
    {
        return $this->fee_icann;
    }

    public function setFee_icann($fee_icann)
    {
        $this->fee_icann = $fee_icann;
    }

    public function getFee_setup()
    {
        return $this->fee_setup;
    }

    public function setFee_setup($fee_setup)
    {
        $this->fee_setup = $fee_setup;
    }

    public function getFee_application()
    {
        return $this->fee_application;
    }

    public function setFee_application($fee_application)
    {
        $this->fee_application = $fee_application;
    }

    public function getFee_total()
    {
        return $this->fee_total;
    }

    public function setFee_total($fee_total)
    {
        $this->fee_total = $fee_total;
    }

    public function getFee_restore()
    {
        return $this->fee_restore;
    }

    public function setFee_restore($fee_restore)
    {
        $this->fee_restore = $fee_restore;
    }

    public function getFee_backorder()
    {
        return $this->fee_backorder;
    }

    public function setFee_backorder($fee_backorder)
    {
        $this->fee_backorder = $fee_backorder;
    }

    public function getNumberOfCategories()
    {
        return $this->numberOfCategories;
    }

    public function setNumberOfCategories($numberOfCategories)
    {
        $this->numberOfCategories = $numberOfCategories;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getLaunchPhase()
    {
        return $this->launchPhase;
    }

    public function setLaunchPhase($launchPhase)
    {
        $this->launchPhase = $launchPhase;
    }

    public function getApplyLock()
    {
        return $this->applyLock;
    }

    public function setApplyLock($applyLock)
    {
        $this->applyLock = $applyLock;
    }

    public function getAutoRenew()
    {
        return $this->autoRenew;
    }

    public function setAutoRenew($autoRenew)
    {
        $this->autoRenew = $autoRenew;
    }

    public function getAutoRenewDays()
    {
        return $this->autoRenewDays;
    }

    public function setAutoRenewDays($autoRenewDays)
    {
        $this->autoRenewDays = $autoRenewDays;
    }

    public function getAutoRenewDaysDefault()
    {
        return $this->autoRenewDaysDefault;
    }

    public function setAutoRenewDaysDefault($autoRenewDaysDefault)
    {
        $this->autoRenewDaysDefault = $autoRenewDaysDefault;
    }

    public function getApplyPrivacy()
    {
        return $this->applyPrivacy;
    }

    public function setApplyPrivacy($applyPrivacy)
    {
        $this->applyPrivacy = $applyPrivacy;
    }

    public function getAcceptTerms()
    {
        return $this->acceptTerms;
    }

    public function setAcceptTerms($acceptTerms)
    {
        $this->acceptTerms = $acceptTerms;
    }

    public function getNumberOfNameServers()
    {
        return $this->numberOfNameServers;
    }

    public function setNumberOfNameServers($numberOfNameServers)
    {
        $this->numberOfNameServers = $numberOfNameServers;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    public function setAdditionalData($additionalData)
    {
        $this->additionalData = $additionalData;
    }

    public function getLaunchDate()
    {
        return $this->launchDate;
    }

    public function setLaunchDate($launchDate)
    {
        $this->launchDate = $launchDate;
    }

    public function getDnssec()
    {
        return $this->dnssec;
    }

    public function setDnssec($dnssec)
    {
        $this->dnssec = $dnssec;
    }

    public function getIpv6()
    {
        return $this->ipv6;
    }

    public function setIpv6($ipv6)
    {
        $this->ipv6 = $ipv6;
    }

    public function getIpv4()
    {
        return $this->ipv4;
    }

    public function setIpv4($ipv4)
    {
        $this->ipv4 = $ipv4;
    }

    public function getCanChangeContact()
    {
        return $this->canChangeContact;
    }

    public function setCanChangeContact($canChangeContact)
    {
        $this->canChangeContact = $canChangeContact;
    }

    public function getCanChangeContactOrganisation()
    {
        return $this->canChangeContactOrganisation;
    }

    public function setCanChangeContactOrganisation($canChangeContactOrganisation)
    {
        $this->canChangeContactOrganisation = $canChangeContactOrganisation;
    }

    public function getCanChangeContactName()
    {
        return $this->canChangeContactName;
    }

    public function setCanChangeContactName($canChangeContactName)
    {
        $this->canChangeContactName = $canChangeContactName;
    }

    public function getCanChangeContactBirth()
    {
        return $this->canChangeContactBirth;
    }

    public function setCanChangeContactBirth($canChangeContactBirth)
    {
        $this->canChangeContactBirth = $canChangeContactBirth;
    }

    public function getCanChangeContactFax()
    {
        return $this->canChangeContactFax;
    }

    public function setCanChangeContactFax($canChangeContactFax)
    {
        $this->canChangeContactFax = $canChangeContactFax;
    }

    public function getCanChangeContactCountryCode()
    {
        return $this->canChangeContactCountryCode;
    }

    public function setCanChangeContactCountryCode($canChangeContactCountryCode)
    {
        $this->canChangeContactCountryCode = $canChangeContactCountryCode;
    }

    public function getCanChangeContactEntityType()
    {
        return $this->canChangeContactEntityType;
    }

    public function setCanChangeContactEntityType($canChangeContactEntityType)
    {
        $this->canChangeContactEntityType = $canChangeContactEntityType;
    }

    public function getCanChangeContactNationality()
    {
        return $this->canChangeContactNationality;
    }

    public function setCanChangeContactNationality($canChangeContactNationality)
    {
        $this->canChangeContactNationality = $canChangeContactNationality;
    }

    public function getCanChangeContactRegCode()
    {
        return $this->canChangeContactRegCode;
    }

    public function setCanChangeContactRegCode($canChangeContactRegCode)
    {
        $this->canChangeContactRegCode = $canChangeContactRegCode;
    }

    public function getDomainRenewBeforeMin()
    {
        return $this->domainRenewBeforeMin;
    }

    public function setDomainRenewBeforeMin($domainRenewBeforeMin)
    {
        $this->domainRenewBeforeMin = $domainRenewBeforeMin;
    }

    public function getDomainRenewBeforeMax()
    {
        return $this->domainRenewBeforeMax;
    }

    public function setDomainRenewBeforeMax($domainRenewBeforeMax)
    {
        $this->domainRenewBeforeMax = $domainRenewBeforeMax;
    }

    public function getRenewPeriods()
    {
        return $this->renewPeriods;
    }

    public function setRenewPeriods($renewPeriods)
    {
        $this->renewPeriods = $renewPeriods;
    }

    public function getRefund()
    {
        return $this->refund;
    }

    public function setRefund($refund)
    {
        $this->refund = $refund;
    }

    public function getRefundPeriodAdd()
    {
        return $this->refundPeriodAdd;
    }

    public function setRefundPeriodAdd($refundPeriodAdd)
    {
        $this->refundPeriodAdd = $refundPeriodAdd;
    }

    public function getRefundPeriodTransfer()
    {
        return $this->refundPeriodTransfer;
    }

    public function setRefundPeriodTransfer($refundPeriodTransfer)
    {
        $this->refundPeriodTransfer = $refundPeriodTransfer;
    }

    public function getRefundPeriodRenew()
    {
        return $this->refundPeriodRenew;
    }

    public function setRefundPeriodRenew($refundPeriodRenew)
    {
        $this->refundPeriodRenew = $refundPeriodRenew;
    }

    public function getRefundLimit()
    {
        return $this->refundLimit;
    }

    public function setRefundLimit($refundLimit)
    {
        $this->refundLimit = $refundLimit;
    }
}
