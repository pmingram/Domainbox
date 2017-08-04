# Changelog

## V0.4.0 (04/08/2017)
- Validator
- Additonal API support:

| Endpoint                                | SDK Class::Function                             | Output            | Version |
|-----------------------------------------|-------------------------------------------------|-------------------|---------|
| ResendDomainVerificationEmail           | Domain::resendDomainVerificationEmail()         | Boolean           | 0.4.0   |
| ModifyDomainContacts                    | Domain::modifyDomainContacts()                  | Domain            | 0.4.0   |
| ModifyDomainAuthcode                    | Domain::modifyDomainAuthcode()                  | Domain            | 0.4.0   |
| ModifyDomainLock                        | Domain::modifyDomainLock()                      | Boolean           | 0.4.0   |
| ModifyDomainRenewalSettings             | Domain::ModifyDomainRenewalSettings()           | Domain            | 0.4.0   |
| ModifyDomainPrivacy                     | Domain::ModifyDomainPrivacy()                   | Boolean           | 0.4.0   |
| ModifyDomainRecords                     | Domain::ModifyDomainRecords()                   | Boolean           | 0.4.0   |
| QueryDomainAuthcode                     | Domain::queryDomainAuthCode()                   | Domain            | 0.4.0   |
| QueryDomainLock                         | Domain::queryDomainLock()                       | Domain            | 0.4.0   |
| QueryDomainRenewalSettings              | Domain::queryDomainRenewalSettings()            | Domain            | 0.4.0   |
| QueryDomainDates                        | Domain::queryDomainDates()                      | Domain            | 0.4.0   |
| QueryDomainNameservers                  | Domain::queryDomainNameservers()                | Domain            | 0.4.0   |
| QueryDomainContacts                     | Domain::queryDomainContacts()                   | Domain            | 0.4.0   |
| QueryDomainPrivacy                      | Domain::QueryDomainPrivacy()                    | Domain            | 0.4.0   |

## V0.3.2 (25/07/2017)
- Bug fixes

## V0.3.1 (25/07/2017)
- Bug fixes

## V0.3.0 (24/07/2017)
- Support for all TLDs

## V0.2.0 (07/07/2017)
- Json API replaced with SOAP API

## V0.1.0 (06/07/2017)
- Json API support
- CheckDomainAvailability
- CheckDomainAvailabilityPlus
- RegisterDomain
- RenewDomain
- DeleteDomain
- CreateContact
- ModifyContact
- QueryContact
- DeleteContact
- QueryDomain
