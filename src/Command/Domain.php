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
    protected $version = '1.0.0';
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
        foreach ($response['d']['DomainCheck']['Domains'] as $data) {
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

        $domain = new ObjectDomain();
        $domain->loadData('RegisterDomain', $response);

        return $domain;
    }
}
