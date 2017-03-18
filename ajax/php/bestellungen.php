<?php
		
?>

<link rel="stylesheet" href="css/bestellungen.css" >

<div id="header" class="page-header">
	
	<h2>Bestellungen</h2>

	<div class="row">
		
		<div class="col-lg-4">
			<div class="input-group">
				<input type="text" class="form-control" name="bestellung_suche" >
				<div class="input-group-btn">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdown"> wählen...</button>
					<button type="button" class="btn btn-default dropdown-toggle" name="search"><i class="fa fa-search"></i></button>
					<ul class="dropdown-menu pull-right">
						<li><a href="#" class="datum">Bestelldatum</a></li>
						<li><a href="#" class="bestellnummer">Bestellnummer</a></li>
						<li><a href="#" class="besteller">Besteller</a></li>					
					</ul>
				</div>			
			</div>
		</div>
		<div class="col-lg-1">
		</div>

		<div class="col-lg-3">				
							
		</div>

		<div class="col-lg-4">
			<p class="text-right"><i class="fa fa-list"></i> <i class="fa fa-columns"></i> <i class="fa fa-plus" data-toggle="modal" data-target="#NeueBestellung"></i></p>
		</div>
	</div>
					

</div> <!-- Header --> 

<br />

<div id="data">
	
	<div id="data_list">
	</div>

	<div id="data_columns">
	</div>

</div>

<div id="background">
	<img src="./img/inventar.png" width="512" height="512">
</div>


<script>

// TABLESORTER 
$('#table').tablesorter();

/** 
  ** Neue Bestellung 
   ** 
    ** Modal
     **/

	// Neue Bestellung speichern 
	$(document).on('submit', '#NeueBestellung', function(){
			
		// Werte
		var Besteller = $('button[id="name"]').text();
		var Bestelldatum = $('input[id="datepicker"]').val();
		var Händler = $('button[id="händler"]').text();
		var Bestellnummer = $('input[id="bestellnummer"]').val();
		var Beschreibung = $('textarea[id="beschreibung"]').val();
		var File = document.getElementById('auftragsbest').files[0];

		var formData = new FormData();
		formData.append( 'File' , File );
		formData.append( 'Besteller' , Besteller );
		formData.append( 'Bestelldatum' , Bestelldatum );
		formData.append( 'Händler' , Händler );
		formData.append( 'Bestellnummer' , Bestellnummer );
		formData.append( 'Beschreibung' , Beschreibung );

		// AJAX
		$.ajax({
			type : 'POST',
			url  : './ajax/php/bestellungen/saveNewBestellung.php',
			enctype : 'multipart/form-data',
			processData : false,
			contentType : false,
			data : formData, 
			success : function(data)
			{	
				closeModal();		
			}
		});
	});

	function closeModal(){
		$('#data_columns , #data_list').empty();
		$('#data_list').load('./ajax/php/bestellungen/getData.php?function=list&page=1');				
		$('#NeueBestellung').modal('hide');
	}
	
	// Datum  - Datepicker
	$('#datepicker').datepicker({dateFormat: 'dd.mm.yy'});

	// Dropdown Parameter NAME anpassen
	$('a.jochen , a.steffen , a.alex , a.christoph').click(function(){
		$('button[id="name"]').text( $(this).text() );
	});
	// Dropdown Parameter HÄNDLER anpassen
	$('a.bechtle , a.epartner').click(function(){
		$('button[id="händler"]').text( $(this).text() );
	});

/** ------- **/



/** 
  ** Ansicht anpassen 
   ** 
    ** Tabelle - Spalten 
     **/  

    $('#data_columns').load('./ajax/php/bestellungen/getData.php?function=columns&page=1');		// Beim Start

    // Anpassung durch Klicken der Icons
    $('i.fa-list').click(function(){
    	$(this).css('color','white');
    	$('i.fa-columns').css('color','black');
    	$('#data_columns').empty();
    	$('#data_list').load('./ajax/php/bestellungen/getData.php?function=list&page=1');
    });
    $('i.fa-columns').click(function(){
    	$(this).css('color','white');
    	$('i.fa-list').css('color','black');
    	$('#data_list').empty();
    	$('#data_columns').load('./ajax/php/bestellungen/getData.php?function=columns&page=1');
    });

 /** ----------- **/

    


/** 
  ** SUCHE 
   **/
$('button[name="search"]').click(function(){

	var suche = $('input[name="bestellung_suche"]').val();
	var method = $('input[name="method"]').val();
	var parameter = $('button[id="dropdown"]').text();

	$('img').animate({ top: '-=200' }, { duration: 500, easing: 'easeOutBounce' });
	

	//$('#data_' + method ).empty().load('./ajax/php/bestellungen/getData.php?function=' + method + '&parameter=' + parameter + '&suche=' + suche + '&page=1');

});
	/** ------------- **/


	// Dropdown Parameter anpassen
	$('a.datum , a.bestellnummer , a.besteller').click(function(){
		$('button[id="dropdown"]').text( $(this).text() );
		if( $(this).text() == 'Bestelldatum' )
		{
			$('input[name="bestellung_suche"]').datepicker({dateFormat:'dd.mm.yy'});
		}
		else 
		{
			$('input[name="bestellung_suche"]').datepicker('destroy');	
		}
	});

	// Hide Loading DIV
	$('#loading').hide();
</script>
