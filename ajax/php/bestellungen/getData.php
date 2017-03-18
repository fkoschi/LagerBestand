<?php

	require_once '../../../php/Controller/DBclass.php';

	/** 
	  ** PAGE 
	   ** 
	   	**/		
		if ( !empty($_GET['page']) )
		{
			$PAGE = $_GET['page'];			
		}	
		
	/**
	  ** FUNKTIONSAUFRUFE 
	   **
	   	**/
	if ( !empty($_GET) && empty($_GET['suche']) )
	{
		if( $_GET['function'] == 'columns' )
		{
			createDetailedListOfOrders('' , $PAGE );
		}
		else if ( $_GET['function'] == 'list' )
		{
			createTableListOfOrders('' ,  $PAGE );
		}
	}
	else if ( !empty($_GET) && !empty($_GET['suche']) )
	{
		if( $_GET['function'] == 'columns' )
		{
			createDetailedListOfOrders( "WHERE " . $_GET['parameter'] . " LIKE '%" . $_GET['suche'] . "%' " , $PAGE );
		}
		else if ( $_GET['function'] == 'list' )
		{
			createTableListOfOrders( "WHERE " . $_GET['parameter'] . " LIKE '%" . $_GET['suche'] . "%' " , $PAGE );
		}
	}
	/** ----------- **/

