<?php

	require_once '../../../php/Plugins/PHPWord/PHPWord.php';

	require_once '../../../php/Controller/DBclass.php';

	$PHPWord = new PHPWord();

	$document = $PHPWord->loadTemplate('../../../php/Plugins/PHPWord/Examples/Leihschein_Template.docx');

	$document->setValue('name' , utf8_decode($_GET['name']) );
	$document->setValue('abteilung' , utf8_decode($_GET['abteilung']) );
	$document->setValue('gegenstand' , utf8_decode($_GET['gegenstand']) );
	$document->setValue('gegenstand_beschreibung' , utf8_decode($_GET['gegenstand_beschreibung']) );
	$document->setValue('seriennummer' , utf8_decode($_GET['seriennummer']) );
	$document->setValue('leihdauer' , utf8_decode($_GET['leihdauer']) );
	$document->setValue('leihgrund' , utf8_decode($_GET['leihgrund']) );
	$document->setValue('zeile1' , utf8_decode($_GET['zeile1']) );
	$document->setValue('zeile2' , utf8_decode($_GET['zeile2']) );
	$document->setValue('zeile3' , utf8_decode($_GET['zeile3']) );
	$document->setValue('datum' , utf8_decode($_GET['datum']) );

	$document->save('../../../Dokumente/Leihscheine/offen/'.$_GET['gegenstand'].'/Leihschein_'.utf8_decode($_GET['gegenstand']).'-'.utf8_decode($_GET['gegenstand_beschreibung']).'-'.utf8_decode($_GET['seriennummer']).'.docx');

	$dokumentpfad = "file:///C:/xampp_1.8.2/htdocs/LagerBestand/Dokumente/Leihscheine/offen/".$_GET['gegenstand']."/Leihschein_".utf8_decode($_GET['gegenstand'])."-".utf8_decode($_GET['gegenstand_beschreibung'])."-".utf8_decode($_GET['seriennummer']).".docx";
	
	$DB = new DB;
	
	$DB->set_database('Lindorff_DB_Lager');
	$DB->_connect();

	$sql = "SELECT MAX(ID) AS Nr FROM Leihschein";
	$DB->set_sql( $sql ); 
	$DB->_query();
	$nummer = $DB->_fetch_array(1);
	$Nr = $nummer[0]['Nr'] + 1;

	$sql = " INSERT INTO Leihschein 
				VALUES ( ' " .$Nr." ' ,
						 ' " .utf8_decode($_GET['name']). " ' , 
						 ' " .utf8_decode($_GET['abteilung'])." ' ,
						 ' " .utf8_decode($_GET['gegenstand']) . ":" . utf8_decode($_GET['gegenstand_beschreibung'])." ' ,
						 ' " .utf8_decode($_GET['seriennummer'])." ' ,
						 ' " .$_GET['datum']."' ,
						 ' " .utf8_decode($_GET['leihdauer'])." ' ,
						 ' " .utf8_decode($_GET['leihgrund'])." ' , 
						 'offen' ,
						 '".$dokumentpfad."' ) ";
	
	$DB->set_sql( $sql );
	$DB->_query();

	$DB->_close();
?>