<?php
	
	require_once '../../../php/Controller/DBclass.php';


	// Ordner anlegen, an welchem die Datei gespeichert werden soll 
	$dir = "C:\\xampp_1.8.2\htdocs\LagerBestand\Dokumente\Bestellungen\\" . $_POST['Händler'] . "\\" . $_POST['Bestelldatum'] ;
	$savedir = escapeshellarg($dir);
	$command = "mkdir " . $savedir;
	shell_exec($command ." 2>&1");

	// Datei die zu verschieben ist
	$datei = $dir . "\\" . $_FILES['File']['name'];

	if (move_uploaded_file($_FILES['File']['tmp_name'], $datei) ) {
		// mach garnix
	} else {
		echo'Fehler: <br /> Datei konnte nicht nach ' . $dir . ' verschoben werden. ';
	}

/**
  ** DATENBANK
   **/
	$DB = new DB;
	$DB->set_database('Lindorff_DB_Lager');
	$DB->_connect();

	$sql = " 	SELECT MAX(ID) AS Anzahl FROM Bestellung 	";
	$DB->set_sql( $sql );
	$DB->_query();
	$return = $DB->_fetch_array(1);

	$ID = $return[0]['Anzahl'] + 1;

	$sql = "	INSERT INTO Bestellung
					VALUES 
					( 
						" . $ID . ",
						' " . $_POST['Bestelldatum'] . " ',	
						' " . utf8_decode( $_POST['Besteller'] ) . " ',
						' " . $_POST['Händler'] . " ',
						' " . $_POST['Bestellnummer'] . " ',
						' " . nl2br( $_POST['Beschreibung'] ) . " ',
						'file:///" . $datei . " '						
					) 
			";
	print_r($sql);
	$DB->set_sql( $sql );
	$DB->_query();

	$DB->_close();

?>