/** 
  ** FUNKTIONEN 
   ** 
    **/
	function createDetailedListOfOrders($WHERE , $PAGE )
	{	

		$DB = new DB; 
		$DB->set_database('Lindorff_DB_Lager');
		$DB->_connect();
		
		$sql = "SELECT COUNT(ID) AS Anzahl FROM Bestellung " . $WHERE . " ";
		$DB->set_sql( $sql );
		$DB->_query();
		$result = $DB->_fetch_array(1);
		
		if( $result[0]['Anzahl'] == 0  )
		{
			echo "<h2 class='text-center'>Keine Eintragungen</h2>";
			exit;
		}	

		$PAGE_LIMIT_COLUMNS = "WHERE ID >= " . ( ( ( $PAGE - 1 ) * 6 ) + 1 ) . " ";	
		$WHERE = str_replace("WHERE", "AND", $WHERE);
				

		$sql ="SELECT 	TOP(6)
						Bestelldatum,
					  	Besteller,
					  	Verkauf,
					  	Bestellnummer,
					  	Beschreibung,
					  	Auftragsbest
				FROM Bestellung
				" . $PAGE_LIMIT_COLUMNS . " 
				" . $WHERE . "
				";
		$DB->set_sql( $sql );
		$DB->_query();
		$_result = $DB->_fetch_array(1);		
		$counter = 0;	// Zur Überprüfung der Anzahl an Datensätzen

		echo '<input type="hidden" name="method" value="columns" >';
		echo '<input type="hidden" name="page" value="' . $PAGE . '"> ';

		foreach ( $_result as $value ) 
		{
			$counter++; 
			
			if ( $counter % 2 != 0 )  // Neue Zeile öffnen bei ungerader Anzahl an Datensätze
			{
				echo ' <div class="row"> ';
				echo '						
						<!-- Tag -->
						<div class="col-lg-1">
							<img src="img/tag.png" name="tag">
						</div>
						<!-- linke Seite -->
						<div class="col-lg-3">
							<form class="form-horizontal">			
								
								<div class="form-group">
									<label class="col-md-4 control-label"><p class="text-left">Datum</p></label>
									<div class="col-md-6">
										<p class="form-control-static">'.$value['Bestelldatum'].'</p>
									</div>
								</div>
					
								<div class="form-group">
									<label class="col-md-4 control-label"><p class="text-left">Händler</p></label>
									<div class="col-md-6">
										<p class="form-control-static">'.$value['Verkauf'].'</p>
									</div>
								</div>
					
								<div class="form-group">
									<label class="col-md-4 control-label"><p class="text-left">Bestellnummer</p></label>
									<div class="col-md-6">
										<p class="form-control-static">'.$value['Bestellnummer'].'</p>
									</div>
								</div>
					
								<div class="form-group">
									<label class="col-md-4 control-label"><p class="text-left">Bestellt von:</p></label>
									<div class="col-md-6">
										<p class="form-control-static">'.utf8_encode( $value['Besteller'] ).'</p>
									</div>
								</div>
					
							</form>
							<hr>
						</div>
						
						<!-- rechte Seite -->
						<div class="col-lg-2">	
							<div class="panel panel-info">
								<div class="panel-heading">
									<h4 class="text-center">Artikel
									<a href="file:///'.$value['Auftragsbest'].'"></a></h4>
								</div>
			
								<div class="panel-body">
									'.$value['Beschreibung'].'
								</div>

							</div>					
						</div>

					';	
			}
			else 	// Zeile schließen bei gerader Anzahl
			{
				echo '						
						<!-- Tag -->
						<div class="col-lg-1">
							<img src="img/tag.png" name="tag">
						</div>
						<!-- linke Seite -->
						<div class="col-lg-3">
							<form class="form-horizontal">			
								
								<div class="form-group">
									<label class="col-md-4 control-label"><p class="text-left">Datum</p></label>
									<div class="col-md-6">
										<p class="form-control-static">'.$value['Bestelldatum'].'</p>
									</div>
								</div>
					
								<div class="form-group">
									<label class="col-md-4 control-label"><p class="text-left">Händler</p></label>
									<div class="col-md-6">
										<p class="form-control-static">'.$value['Verkauf'].'</p>
									</div>
								</div>
					
								<div class="form-group">
									<label class="col-md-4 control-label"><p class="text-left">Bestellnummer</p></label>
									<div class="col-md-6">
										<p class="form-control-static">'.$value['Bestellnummer'].'</p>
									</div>
								</div>
					
								<div class="form-group">
									<label class="col-md-4 control-label"><p class="text-left">Bestellt von:</p></label>
									<div class="col-md-6">
										<p class="form-control-static">'.utf8_encode( $value['Besteller'] ).'</p>
									</div>
								</div>
					
							</form>
							<hr>
						</div>
						
						<!-- rechte Seite -->
						<div class="col-lg-2">	
							<div class="panel panel-info">
								<div class="panel-heading">
									<h4 class="text-center">Artikel
									<a href="file:///'.$value['Auftragsbest'].'"></a></h4>
								</div>
			
								<div class="panel-body">
									'.$value['Beschreibung'].'
								</div>

							</div>					
						</div>
						
						</div>   
					';	
			}
												
		}		
		
		createPagination( 'columns' , $result[0]['Anzahl'] , $PAGE );

		$DB->_close();		
	}

	function createTableListOfOrders($WHERE , $PAGE )
	{
		$DB = new DB;
		$DB->set_database('Lindorff_DB_Lager');
		$DB->_connect();

		$sql = "SELECT COUNT(ID) AS Anzahl FROM Bestellung " . str_replace('AND', 'WHERE', $WHERE) . " ";
		$DB->set_sql( $sql );
		$DB->_query();
		$_result = $DB->_fetch_array(1);

		if( $_result[0]['Anzahl'] == 0)
		{
			echo "<h2 class='text-center'>Keine Eintragungen</h2>";
			exit;
		}

		$PAGE_LIMIT_LIST = "WHERE ID >= " . ( ( ( $PAGE - 1 ) * 17 ) + 1 ) . " ";
		$WHERE = str_replace("WHERE", "AND", $WHERE);		

		$sql = "SELECT 	TOP(17)
						Bestelldatum,
						Besteller,
						Verkauf,
						Bestellnummer,
						Beschreibung,
						Auftragsbest
				FROM Bestellung
				" . $PAGE_LIMIT_LIST . "
				" . $WHERE . "
				";
		$DB->set_sql( $sql );
		$DB->_query();
		$result = $DB->_fetch_array(1);
		
		echo '<input type="hidden" name="method" value="list" >';
		
		echo '<table class="table" id="table">';
		echo '<thead>';
		echo '	<tr>';
		echo '		<th>Bestelldatum</th>';
		echo '		<th>Händler</th>';
		echo '		<th>Besteller</th>';
		echo '		<th>Bestellnummer</th>';	
		echo '		<th>Auftragsbestätigung</th>';	
		echo '	</tr>';
		echo '</thead>';
		echo '<tbody>';
		foreach ( $result as $value )
		{
		echo '<tr>';
		echo '	<td>'.$value['Bestelldatum'].'</td>';
		echo ' 	<td>'.$value['Verkauf'].'</td>';
		echo '	<td>'.utf8_encode($value['Besteller']).'</td>';
		echo '	<td>'.$value['Bestellnummer'].'</td>';
		echo ' 	<td><a href="'.$value['Auftragsbest'].'"></a></td>';
		echo '	<td></td>';
		echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
			
		createPagination( 'list' , $_result[0]['Anzahl'] , $PAGE );
		

		$DB->_close();		
	}

	function createPagination( $function , $counter , $page ) 
	{	

		if ( $function == 'columns' )
		{
			$_counter = $counter / 6;									
		}
		else if ( $function == 'list' )
		{
			$_counter = $counter / 17;			
		}			
	
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

	/** -------- **/
?>

<script>
	$('ul[id="pagination"] li a').click(function(){
		
		var active_page = parseInt( $('li.active').children('a').attr('class') );

		var clicked = $(this).attr('class');

		var method = $('input[name="method"]').val();
		
		if ( clicked == 'next' )
		{
			active_page = active_page + 1;
			$('#data_' + method).empty().load('./ajax/php/bestellungen/getData.php?function=' + method + '&page=' + active_page);
		}
		else if ( clicked == 'prev' )
		{
			active_page -= 1;
			$('#data_' + method).empty().load('./ajax/php/bestellungen/getData.php?function=' + method + '&page=' + active_page);
		}
		else 
		{			
			$('#data_' + method).empty().load('./ajax/php/bestellungen/getData.php?function=' + method + '&page=' + clicked);
		}
		
	});
</script>