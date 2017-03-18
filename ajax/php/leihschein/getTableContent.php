<?php

	require_once '../../../php/Controller/DBclass.php';

	
	$suche = "";
	createPagination( 5, 1);
	switch( $_GET['method'] )
	{
		case 'all':
			getAll($suche);
			break;
		case 'open':
			getOpen($suche);
			break;
		default:
			getAll("");
			break;
	}	

	function getAll( $suche )
	{		
		$DB = new DB;	
		$DB->set_database('Lindorff_DB_Lager');
		$DB->_connect();
		$sql = " SELECT ID, 
						An,
						Abteilung,
						Gegenstand,
						Seriennummer,
						Datum,
						Leihdauer,
						Leihgrund,
						Status,
						Dokument												
				 FROM Leihschein
				 ORDER BY ID				 			 
				";
	
			$DB->set_sql( $sql );
			$DB->_query();
			
			$result = $DB->_fetch_array(1);
			// Ausgabe der Ergebnisse 
			foreach ($result as $value)
			{
				if ( $value['Status'] == 'offen' )
				{
					echo "<tr class='info'>";
						echo "<td>".$value['ID']."</td>";
						echo "<td>".utf8_encode($value['An'])."</td>";
						echo "<td>".utf8_encode($value['Gegenstand'])."</td>";
						echo "<td>".$value['Seriennummer']."</td>";
						echo "<td>".$value['Datum']."</td>";
						echo "<td><a href='".$value['Dokument']."'></a></td>";
						echo "<td class='check'><button type='button' name='openRückgabeLeihscheinModal' data-nummer=".$value['ID']." class='fa fa-check' id='check' data-toggle='modal' data-target='#returnLeihschein'></button></td>";	
					echo "</tr>";
				}
				else
				{
					echo "<tr>";
						echo "<td>".$value['ID']."</td>";
						echo "<td>".utf8_encode($value['An'])."</td>";
						echo "<td>".$value['Gegenstand']."</td>";
						echo "<td>".$value['Seriennummer']."</td>";
						echo "<td>".$value['Datum']."</td>";
						echo "<td><a href='".$value['Dokument']."'></a></td>";					
						echo "<td></td>";
					echo "</tr>";
				}
			}
		$DB->_close();

		createPagination( 'all' );
	}

	function getOpen( $suche ) 
	{
		$DB = new DB;	
		$DB->set_database('Lindorff_DB_Lager');
		$DB->_connect();
		$sql = " SELECT ID,
						An,
						Abteilung,
						Gegenstand,
						Seriennummer,
						Datum,
						Leihdauer,
						Leihgrund,
						Status,
						Dokument
				 FROM Leihschein
				 WHERE Status = 'offen'
				 ORDER BY ID
				 ";

		$DB->set_sql( $sql );
		$DB->_query();

		$result = $DB->_fetch_array(1);

		foreach ($result as $value)
			{
				echo "<tr>";
					echo "<td>".$value['ID']."</td>";
					echo "<td>".utf8_encode($value['An'])."</td>";
					echo "<td>".utf8_encode($value['Gegenstand'])."</td>";
					echo "<td>".$value['Seriennummer']."</td>";
					echo "<td>".$value['Datum']."</td>";
					echo "<td><a href='".$value['Dokument']."'></a></td>";
					echo "<td><i class='fa fa-check' name='openRückgabeLeihscheinModal' data-nummer=".$value['ID']." data-toggle='modal' data-target='#returnLeihschein'></i></td>";	
				echo "</tr>";
			}	
		$DB->_close();
	}
	
	
	function createPagination( $border )
	{
		if ( $border == 'all' )
		{
			$sql = " SELECT COUNT(ID) AS Anzahl FROM [Leihschein] WHERE Status = 'offen' OR Status = 'erledigt' ";
		} else {
			$sql = " SELECT COUNT(ID) AS Anzahl FROM [Leihschein] WHERE Status = 'offen' AND Status != 'erledigt' ";
		}

		$DB = new DB;
		$DB->set_database('Lindorff_DB_Lager');
		$DB->_connect();
		$DB->set_sql($sql);
		$DB->_query();

		$result = $DB->_fetch_array(1);
		$counter = $result[0]['Anzahl'];

		$_counter = $counter / 13;

		$page = 1;

		if( !is_float($_counter) ) // int
		{
			$pages = $_counter;
		} 
		else 	// float  
		{
			$pages = floor($_counter) + 1;
		}

			echo '<ul id="pagination" class="pagination pagination-sm">';
				if ( $page == 1 )
				{
					echo ' <li class="disabled"><a href="#" class="prev">&laquo;</a></li>';
				}
				else 
				{
					echo '	<li class=""><a href="#" class="prev">&laquo;</a></li>';	
				}
					
				for ( $i = 1; $i <= $pages; $i++ )
				{
					if ( $i == $page )
					{
						echo '<li class="active" ><a href="#" class="'.$i.'">'.$i.'</a></li>';	
					}
					else 
					{
						echo '<li class="" ><a href="#" class="'.$i.'">'.$i.'</a></li>';
					}
				}

				if ( $page == $pages )
				{
					echo '	<li class="disabled"><a href="#" class="next">&raquo;</a></li>';
				}
				else 
				{
					echo '	<li class=""><a href="#" class="next">&raquo;</a></li>';	
				}
				
			echo '</ul>';
	}
	

?>