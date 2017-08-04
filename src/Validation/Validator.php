<?php

namespace MadeITBelgium\Domainbox\Validation;

use MadeITBelgium\Domainbox\Domainbox;
use MadeITBelgium\Domainbox\TLDs\TLD;

class Validator
{
    public function isDomainname($value)
    {
        $tlds = array_keys(TLD::getAllTLDs());
        $listTlds = '';
        foreach ($tlds as $tld) {
            $listTlds .= (strlen($listTlds) > 0 ? '|' : '').str_replace('.', "\.", substr($tld, 1));
        }

        $validation = "/^[a-z0-9][-a-z0-9]{0,62}\.(".$listTlds.')$/i';
        if (preg_match($validation, $value)) {
            return true;
        } else {
            return false;
        }
    }

    public function isDomainAvailable($value)
    {
        $domainbox = new Domainbox(config('domainbox.reseller'), config('domainbox.username'), config('domainbox.password'), config('domainbox.sandbox'));
        $domainname = $domainbox->domain()->checkDomainAvailability($value);

        return $domainname->isAvailable();
    }
}
