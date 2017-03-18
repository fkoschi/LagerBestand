<?php 


// MYSQL CLASS

class mysql 
{
	private $HOSTNAME = '';
	private $USERNAME = '';
	private $PASSWORD = '';

	public function connect()
	{
		$conn = mysql_connect( $this->HOSTNAME , $this->USERNAME , $this->PASSWORD );

		if( !$conn )
		{
			die('Verbindung schlug fehl: ' . mysql_error() );
		}
		
		echo 'Erfolgreich verbunden!';
	}

	public function close()
	{
		mysql_close();
	}
}

?>