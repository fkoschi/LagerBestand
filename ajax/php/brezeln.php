<?php 
	
	require_once '../../php/Controller/DBclass.php';

	if( !empty($_GET) )
	{
		if( $_GET['function'] == 'getData' )
		{
			$result = getBrezelstand();
			
			$kassengeld = [];
			
			$kassengeld['zehner'] = $result[0]['10er'];
			$kassengeld['zwanziger'] = $result[0]['20er'];
			$kassengeld['fünfziger'] = $result[0]['50er'];
			$kassengeld['einer']  = $result[0]['1er'];
			$kassengeld['zweier']  = $result[0]['2er'];
			$kassengeld['vorrat']  = $result[0]['VorratBrezeln'];
			$kassengeld['leer'] = 0;

			echo join(";" , $kassengeld);
			
		}
		if( $_GET['funktion'] == 'updateKasse' )
		{
			if( $_GET['type'] == 'packungen' )
			{
				updateKassenstand( $_GET['packung'] , $_GET['method'] , '' );	
			}
			else if ( $_GET['type'] == 'geld' )
			{
				$kassengeld[0] = $_GET['zehner'];
				$kassengeld[1] = $_GET['zwanziger'];
				$kassengeld[2] = $_GET['fünfziger'];
				$kassengeld[3] = $_GET['einer'];
				$kassengeld[4] = $_GET['zweier'];

				updateKassenstand( '' , '' , $kassengeld );
			}			
		}
	}


	function getBrezelstand()
	{
		$DB = new DB;
		$DB->set_database('Lindorff_DB_Lager');
		$DB->_connect();
	
		$sql = " SELECT [10er],
						[20er],
						[50er],
						[1er],
						[2er],
						VorratBrezeln
					FROM Brezelkasse
					WHERE ID = 1 ";
		
		$DB->set_sql( $sql );
		$DB->_query();

		$result = $DB->_fetch_array(1);
						
		return $result;
		$DB->_close();
	}

	function updateKassenstand( $packungen , $method , $geld ) 
	{
		$DB = new DB;
		$DB->set_database('Lindorff_DB_Lager');
		$DB->_connect();		
		if( $packungen != '' )
		{
			$sql = "	UPDATE Brezelkasse
						SET VorratBrezeln ".$method."= " .$packungen. "
						WHERE ID = 1
					";
		}
		else 
		{
			$sql = "	UPDATE Brezelkasse
						SET [10er] = ".$geld[0].",
							[20er] = ".$geld[1].",
							[50er] = ".$geld[2].",
							[1er]  = ".$geld[3].",
							[2er]  = ".$geld[4]."
						WHERE ID = 1
					";
		}
		
		$DB->set_sql( $sql );
		$DB->_query();
		$DB->_close();
	}
?>

<link rel="stylesheet" href="css/brezeln.css" >

<div class="row">
	<div id="header" class="page-header">
		<h2>Brezelkasse</h2>
	</div>
</div>
<br />
<div class="row">
	<div class="col-lg-1">
	</div>	

	<div class="col-lg-2">
		
		<h3> Vorrat:</h3>

		<div class="row" id="Vorrat">
			<div class="left">
				<!--<div id="VorratBrezeln">

				</div>
				-->
				<?php
					$result = getBrezelstand();
					echo '<input type="text" value="'.$result[0]['VorratBrezeln'].'" class="knob">';
				?>
			</div>
	
			<div class="right">
				<h4>Hinzufügen: </h4>
				<select id="packung_plus" class="form-control">
					<option selected>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>10</option>					
				</select>
				<i class="fa fa-shopping-cart fa-2x"></i>

				<h4>Verbraucht: </h4>
				<select id="packung_minus" class="form-control">
					<option selected="">1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
				<i class="fa fa-arrow-down fa-2x"></i>
			</div>
		</div>

		<h3>Kasse: </h3>			
		<?php 
			$kassenstand = getBrezelstand(); 
			
			echo ' 	<p name="geld" class="text-right">10 Cent: <span name="10er" class="badge">'.$kassenstand[0]['10er'].'</span> <i class="fa fa-plus-square" name="plus"></i> <i class="fa fa-minus-square" name="minus"></i> </p>  
					<p name="geld" class="text-right">20 Cent: <span name="20er" class="badge">'.$kassenstand[0]['20er'].'</span> <i class="fa fa-plus-square" name="plus"></i> <i class="fa fa-minus-square" name="minus"></i> </p>
					<p name="geld" class="text-right">50 Cent: <span name="50er" class="badge">'.$kassenstand[0]['50er'].'</span> <i class="fa fa-plus-square" name="plus"></i> <i class="fa fa-minus-square" name="minus"></i> </p>
					<p name="geld" class="text-right">1 &euro;: <span name="1er" class="badge">'.$kassenstand[0]['1er'].'</span> <i class="fa fa-plus-square" name="plus"></i> <i class="fa fa-minus-square" name="minus"></i> </p>
					<p name="geld" class="text-right">2 &euro;: <span name="2er" class="badge">'.$kassenstand[0]['2er'].'</span> <i class="fa fa-plus-square" name="plus"></i> <i class="fa fa-minus-square" name="minus"></i> </p>
				';
			
			$kassenstand_gesamt = ($kassenstand[0]['10er'] * 10 + $kassenstand[0]['20er'] * 20 + $kassenstand[0]['50er'] * 50 + $kassenstand[0]['1er'] * 100 + $kassenstand[0]['2er'] * 200) / 100;
			echo '		
					<hr>
					<p name="gesamt" class="text-right">Gesamt: <strong class="kassenstand_gesamt">'.$kassenstand_gesamt.' <i class="fa fa-euro"></i></strong></p>
				';
		?>
		<p class="text-right"><i class="fa fa-save"></i></p>
	</div>

	<div class="col-lg-1">
	</div>

	<div class="col-lg-5">
		<h3>Aktueller Stand:</h3>
		<div id="chart"> 
		</div>
	</div>

	<div class="col-lg-2">
	<h3>Spendenranking <span><i class="fa fa-plus-square" data-toggle="modal" data-target="#Neuer_Spender" title="neuer Spender"></i></span></h3>
	<br />
		<table class="table">
			<thead>
				<th>#</th>
				<th>Vorname</th>
				<th>Nachname</th>
				<th>Score</th>
				<th>+</th>
			</thead>
			<tbody>
				<tr>
					<td><img src="img/gold.png" width="16" height="16"></td>
					<td>Felix</td>
					<td>Koschmidder</td>
					<td class="gespendet">5€</td>
					<td><img src="img/brezelkasse/sparschwein.png" class="sparschwein"></td>
				</tr>
				<tr>
					<td><img src="img/silber.png" width="16" height="16"></td>
					<td>Christoph</td>
					<td>Pleger</td>
					<td class="gespendet">3€</td>
					<td><img src="img/brezelkasse/sparschwein.png" class="sparschwein" data-toggle="modal" data-target="#Neue_Spende"></td>
				</tr>
				<tr>
					<td><img src="img/bronze.png" width="16" height="16"></td>
					<td>Jochen</td>
					<td>Müller</td>
					<td class="gespendet">1€</td>
					<td><img src="img/brezelkasse/sparschwein.png" class="sparschwein"></td>
				</tr>
			</tbody>
		</table>
	</div>
	

