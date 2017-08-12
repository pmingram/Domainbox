<?php

return [
  'reseller' => env('DOMAINBOX_RESELLER'),
  'username' => env('DOMAINBOX_USERNAME'),
  'password' => env('DOMAINBOX_PASSWORD'),

  'sandbox' => env('DOMAINBOX_SANDBOX', false),
  'client'  => null,
];
