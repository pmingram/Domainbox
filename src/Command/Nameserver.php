<?php

namespace MadeITBelgium\Domainbox\Command;

use MadeITBelgium\Domainbox\Object\Nameserver as ObjectNameserver;

/**
 * Domainbox API.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2017 Made I.T. (http://www.madeit.be)
 * @author     Made I.T. <info@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Nameserver
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
     * CreateNameserver.
     *
     * @param $domainname
     * @param $hostname
     * @param $ipv4
     * @param $ipv6
     */
    public function createNameserver($domainname, $hostname, $ipv4 = [], $ipv6 = [])
    {
        $command = [
            'DomainName'  => $domainname,
            'HostName'    => $hostname,
            'IPAddresses' => [
                'IPv4Addresses' => [],
                'IPv6Addresses' => [],
            ],
        ];

        if (count($ipv4) > 0) {
            foreach ($ipv4 as $ip) {
                $command['IPv4Addresses'][] = ['string' => $ip];
            }
        }

        if (count($ipv6) > 0) {
            foreach ($ipv6 as $ip) {
                $command['IPv6Addresses'][] = ['string' => $ip];
            }
        }

        $response = $this->domainbox->call('CreateNameserver', $command);

        return true;
    }

    /**
     * ModifyNameserver.
     *
     * @param $domainname
     * @param $hostname
     * @param $addIpv4
     * @param $addIpv6
     * @param $addIpv6
     * @param $removeIpv4
     * @param $removeIpv6
     */
    public function modifyNameserver($domainname, $hostname, $addIpv4, $addIpv6, $removeIpv4, $removeIpv6)
    {
        $command = [
            'DomainName'     => $domainname,
            'HostName'       => $hostname,
            'AddIPAddresses' => [
                'IPv4Addresses' => [],
                'IPv6Addresses' => [],
            ],
            'RemoveIPAddresses' => [
                'IPv4Addresses' => [],
                'IPv6Addresses' => [],
            ],
        ];

        if (count($addIpv4) > 0) {
            foreach ($addIpv4 as $ip) {
                $command['AddIPAddresses']['IPv4Addresses'][] = ['string' => $ip];
            }
        }

        if (count($addIpv6) > 0) {
            foreach ($addIpv6 as $ip) {
                $command['AddIPAddresses']['IPv6Addresses'][] = ['string' => $ip];
            }
        }

        if (count($removeIpv4) > 0) {
            foreach ($removeIpv4 as $ip) {
                $command['RemoveIPAddresses']['IPv4Addresses'][] = ['string' => $ip];
            }
        }

        if (count($removeIpv6) > 0) {
            foreach ($removeIpv6 as $ip) {
                $command['RemoveIPAddresses']['IPv6Addresses'][] = ['string' => $ip];
            }
        }

        $response = $this->domainbox->call('ModifyNameserver', $command);

        return true;
    }

    /**
     * DeleteNameserver.
     *
     * @param $domainname
     * @param $hostname
     * @param $forceDelete
     */
    public function deleteNameserver($domainname, $hostname, $forceDelete = false)
    {
        $response = $this->domainbox->call('DeleteNameserver', [
            'DomainName'  => $domainname,
            'HostName'    => $hostname,
            'ForceDelete' => $forceDelete,
        ]);

        return true;
    }

    /**
     * QueryNameserver.
     *
     * @param $domainname
     * @param $hostname
     */
    public function QueryNameserver($domainname, $hostname)
    {
        $response = $this->domainbox->call('QueryNameserver', [
            'DomainName'    => $domainname,
            'HostName'      => $hostname,
        ]);

        $nameserver = new ObjectNameserver();
        $nameserver->loadData('QueryNameserver', $response);

        return $nameserver;
    }

    /**
     * CreateExternalNameserver.
     *
     * @param $tld
     * @param $nameserver
     */
    public function createExternalNameserver($tld, $nameserver)
    {
        $response = $this->domainbox->call('CreateExternalNameserver', ['NameserverAddress' => $nameserver, 'TLD' => $tld]);

        return true;
    }
}
