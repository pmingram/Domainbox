<?php

use MadeITBelgium\Domainbox\Domainbox;
use MadeITBelgium\Domainbox\Object\Nameserver;

class NameserverTest extends \PHPUnit_Framework_TestCase
{
    private $wsdl = 'tests/domainbox.wsdl';

    public function setUp()
    {
        parent::setUp();
    }

    public function testCreateNameserver()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';

        $data = new stdClass();
        $data->CreateNameserverResult = $result;

        $soapClientMock->expects($this->any())
            ->method('CreateNameserver')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $nameserver = $domainbox->nameserver();
        $response = $nameserver->createNameserver("domain.com", "ns1", ['192.168.1.1'], ['::1']);

        $this->assertTrue($response);
    }

    public function testModifyNameserver()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';

        $data = new stdClass();
        $data->ModifyNameserverResult = $result;

        $soapClientMock->expects($this->any())
            ->method('ModifyNameserver')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $nameserver = $domainbox->nameserver();
        $response = $nameserver->modifyNameserver("domain.com", "ns1", ['192.168.1.1'], ['::1'], ['192.168.1.1'], ['::1']);

        $this->assertTrue($response);
    }

    public function testDeleteNameserver()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $result = new stdClass();
        $result->ResultCode = 100;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';

        $data = new stdClass();
        $data->DeleteNameserverResult = $result;

        $soapClientMock->expects($this->any())
            ->method('DeleteNameserver')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $nameserver = $domainbox->nameserver();
        $response = $nameserver->deleteNameserver("domain.com", "ns1");
        $this->assertTrue($response);
    }
    
    public function testQueryNameserver()
    {
        $domainbox = new Domainbox('reseller', 'username', 'password', false);

        $soapClientMock = $this->getMockFromWsdl($this->wsdl);

        $ipv4 = new stdClass();
        $ipv4->string = '192.168.1.1';
        
        $ipv6 = new stdClass();
        $ipv6->string = '::1';
        
        $ips = new stdClass();
        $ips->IPv4Addresses = [$ipv4];
        $ips->IPv6Addresses = [$ipv6];
            
            
        $result = new stdClass();
        $result->IPAddresses = $ips;
        $result->ResultCode = 100;
        $result->CanDelete = true;
        $result->ResultMsg = 'Command Successful';
        $result->TxID = '102fa86c-7077-4fc2-8c1d-0a0a8aec5990';

        $data = new stdClass();
        $data->QueryNameserverResult = $result;

        $soapClientMock->expects($this->any())
            ->method('QueryNameserver')
            ->willReturn($data);

        $domainbox->setClient($soapClientMock);
        $nameserver = $domainbox->nameserver();
        $response = $nameserver->queryNameserver('domain.com', 'ns1');
        
        $this->assertEquals(['192.168.1.1'], $response->getIpv4());
        $this->assertEquals(['::1'], $response->getIpv6());
        $this->assertTrue($response->canDelete());
    }
}
