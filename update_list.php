<?php
function processBirthday($date) {
	$dateArray = explode('.', $date);
	if(count($dateArray) == 3)
		return $dateArray[2] . '-' . $dateArray[1] . '-' . $dateArray[0];

	return '';
}

echo 'ßä';
$data = file_get_contents('convertcsv-new.json');
$json = json_decode($data);
$fields = array();
foreach($json as $jsonItem) {


	$fieldsItem = array(
		'new-client-birthday' => processBirthday($jsonItem->geburtstag),
		'new-client-email' => $jsonItem->email,
		'new-client-phone' => str_replace("'", '', $jsonItem->rechnung_telefon),
		'new-client-address' => $jsonItem->rechnung_strasse . ' ' . $jsonItem->rechnung_plz . ' ' . $jsonItem->rechnung_stadt . ' ' . $jsonItem->rechnung_land,
	);

	if(isset($jsonItem->rechnung_vorname) && $jsonItem->rechnung_vorname != '' &&
		isset($jsonItem->rechnung_nachname) && $jsonItem->rechnung_nachname != '') {
		$fieldsItem['new-client-first-name'] = $jsonItem->rechnung_vorname;
		$fieldsItem['new-client-last-name'] = $jsonItem->rechnung_nachname;
	} else if(isset($jsonItem->rechnung_firma) && $jsonItem->rechnung_firma != '') {
		$fieldsItem['new-client-last-name'] = $jsonItem->rechnung_firma;
	}

	$fields[] = $fieldsItem;
}
//print_r($fields);die;
require_once("libs/smarty-3.0.8/libs/Smarty.class.php");
require_once("framework/main.php");

$appInit = new AppInit("framework"); // initialize the framework

DBWrapper::configure("localhost", "root", "", "miz_planner2"); // init the database connection
$db = DBWrapper::cloneInstance();

Autoloader::init("app"); // init the server

$db->query("SET NAMES utf8", null, null, false);
$clientsProxy = new ClientsProxy($db);
foreach($fields as $client)
	$clientsProxy->addClient($client);

echo 'done';