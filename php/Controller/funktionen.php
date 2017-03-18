<?php 
	
	/**
	 ** KLASSE DIE DEN ZUGRIFF AUF 
	 ** VERSCHIEDENE STANDARD-FUNKTIONEN
	 ** LIEFERT 
	 **/

	require_once 'DBclass.php';

	/**
	* 
	*/
	class Funktionen extends DB
	{				

		protected function __connectToDatabase( $database )
		{			
			DB::set_database( $database );
			DB::_connect();
		}

		/**
		 	** TABELLE : [Nutzer_Kontakt]
		 **/ 
		public function get_allNutzerKontakt()
		{			
			self::__connectToDatabase( 'Lindorff_DB_Lager' );

			$sql = 	" 
					SELECT
						NutzerKontaktID,
						Vorname, 
						Nachname

					FROM Nutzer_Kontakt				

					";
			DB::set_sql( $sql );
			DB::_query();
			$result = DB::_fetch_array(1);
			echo "<pre>";		
			var_dump( $result );
			echo "</pre>";

			parent::_num_rows();

			DB::_close();
		}
		/*
		public function create_newNutzerKontakt( $Vorname , $Nachname , $Email )
		{
			$this->_connectToDatabase();

			$sql = 	"
						INSERT INTO Nutzer_Kontakt
						VALUES ( 0 , 0 , '".$Vorname."' , '".$Nachname."' , '".$Email."' )
					";
			$DB->set_sql( $sql );
			$DB->_query();
			$DB->_close();
		}
		*/
	}

?>