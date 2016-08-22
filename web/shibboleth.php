<?php

// Session starten
session_start();

// Testsystem / Livesystem
$env = '';
if(isset($_GET['env'])) {
	if($_GET['env'] == 'dev') {
		$env = '/app_dev.php';
	}
}

// Übersetztung der Attribute
$attributes = array(
	'urn:oid:0.9.2342.19200300.100.1.1' => 'shibbolethUid',
	'urn:oid:1.3.6.1.4.1.5923.1.1.1.1' => 'rollen',
	'urn:oid:2.5.4.4' => 'nachname',
	'urn:oid:2.5.4.42' => 'vorname',
	'urn:oid:0.9.2342.19200300.100.1.3' => 'eMail'
);

// Shibboleth Authetication
require_once ('../simplesamlphp/lib/_autoload.php');
$as = new SimpleSAML_Auth_Simple('default-sp');
$as->requireAuth();

// Daten-Array aus Attributen erstellen
$data = array();
foreach ($as->getAttributes() as $key => $value) {
	if (array_key_exists($key, $attributes)) {
		$data[$attributes[$key]] = implode(';', $value);
	}
}

// Rolle ermitteln
$role = 'ROLE_STUDENT';
if (strpos($data['rollen'], 'professor')) {
	$role = 'ROLE_ADMIN';
} elseif (strpos($data['rollen'], 'employee')) {
	$role = 'ROLE_EMPLOYEE';
}

// Unique-Flag für Smyfony-Übergabe
$flag = md5(uniqid(rand(), true));

// Benutzer aktualisieren (INSERT OR UPDATE)
$sql = "INSERT INTO benutzer (
			shibboleth_Uid,
			Vorname,
			Nachname,
			E_Mail,
			domas_role,
			flag
		)
		VALUES (
			'" . $data['shibbolethUid'] . "',
			'" . $data['vorname'] . "',
			'" . $data['nachname'] . "',
			'" . $data['eMail'] . "',
			'" . $role . "',
			'" . $flag . "'
		) ON DUPLICATE KEY UPDATE 
			Vorname = '" . $data['vorname'] . "',
			Nachname = '" . $data['nachname'] . "',
			E_Mail = '" . $data['eMail'] . "',
			domas_role = '" . $role . "',
			flag = '" . $flag . "';";

$conn = new mysqli('127.0.0.1', 'domas', 'domas', 'domas');
$conn->query($sql);
$conn->close();

// Zu Symfony weiterleiten
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header("Location: " . $env . '/login/shibboleth/redirect/' . $flag);

die();