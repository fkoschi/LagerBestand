<?php 
	
	require_once '../../php/Controller/DBclass.php';

	function getNumberOfLeihscheine( $where )
	{
		$DB = new DB;
		$DB->set_database('Lindorff_DB_Lager');
		$DB->_connect();

		$sql = "SELECT COUNT(ID) AS Anzahl FROM Leihschein ".$where." ";
		$DB->set_sql( $sql );
		$DB->_query();
		$result = $DB->_fetch_array(1);

		return $result[0]['Anzahl'];
		$DB->_close();
	}	
?>

<!-- Stylesheet einbinden -->
<link rel="stylesheet" href="css/leihschein.css">

<!-- Header --> 
<div class="row" id="header">
	<div class="col-lg-4" id="links">
		<h2> Leihschein <small>erzeugen</small></h2>
		<img src="img/newFile.png" width="64" height="64" name="picLeihschein">
	</div>
	<div class="col-lg-2">
	</div>
	<div class="col-lg-6" id="rechts_header">
		<h2> <img src="img/searchFile.png" height="64" width="64" name="searchLeihschein"> Leihschein <small>suchen</small></h2>		
		<i class="fa fa-expand" name="expand"></i>
	</div>

</div>

<br /><br />
<!-- Name  +  Suchfeld -->
<div class="row" id="name">

	<div class="col-lg-1">
		
	</div>

	<div class="col-lg-1" id="links">
		<p>Name: </p>
	</div>
	
	<div class="col-lg-3" id="links">
		<div class="input-group">
			<input type="text" class="form-control" id="name">
			<span class="input-group-addon"><i class="fa fa-user"></i></span>
		</div>
	</div>

	<div class="col-lg-1">		
	</div>

	<div class="col-lg-3" id="rechts_navi">
		
		<ul class="nav nav-pills">
			<li class="active"><a href="#" class="alleLeihscheine">	Alle <span class="badge pull-right"><?php echo getNumberOfLeihscheine( "" ); ?></span></a> </li>
			<li> <a href="#" class="offeneLeihscheine"><span class="badge pull-right"><?php echo getNumberOfLeihscheine( "WHERE Status = 'offen' "); ?></span> Offen	</a> </li>
		</ul>
		
	</div>

	<div class="col-lg-3">
		<div class="input-group">
			<input type="text" class="form-control">
			<div class="input-group-btn">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdown"> Name</button>
				<button type="button" class="btn btn-default dropdown-toggle" name="search"><i class="fa fa-search"></i></button>
				<ul class="dropdown-menu pull-right">
					<li><a href="#" class="name">Name</a></li>
					<li><a href="#" class="gegenstand">Gegenstand</a></li>
					<li><a href="#" class="seriennummer">Seriennummer</a></li>					
				</ul>
			</div>
		</div>
	</div>

</div>

<br />
<!-- Abteilung  +  Tabelle --> 
<div class="row" id="abteilung">

	<div class="col-lg-1">
		
	</div>

	<div class="col-lg-1" id="links">
		<p>Abteilung: </p>
	</div>
	
	<div class="col-lg-3" id="links">
		<div class="input-group">
			<input type="text" class="form-control" id="abteilung">
			<span class="input-group-addon"><i class="fa fa-group"></i></span>
		</div>
	</div>

	<div class="col-lg-1">
	</div>
	<!-- Tabelle -->
	<div class="col-lg-6" id="tabelle">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Nr</th>
					<th>Verliehen an:</th>
					<th>Gegenstand:</th>
					<th>Seriennummer:</th>
					<th>Vom:</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>

	</div>

</div>

