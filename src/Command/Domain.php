<?php

namespace MadeITBelgium\Domainbox\Command;

use MadeITBelgium\Domainbox\Object\Domain as ObjectDomain;

/**
 * Domainbox API.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2017 Made I.T. (http://www.madeit.be)
 * @author     Made I.T. <info@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Domain
{
    private $domainbox;

    /**
     * Construct Domainbox.
     *
     * @param $domainbox
     */
    public function __construct($domainbox)
    {
        $this->domainbox = $domainbox;
    }

    /**
     * checkDomainAvailability.
     *
     * @param $domainname  The domainname the check
     * @param $launchPhase
     * @param $allowOfflineLookups
     * @param $numberOfRetries
     */
    public function checkDomainAvailability($domainname, $launchPhase = 'GA', $allowOfflineLookups = false, $numberOfRetries = 1)
    {
        $response = $this->domainbox->call('CheckDomainAvailability', [
            'DomainName'        => $domainname,
            'LaunchPhase'       => $launchPhase,
            'AdditionalOptions' => [
                'AllowOfflineLookups' => $allowOfflineLookups,
                'NumberOfRetries'     => $numberOfRetries,
            ],
        ]);

        $domain = new ObjectDomain();
        $domain->loadData('CheckDomainAvailability', $response);

        return $domain;
    }

    /**
     * checkDomainAvailability.
     *
     * @param $domainname  The domainname the check
     * @param $limit The maximum number of Domains to return for each domain check parameter. If CheckAtRegistry is set to true then the maximum value for Limit is 64. If CheckAtRegistry is set to false then the maximum value for Limit is 100. The Default value for the Limit is 10.
     * @param $checkAtRegistry
     * @param $numberOfRetries
     * @param $domainCheck
     * @param $nameSuggestions
     * @param $typoSuggestions
     * @param $prefixSuffixSuggestions
     * @param $prefix
     * @param $suffix
     * @param $premiumDomains
     */
    public function checkDomainAvailabilityPlus($domainname, $tlds = ['.com', '.be', '.nl', '.fr'], $limit = 10, $checkAtRegistry = true, $registryTimeout = 1000, $domainCheck = true, $nameSuggestions = true, $typoSuggestions = true, $prefixSuffixSuggestions = false, $prefix = '', $suffix = '', $premiumDomains = true)
    {
        $response = $this->domainbox->call('CheckDomainAvailabilityPlus', [
            'DomainName'              => $domainname,
            'TLDs'                    => $tlds,
            'Limit'                   => $limit,
            'CheckAtRegistry'         => $checkAtRegistry,
            'RegistryTimeout'         => $registryTimeout,
            'DomainCheck'             => ['Include' => $domainCheck],
            'NameSuggestions'         => ['Include' => $nameSuggestions],
            'TypoSuggestions'         => ['Include' => $typoSuggestions],
            'PrefixSuffixSuggestions' => ['Include' => $prefixSuffixSuggestions, 'Suffixes' => $suffix, 'Prefixes' => $prefix],
            'PremiumDomains'          => ['Include' => $premiumDomains],
        ]);

        $list = [];
        foreach ($response->DomainCheck->Domains as $data) {
            $domain = new ObjectDomain();
            $domain->loadData('CheckDomainAvailabilityPlus', $data);
            $list[] = $domain;
        }

        return $list;
    }

    /**
     * Register domainname.
     *
     * @param $domainname  The domainname the check
     * @param $launchPhase
     * @param $period
     */
    public function registerDomain($domain)
    {
        $response = $this->domainbox->call('RegisterDomain', $domain->generateDomainboxCommand());

        $domain->loadData('RegisterDomain', $response);

        return $domain;
    }

    /**
     * renew domainname.
     *
     * @param $domainname  The domainname to renew
     */
    public function renewDomain($domain, $period = 1)
    {
        $response = $this->domainbox->call('RenewDomain', [
            'DomainName'    => $domain->getDomainName(),
            'CurrentExpiry' => $domain->getExpiryDate(),
            'Period'        => $period, ]);

        $domain->loadData('RenewDomain', $response);

        return $domain;
    }

    /**
     * delete domainname.
     *
     * @param $domainname  The domainname to delete
     */
    public function deleteDomain($domain, $force = null)
    {
        $command = ['DomainName' => $domain->getDomainName()];
        if ($force === true) {
            $command['ForceDelete'] = true;
        } elseif ($force === false) {
            $command['ForceDelete'] = false;
        }

        $response = $this->domainbox->call('DeleteDomain', $command);

        return true;
    }

    /**
     * resend Domain Verification Email domainname.
     *
     * @param $domainname  The domainname
     */
    public function resendDomainVerificationEmail($domainname)
    {
        $response = $this->domainbox->call('ResendDomainVerificationEmail', ['DomainName' => $domainname]);

        return true;
    }

    /**
     * Query a specific domainname auth code.
     *
     * @param $domainname  The domainname the receive the authcode
     */
    public function queryDomainAuthcode($domain)
    {
        $response = $this->domainbox->call('QueryDomainAuthcode', ['DomainName' => $domain]);

        $domain = new ObjectDomain();
        $domain->loadData('QueryDomainAuthcode', $response);

        return $domain;
    }

    /**
     * Query a specific domainname.
     *
     * @param $domainname  The domainname the check
     */
    public function queryDomain($domain)
    {
        $response = $this->domainbox->call('QueryDomain', ['DomainName' => $domain]);

        $domain = new ObjectDomain();
        $domain->loadData('QueryDomain', $response);

        return $domain;
    }

    /**
     * Query a specific domainname lock status.
     *
     * @param $domainname  The domainname
     */
    public function queryDomainLock($domain)
    {
        $response = $this->domainbox->call('QueryDomainLock', ['DomainName' => $domain]);

        $domain = new ObjectDomain();
        $domain->loadData('QueryDomainLock', $response);

        return $domain;
    }

    /**
     * Query a specific domainname renewal settings.
     *
     * @param $domainname  The domainname
     */
    public function queryDomainRenewalSettings($domain)
    {
        $response = $this->domainbox->call('QueryDomainRenewalSettings', ['DomainName' => $domain]);

        $domain = new ObjectDomain();
        $domain->loadData('QueryDomainRenewalSettings', $response);

        return $domain;
    }

    /**
     * Query a specific domainname dates inf.
     *
     * @param $domainname  The domainname
     */
    public function queryDomainDates($domain)
    {
        $response = $this->domainbox->call('QueryDomainDates', ['DomainName' => $domain]);

        $domain = new ObjectDomain();
        $domain->loadData('QueryDomainDates', $response);

        return $domain;
    }

    /**
     * Query a specific domainname dates inf.
     *
     * @param $domainname  The domainname
     */
    public function queryDomainNameservers($domain)
    {
        $response = $this->domainbox->call('QueryDomainNameservers', ['DomainName' => $domain]);

        $domain = new ObjectDomain();
        $domain->loadData('QueryDomainNameservers', $response);

        return $domain;
    }

    /**
     * Query a specific domainname.
     *
     * @param $domainname  The domainname the check
     */
    public function QueryDomainContacts($domain)
    {
        $response = $this->domainbox->call('QueryDomainContacts', ['DomainName' => $domain]);

        $domain = new ObjectDomain();
        $domain->loadData('QueryDomainContacts', $response);

        return $domain;
    }

    /**
     * Query a specific domainname dates inf.
     *
     * @param $domainname  The domainname
     */
    public function queryDomainPrivacy($domain)
    {
        $response = $this->domainbox->call('QueryDomainPrivacy', ['DomainName' => $domain]);

        $domain = new ObjectDomain();
        $domain->loadData('QueryDomainPrivacy', $response);

        return $domain;
    }

    /**
     * Query a specific domainname dates inf.
     *
     * @param $domainname  The domainname
     */
    public function modifyDomainContacts($domainname, $type, $contact)
    {
        $response = $this->domainbox->call('ModifyDomainContacts', ['DomainName' => $domainname, 'Contacts' => [$type => $contact->generateDomainboxCommand()]]);

        $domain = new ObjectDomain();
        $domain->loadData('ModifyDomainContacts', $response);

        return $domain;
    }

    /**
     * Modify the domainname auth code.
     *
     * @param $domainname  The domainname
     * @param $generateNew  Boolean to generate new or create self
     * @param $authCode  String if generateNew is false
     * @param $authLockMode  'auto' or 'unlock'
     */
    public function modifyDomainAuthcode($domainname, $generateNew = true, $authCode = null, $autoLockMode = 'auto')
    {
        $command = ['DomainName' => $domainname, 'GenerateNew' => $generateNew, 'AutoLockMode' => $autoLockMode];
        if ($generateNew == false && $authCode != null) {
            $command['AuthCode'] = $authCode;
        }
        $response = $this->domainbox->call('ModifyDomainAuthcode', $command);

        $domain = new ObjectDomain();
        $domain->loadData('ModifyDomainAuthcode', $response);

        return $domain;
    }

    /**
     * Modify the domainname auth code.
     *
     * @param $domainname  The domainname
     * @param $applyLock  Boolean
     */
    public function modifyDomainLock($domainname, $applyLock)
    {
        $response = $this->domainbox->call('ModifyDomainLock', ['DomainName' => $domainname, 'ApplyLock' => $applyLock]);

        return true;
    }

    /**
     * Modify the domainname renewal settings.
     *
     * @param $domainname  The domainname
     * @param $applyLock  Boolean
     */
    public function modifyDomainRenewalSettings($domainname, $autoRenew = true, $autoRenewDays = 30)
    {
        $response = $this->domainbox->call('ModifyDomainRenewalSettings', ['DomainName' => $domainname, 'AutoRenew' => $autoRenew, 'AutoRenewDays' => $autoRenewDays]);

        $domain = new ObjectDomain();
        $domain->loadData('QueryDomainRenewalSettings', $response);

        return $domain;
    }

    /**
     * Modify the domainname privacy.
     *
     * @param $domainname  The domainname
     * @param $applyPrivacy  Boolean
     * @param $authLockMode  'auto' or 'unlock'
     */
    public function modifyDomainPrivacy($domainname, $applyPrivacy, $autoLockMode = 'auto')
    {
        $response = $this->domainbox->call('ModifyDomainPrivacy', ['DomainName' => $domainname, 'ApplyPrivacy' => $applyPrivacy, 'AutoLockMode' => $autoLockMode]);

        return true;
    }

    /**
     * Modify the domainname auth code.
     *
     * @param $domainname  The domainname
     * @param $applyPrivacy  Boolean
     * @param $authLockMode  'auto' or 'unlock'
     */
    public function modifyDomainRecords($domainname, $automatic = false, $autoLockMode = 'auto', $addRecords = null, $removeRecords = null)
    {
        $command = [
            'DomainName'   => $domainname,
            'Automatic'    => $automatic,
            'AutoLockMode' => $autoLockMode,
        ];

        if ($addRecords != null) {
            $command['AddRecords'] = [
                'Algorithm'  => $addRecords['Algorithm'],
                'KeyTag'     => $addRecords['KeyTag'],
                'DigestType' => $addRecords['DigestType'],
                'Digest'     => $addRecords['Digest'],
                'MaxLife'    => $addRecords['MaxLife'],
                'Flags'      => $addRecords['Flags'],
                'Protocol'   => $addRecords['Protocol'],
                'PublicKey'  => $addRecords['PublicKey'],
            ];
        }
        if ($removeRecords != null) {
            $command['RemoveRecords'] = [
                'Algorithm'  => $removeRecords['Algorithm'],
                'KeyTag'     => $removeRecords['KeyTag'],
                'DigestType' => $removeRecords['DigestType'],
                'Digest'     => $removeRecords['Digest'],
                'MaxLife'    => $removeRecords['MaxLife'],
                'Flags'      => $removeRecords['Flags'],
                'Protocol'   => $removeRecords['Protocol'],
                'PublicKey'  => $removeRecords['PublicKey'],
            ];
        }

        $response = $this->domainbox->call('ModifyDomainRecords', $command);

        return true;
    }
}
