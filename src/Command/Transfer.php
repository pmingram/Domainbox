<?php

namespace MadeITBelgium\Domainbox\Command;

use MadeITBelgium\Domainbox\Object\Domain as ObjectDomain;

/**
 * Domainbox API.
 *
 * @version    0.6.0
 *
 * @copyright  Copyright (c) 2017 Made I.T. (http://www.madeit.be)
 * @author     Made I.T. <info@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Transfer
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
     * CheckTransferAvailability.
     *
     * @param $domainname  The domainname the check
     * @param $launchPhase
     * @param $allowOfflineLookups
     * @param $numberOfRetries
     */
    public function checkTransferAvailabilty($domainname)
    {
        $response = $this->domainbox->call('CheckTransferAvailability', [
            'DomainName'        => $domainname,
        ]);

        $domain = new ObjectDomain();
        $domain->loadData('CheckTransferAvailability', $response);

        return $domain;
    }

    /**
     * Transfer domainname.
     *
     * @param $domainname  The domainname the check
     */
    public function transferDomain($domain)
    {
        $response = $this->domainbox->call('RequestTransfer', $domain->generateTransferDomainboxCommand());

        $domain->loadData('TransferDomain', $response);

        return $domain;
    }

    /**
     * renew domainname.
     *
     * @param $domainname  The domainname to query the transfer status
     */
    public function queryTransfer($domainname)
    {
        $response = $this->domainbox->call('QueryTransfer', ['DomainName' => $domainname]);

        $domain = new ObjectDomain();
        $domain->loadData('QueryTransfer', $response);

        return $domain;
    }

    /**
     * delete domainname.
     *
     * @param $domainname  The domainname to delete
     * @param $domainid    The domainname ID
     */
    public function cancelTransfer($domainname, $domainId)
    {
        $response = $this->domainbox->call('CancelTransfer', ['DomainName' => $domainname, 'DomainId' => $domainId]);

        return true;
    }

    /**
     * resend transfer Verification Email domainname.
     *
     * @param $domainname  The domainname
     * @param $domainid    The domainname ID
     */
    public function resendTransferAdminEmail($domainname, $domainId)
    {
        $response = $this->domainbox->call('ResendTransferAdminEmail', ['DomainName' => $domainname, 'DomainId' => $domainId]);

        $domain = new ObjectDomain();
        $domain->loadData('ResendTransferAdminEmail', $response);

        return $domain;
    }

    /**
     * Restarts the transfer afresh, as if RequestTransfer had been issued.
     *
     * @param $domainname  The domainname the receive the authcode
     * @param $domainid    The domainname ID
     */
    public function restartTransfer($domainname, $domainId)
    {
        $response = $this->domainbox->call('RestartTransfer', ['DomainName' => $domainname, 'DomainId' => $domainId]);

        return true;
    }

    public function getLastResultCode()
    {
        return $this->domainbox->getLastResultCode();
    }

    public function getLastResultMessage()
    {
        $this->domainbox->getLastResultMessage();
    }
}
