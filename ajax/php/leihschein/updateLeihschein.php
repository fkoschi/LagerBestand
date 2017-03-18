<?php
	
	/// UPDATE LEIHSCHEIN 

	require_once '../../../php/Controller/DBclass.php';

	if ( !empty($_GET) )
	{
		if ( $_GET['function'] == 'updateStatusLeihschein' )
		{
			updateStatusLeihschein($_GET['id']);
		}
	}

	function updateStatusLeihschein($ID) 
	{
		$DB = new DB;
		$DB->set_database('Lindorff_DB_Lager');
		$DB->_connect();

		$sql = 	"
					SELECT Dokument
					FROM [Leihschein]
					WHERE ID = ".$ID."
				";
		$DB->set_sql($sql);
		$DB->_query();		

		$result = $DB->_fetch_array(1);

		$pfad = explode('///', $result[0]['Dokument']);
		$zu_verschieben_in = str_replace('offen', 'erledigt', $pfad[1]);
		
		$shell_command = 'move ' . $pfad[1] . ' ' . $zu_verschieben_in;

		shell_exec( escapeshellcmd($shell_command) );

		$sql = 	"
					UPDATE [Leihschein]
					SET Status 		= 'erledigt',
						Dokument 	= 'file:///".$zu_verschieben_in."'
					WHERE ID = ".$ID."
				";
		$DB->set_sql( $sql );
		$DB->_query();

		$DB->_close();
	}

?>