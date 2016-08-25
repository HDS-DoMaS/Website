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
	'SingleSignOnService'  => 'https://idp.fh-duesseldorf.de/idp/Authn/UserPassword',
	'certFingerprint'      => 'E74F9A7142E076AB5682D6254D484AB7846460D8',
	'AssertionConsumerService' => array (
		array(
			'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
			'Location' => 'https://domas.medien.hs-duesseldorf.de/simplesaml/module.php/saml/sp/saml2-acs.php/default-sptest',
			'index' => 0,
		),
		array(
			'Binding' => 'urn:oasis:names:tc:SAML:2.0:profiles:holder-of-key:SSO:browser',
			'Location' => 'https://domas.medien.hs-duesseldorf.de/simplesaml/module.php/saml/sp/saml2-acs.php/default-sp',
			'index' => 4,
		),
	),
	'SingleLogoutService' 		=> 'https://domas.medien.hs-duesseldorf.de/simplesaml/module.php/saml/sp/saml2-logout.php/default-sp',
);