<br />
<!-- Gegenstand -->
<div class="row" id="gegenstand">

	<div class="col-lg-1">
		
	</div>

	<div class="col-lg-1" id="links">
		<p>Gegenstand: </p>
	</div>
	<!-- Geräte - Dropdown -->
	<div class="col-lg-1" id="links">
		<div class="input-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="gegenstand">wählen...</button>
				<ul class="dropdown-menu">
					<li><a href="#" class="laptop">Laptop</a></li>
					<li><a href="#" class="beamer">Beamer</a></li>
					<li><a href="#" class="handy">Handy</a></li>
					<li><a href="#" class="kamera">Kamera</a></li>
					<li><a href="#" class="umts">UMTS-Stick</a></li>
					<li><a href="#" class="festplatte">Festplatte</a></li>
					<li><a href="#" class="usb">USB-Stick</a></li>
					<li><a href="#" class="tablet">Tablet</a></li>
					<li><a href="#" class="dockingstation">Dockingstation</a></li>
					
				</ul>
			<span class="input-group-addon"><i class="fa fa-folder-open-o"></i></span>
		</div>
	</div>

	<div class="col-lg-2" id="links">
		<div class="input-group">
			<input type="text" class="form-control" id="gegenstand_beschreibung">
			<span class="input-group-addon"><i class="fa fa-pencil"></i></span>
		</div>
	</div>

</div>

<br />
<!-- Seriennummer -->
<div class="row" id="seriennummer">

	<div class="col-lg-1">
		
	</div>

	<div class="col-lg-1" id="links">
		<p>Seriennummer: </p>
	</div>
	
	<div class="col-lg-3" id="links">
		<div class="input-group">
			<input type="text" class="form-control" id="seriennummer">
			<span class="input-group-addon">#</span>
		</div>
	</div>

</div>

<br />
<!-- Leihdauer -->
<div class="row" id="leihdauer">

	<div class="col-lg-1">		
	</div>

	<div class="col-lg-1" id="links">
		<p>Leihdauer: </p>
	</div>
	
	<div class="col-lg-3" id="links">
		<div class="input-group">
			<input type="text" class="form-control" id="leihdauer">
			<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
		</div>
	</div>

</div>

<br />
<!-- Leihgrund --> 
<div class="row" id="leihgrund">

	<div class="col-lg-1">		
	</div>

	<div class="col-lg-1" id="links">
		<p>Leihgrund: </p>
	</div>
	
	<div class="col-lg-3" id="links">
		<div class="input-group">
			<input type="text" class="form-control" id="leihgrund">
			<span class="input-group-addon"><i class="fa fa-info"></i></span>
		</div>
	</div>

</div>

<br /><br /><br /><br />
<!-- Zubehör -->
<div id="links"> 
<div class="row">

	<div class="col-lg-2">
		<p>Zubehör / weitere Infos: </p>
	</div>	
	<div class="col-lg-4">
		<div class="input-group">
			<span class="input-group-addon">1</span>
			<input type="text" class="form-control" id="zeile1">			
		</div>
	</div>

</div>

<div class="row">

	<div class="col-lg-2">
	</div>	
	<div class="col-lg-4">
		<div class="input-group">
			<span class="input-group-addon">2</span>
			<input type="text" class="form-control" id="zeile2">			
		</div>
	</div>

</div>

<div class="row">

	<div class="col-lg-2">
	</div>	
	<div class="col-lg-4">
		<div class="input-group">
			<span class="input-group-addon">3</span>
			<input type="text" class="form-control" id="zeile3">			
		</div>
	</div>

</div>
</div> <!-- links -->
<br /><br /> 

<!-- Datum auswählen -->
<div class="row" id="links">

	<div class="col-lg-1">
		<p>Datum:</p>
	</div>
	<div class="col-lg-2" id="Datum">
		<input type="text" class="form-control" name="datepicker">
		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>		
	</div>
	<div class="col-lg-1">		
	</div>
	<div class="col-lg-1">
		<button type="button" class="btn btn-primary btn-lg" name="save">Save</button>
	</div>
</div>



