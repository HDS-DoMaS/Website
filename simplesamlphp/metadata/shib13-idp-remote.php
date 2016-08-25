<?php
/**
 * SAML 1.1 remote IdP metadata for SimpleSAMLphp.
 *
 * Remember to remove the IdPs you don't use from this file.
 *
 * See: https://simplesamlphp.org/docs/stable/simplesamlphp-reference-idp-remote
 */

/*
$metadata['theproviderid-of-the-idp'] = array(
	'SingleSignOnService'  => 'https://idp.example.org/shibboleth-idp/SSO',
	'certFingerprint'      => 'c7279a9f28f11380509e072441e3dc55fb9ab864',
);
*/
$metadata['https://idp.fh-duesseldorf.de/idp/shibboleth'] = array(
    'name' => 'DoMaS',
	'description' => 'Archivierungssystem der Hochschule Düsseldorf',
	'SingleSignOnService' => 'https://idp.fh-duesseldorf.de/idp/profile/SAML2/Redirect/SSO',
	'certFingerprint'      => 'E74F9A7142E076AB5682D6254D484AB7846460D8',
	'AssertionConsumerService' => 'https://domas.medien.hs-duesseldorf.de/simplesaml/module.php/saml/sp/saml2-acs.php/default-sp',
	'SingleLogoutService' 		=> 'https://domas.medien.hs-duesseldorf.de/simplesaml/module.php/saml/sp/saml2-logout.php/default-sp',
);