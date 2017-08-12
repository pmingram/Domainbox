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
class Nameserver
{
    private $ipv4 = [];
    private $ipv6 = [];
    private $canDelete;

    public function __construct()
    {
        
    }

    public function loadData($command, $data)
    {
        if ($command == 'QueryNameserver') {
            $this->loadQueryNameserver($data);
        }
    }

    private function loadQueryNameserver($data)
    {
        foreach($data->IPAddresses->IPv4Addresses as $ip) 
        {
            $this->addIpv4($ip->string);
        }
        
        foreach($data->IPAddresses->IPv6Addresses as $ip)
        {
            $this->addIpv6($ip->string);
        }
        $this->setCanDelete($data->CanDelete);
    }
    
    public function getIpv4()
    {
        return $this->ipv4;
    }
    
    public function setIpv4($ipv4)
    {
        $this->ipv4 = $ipv4;
    }
    
    public function addIpv4($ipv4)
    {
        $this->ipv4[] = $ipv4;
    }
    
    public function getIpv6()
    {
        return $this->ipv6;
    }
    
    public function setIpv6($ipv6)
    {
        $this->ipv6 = $ipv6;
    }
    
    public function addIpv6($ipv6)
    {
        $this->ipv6[] = $ipv6;
    }
    
    public function canDelete()
    {
        return $this->canDelete;
    }
    
    public function setCanDelete($canDelete)
    {
        $this->canDelete = $canDelete;
    }
}