<script>
$(document).ready(function(){

	$('#loading').hide();	// Hide Loading Div

	// Ajax - Leihschein erstellen 
	$('button[name="save"]').click(function(){
		
		// Loading . . . 
		$('#loading').show();

		// Inhalte
		var name = $('input[id="name"]').val();
		var abteilung = $('input[id="abteilung"]').val();
		var gegenstand = $('button[id="gegenstand"]').text();
		var gegenstand_beschreibung = $('input[id="gegenstand_beschreibung"]').val();
		var seriennummer = $('input[id="seriennummer"]').val();
		var leihdauer = $('input[id="leihdauer"]').val();
		var leihgrund = $('input[id="leihgrund"]').val();

		var zeile1 = $('input[id="zeile1"]').val();
		var zeile2 = $('input[id="zeile2"]').val();
		var zeile3 = $('input[id="zeile3"]').val();

		var datum = $('input[name="datepicker"]').val();
		//alert(datum);
		
	
		$.ajax({
			type : 'GET',
			url  : './ajax/php/leihschein/createLeihschein.php',
			data : 
			{
				'name' : name, 
				'abteilung' : abteilung,
				'gegenstand' : gegenstand,
				'gegenstand_beschreibung' : gegenstand_beschreibung,
				'seriennummer' : seriennummer,
				'leihdauer' : leihdauer,
				'leihgrund' : leihgrund,
				'zeile1' : zeile1,
				'zeile2' : zeile2, 
				'zeile3' : zeile3,
				'datum' : datum
			},
			success : function(data) {
				$('#alert_success').show();
				$('#loading').hide();
				
				setInterval(function(){
					$('#alert_success').fadeOut();
				}, 3000);
				
				$('#content').load('./ajax/php/leihschein.php');
			}
		});	// Ajax Call
		
	});
	// Ajax - Leihschein suchen 
	$('button[name="search"]').click(function(){
		var suchOption = $('button[id="dropdown"]').text();
		alert(suchOption);
	});
	// Suchparameter anpassen
	$('a.name , a.gegenstand , a.seriennummer , a.leihdauer').click(function(){
		$('button[id="dropdown"]').text( $(this).text() );
	});

	$('a.laptop , a.beamer , a.usb , a.festplatte , a.umts , a.handy , a.kamera , a.dockingstation').click(function(){
		$('button[id="gegenstand"]').text( $(this).text() );
	});

	$('a.offeneLeihscheine').click(function(){
		$(this).parent().attr('class', 'active');		
		$(this).parent().prev().attr('class', '');
		// Tabelleninhalt laden
		$('tbody').load('./ajax/php/leihschein/getTableContent.php?method=open');				
	});
	$('a.alleLeihscheine').click(function(){
		$(this).parent().attr('class','active');
		$(this).parent().next().attr('class', '');
		// Tabelleninhalt laden
		$('tbody').load('./ajax/php/leihschein/getTableContent.php?method=all');
	});

	// Tabelleninhalt laden
	$('tbody').load('./ajax/php/leihschein/getTableContent.php?method=all');

	// Tabelle vergrößern
	$('i.fa-expand').click(function(){
		$('div #links').toggle();

		if ( $(this).attr('name') == 'expand' )
		{
			$('div #tabelle , div #rechts_header').attr('class','col-lg-9');
			$('div #rechts_navi').attr('class','col-lg-6');	
			$(this).attr('name','smaller');
		}
		else 
		{
			$('div #tabelle , div #rechts_header').attr('class','col-lg-6');
			$('div #rechts_navi').attr('class','col-lg-3');	
			$(this).attr('name','expand');
		}
		
	});

	// Rückgabe Leihschein 
	  // 1) Modal anzeigen    	ModalCode in -> index.php
	  // 1.1) Modal schließen
	  // 1.2) Datenbank - Status auf erledigt setzen  
	
	$(document).on('click', 'button[name="LeihscheinRückgabe"]', function(event){
		
		event.preventDefault();
		
		var nummer = $('#returnLeihschein input[name="id"]').val();
		
		$.ajax({
			type	: 'GET',
			url		: './ajax/php/leihschein/updateLeihschein.php',
			async	: false,

			data 	: {
				'id' 	: 	nummer,
				'function' : 'updateStatusLeihschein'
			},
			success : 	function(data) {				
				$('#content').load('./ajax/php/leihschein.php');				
			}
		});		

				
	});

	$(document).on('click', 'button[name="openRückgabeLeihscheinModal"] , i[name="openRückgabeLeihscheinModal"]', function (event) {
		$('#returnLeihschein input[name="id"]').val( $(this).attr('data-nummer') );
	})
});
</script>