</div>




<script>
$(document).ready(function(){

	$.ajax({
		type : 'GET',
		url  : './ajax/php/brezeln.php',		
		
		data : {
			'function' : 'getData'
		},
		success: function(data){
			createKasseChart(data);	
			createVorratChart(data);
		}
	});
	

	function createKasseChart( kassengeld )
	{	
		var _kassengeld = kassengeld.split(';')
		
		var data_Kasse = {
			'xScale' : 'ordinal',
			'yScale' : 'linear',
			'main' : [
			{
				'className' : '.Brezelkasse',
				'data': [
				{
					'x' : '10 cent',
					'y' : + _kassengeld[0]
				},
				{
					'x' : '20 cent', 
					'y' : + _kassengeld[1]
				},
				{
					'x' : '50 cent',
					'y' : + _kassengeld[2]
				},
				{
					'x' : '1 €',
					'y' : + _kassengeld[3]
				},
				{
					'x' : '2 €',
					'y' : + _kassengeld[4]
				}
		      ]
			}
		  ]
		};

		var xchart = new xChart('bar', data_Kasse , '#chart');	
	}
	function createVorratChart( vorrat )
	{

		var _vorrat = vorrat.split(';');
		
		var data_Vorrat = {

			'xScale' : 'ordinal',
			'yScale' : 'linear',
			'main' : 
			[{
				'className' : '.Vorrat',
				'data': 
					[{
						'x' : 'Päkchen',
						'y' : + _vorrat[5] 
					}]
			}]
		};	

		var xchart = new xChart('bar' , data_Vorrat , '#VorratBrezeln');
	}

	// Kasse - Änderungen im Frontend anpassen 
	$('i.fa-plus-square , i.fa-minus-square').click(function(){
		
		var method = $(this).attr('name');
		
		if ( method == 'plus' )
		{
			var _anz = parseInt( $(this).prev().text() ) + 1;	
			$(this).prev().text( _anz );			
		}
		else 
		{	
			var _anz = parseInt( $(this).prev().prev().text() ) - 1;
			$(this).prev().prev().text( _anz ); 			
		}				

	});

	// Kasse - im Backend speichern 
	$('i.fa-save').click(function(){
		var zehner = $('span[name="10er"]').text();
		var zwanziger = $('span[name="20er"]').text();
		var fünfziger = $('span[name="50er"]').text();
		var einer = $('span[name="1er"]').text();
		var zweier = $('span[name="2er"]').text();

		$.get('./ajax/php/brezeln.php' , { funktion: 'updateKasse' , zehner : + zehner , zwanziger : + zwanziger , fünfziger : + fünfziger , einer : + einer , zweier : + zweier , type : 'geld' });
		reload();
	});

	// Einkaufswagen 
	$('i.fa-shopping-cart').click(function(){
		var packungen = $('#packung_plus option:selected').text();
		$.get('./ajax/php/brezeln.php' , { funktion: 'updateKasse' , packung : + packungen , method : '+' , type : 'packungen' });
		reload();
	});
	// Pfeil nach untern 
	$('i.fa-arrow-down').click(function(){
		var packungen = $('#packung_minus option:selected').text();
		$.get('./ajax/php/brezeln.php' , { funktion: 'updateKasse' , packung : + packungen , method : '-' , type : 'packungen' });
		reload();
	});

	// Page Reoload 
	function reload()
	{
		setTimeout(function(){
			$('#content').load('./ajax/php/brezeln.php');
		}, 1500);
		
	}

	// KNOB
	$('#Vorrat .knob').knob({
		'min' : 0,
		'max' : 10,
		'width' : 150,
		'height' : 150,
		'readOnly' : true

	});

	//KNOB MODAL NEUE SPENDE 
	$('#Neue_Spende .knob').knob({
		'min' : 0,
		'max' : 50,
		'width' : 60,
		'height' : 60,
		'readOnly' : false
	});

	// LOADING 
	$('#loading').hide();
});
</script>