<?php 

	require_once 'php/Controller/mysql.php';

	//$mysql = new mysql();

	//$mysql->connect();

?>
<!DOCTYPE html>
<html>
<head>
	
	<title>Lagerbestand</title>
	
	<meta charset="utf-8">
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/index.css">
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="plugins/jquery-ui/jquery-ui.css">
	<link rel="stylesheet" href="plugins/xcharts/xcharts.css">
	<link rel="stylesheet" href="plugins/bootstrap/bootstrap-theme.min.css">
	<link rel="stylesheet" href="plugins/bootstrap/bootstrap.css">
	<link rel="stylesheet" href="plugins/bootstrapvalidator/bootstrapValidator.css">
	<link rel="stylesheet" href="plugins/fancybox/jquery.fancybox.css">	

	<!-- JavaScript -->
	<script src="plugins/jquery/jquery-2.1.0.min.js"></script>

</head>
<body>
	<!-- Alert Box -->
	<div id="alert_success">
		<button type="button" class="btn btn-success"><i class="fa fa-check"></i> Success</button>
	</div>
	<div id="alert_error">
		<button type="button" class="btn btn-danger"><i class="fa fa-times"></i> Error</button>
	</div>
	<!-- -->

	<!-- Modal Rückgabe Leihschein -->	
	<div class="modal fade" id="returnLeihschein">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Rückgabe Leihschein</h4>
	      </div>
	      <div class="modal-body">
	        <p>Hier könnt Ihr die Rückgabe des Leihschein bestätigen&hellip;</p>
	        <p>Der Status des Leihschein wird dadurch von offen auf erledigt gesetzt! <i class="fa fa-thumbs-o-up fa-4x"></i></p>
	       	<input type="hidden" name="id" value="" />
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
	        <button type="button" class="btn btn-primary" data-loading-text="Loading..." data-dismiss="modal" name="LeihscheinRückgabe">Speichern</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div>	
	
	<!-- Modal Neue Bestellung -->
	<div class="modal fade" id="NeueBestellung">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        		<h2 class="modal-title">Bestellung hinzufügen</h2>
	        	</div>
	        	<div class="modal-body">
	        		<form role="form" id="neueBestellung">
	        			<div class="form-group">
	        				
	        				<label for="datum">Datum</label>
	        				<input type="date" class="form-control" id="datepicker" placeholder="Datum wählen.." autocomplete="off">
	        				
	        			</div>
	        			<div class="form-group">
	        				<label>Händler: </label>
	        				<div class="btn-group">
	        					<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" id="händler" autocomplete="off">
	        					Händler <span class="caret"></span></button>
	        					<ul class="dropdown-menu" role="menu">
	        						<li><a href="#" class="bechtle">Bechtle</a></li>
	        						<li><a href="#" class="epartner">E-Partner</a></li>
	        					</ul>
	        				</div>
	        				<label> bestellt von: </label>
	        				<div class="btn-group">
	        					<button type="button" id="name" class="btn btn-info dropdown-toggle" data-toggle="dropdown" autocomplete="off">
	        						Name <span class="caret"></span>	        					
	        					</button>
	        					<ul class="dropdown-menu" role="menu">
	        						<li><a href="#" class="jochen">Jochen Müller</a></li>
	        						<li><a href="#" class="alex">Alexander Römer</a></li>
	        						<li><a href="#" class="steffen">Steffen Wagner</a></li>
	        						<li><a href="#" class="christoph">Christoph Pleger</a></li>
	        					</ul>
	        				</div>

	        			</div>

	        			<div class="form-group">
	        				<label for="bestellnummer">Bestellnummer</label>
	        				<input type="text" class="form-control" id="bestellnummer" placeholder="Bestellnummer" autocomplete="off">
	        			</div>

	        			<div class="form-group">

	        			</div>

	        			<div class="form-group">
	        				<label for="artikel">bestellte Artikel</label>
	        				<textarea class="form-control" id="beschreibung" autocomplete="off"></textarea>
	        			</div>

	        			<div class="form-group">
	        				<label for="auftragsbestätigung">Auftragsbestätigung</label>
	        				<input type="file" id="auftragsbest" autocomplete="off">
	        			</div>        			
	        		
	        	</div>
	        	<div class="modal-footer">
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>	   	        		
	        		<input type="submit" class="btn btn-primary" id="saveNewOrder" value="Speichern">
	        		<!--<button type="button" class="btn btn-success" data-dismiss="modal" id="saveNewOrder">Speichern</button>   -->
	        		</form>
	      		</div>
	      	</div>
		</div>
	</div>
	
	<!-- Modal Gegenstand hinzufügen -->
	<div class="modal fade" id="Gegenstand_in_Lager">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Zum Lager hinzufügen</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Neuer Spender -->
	<div class="modal fade" id="Neuer_Spender">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Neuer Spender</h4>
				</div>
				<div class="modal-body">
					<p class="text-center"><img src="./img/user.png"></p>
					<div class="row">
						<div class="col-lg-5">
							<label>Vorname:</label>
							<input type="text" class="form-control" name="Vorname">
						</div>
						<div class="col-lg-2"></div>
						<div class="col-lg-5">
							<label>Nachname:</label>
							<input type="text" class="form-control" name="Nachname">
						</div>
					</div><br>
					<div class="row">
						<div class="col-lg-1"></div>
						<div class="col-lg-10">
							<label>Email:</label>
							<input type="email" class="form-control" name="Email">
						</div>
						<div class="col-lg-1"></div>
					</div>
				</div>
				<div class="modal-footer">
					<p class="text-center"><button type="button" class="btn btn-primary" id="neuerBenutzer"> Speichern</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Neue Spende -->
	<div class="modal fade" id="Neue_Spende">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Neue Spende</h4>
				</div>
				<div class="modal-body">
					<input type="text" class="knob" value="0" data-max="50">
					<input type="text" class="knob" value="0" data-max="50">
					<input type="text" class="knob" value="0" data-max="50">
					<input type="text" class="knob" value="0" data-max="50">
				</div>
				<div class="modal-footer">
				
				</div>
			</div>
		</div>
	</div>


	<i class="fa fa-plus-square-o"></i>

	<div id="header_nav">
		
		<i class="fa fa-bars" name="show"></i>
		
		<h2>Lager</h2>		

	</div>

	<div id="sidebar_nav">

		<img src="img/logo.png" class="logo">

	</div>

	<div id="sidebar">
		
		<ul>
			<a href="#" class="home" name="active"><li><i class="fa fa-th-large"></i> Home</li></a>
			<a href="#" class="desktop"><li><i class="fa fa-desktop"></i> Desktop</li></a>
				<div id="hover">			
					<a href="#" class="inventar"><li><i class="fa fa-archive"></i> Inventar</li></a>
						<a href="#" class="two" id="hardware"><li class="two"><i class="fa fa-archive"></i> Hardware</li></a>		
						<a href="#" class="two" id="software"><li class="two"><i class="fa fa-picture-o"></i> Software</li></a>		
				</div>
			<a href="#" class="bestellungen"><li><i class="fa fa-credit-card"></i> Bestellungen</li></a>		
			<a href="#" class="leihschein"><li><i class="fa fa-tags"></i> Leihscheine</li></a>
			<a href="#" class="gallery"><li><i class="fa fa-camera"></i> Gallery</li></a>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<!-- -->
			<a href="#" class="brezeln"><li><i class="fa fa-qq"></i> Brezeln</li></a>
		</ul>
		
		<p class="copyright">&copy; Lindorff </p>

	</div>

	<div id="loading">
		<img src="img/getdata.gif" />
	</div>

	<div id="content">			
			

	</div>

<!-- Pop Up Box -->
<div id="overlay">
	<div id="pop_up_box">

		<i class="fa fa-times"></i>

		<h2>Gerät verbuchen</h2>
		
		<p>Gerät:</p>
		<div class="input-group">	
			<input type="text" name="text_1" class="form-control" placeholder="Gerät wählen ..." autocomplete="off">					
			<div class="input-group-btn">
        		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-archive"></i> <span class="caret"></span></button>
        		<ul class="dropdown-menu">
          			<li><a href="#">Laptops</a></li>
          			<li><a href="#">Hardware</a></li>
          			<li><a href="#">Something else here</a></li>
          			<li class="divider"></li>
          			<li><a href="#">Zubehör</a></li>
        		</ul>
      		</div>			
		</div>

		<p>geht an:</p>
		<div class="input-group" id="benutzer">						
			<input type="text" name="text_2" class="form-control" placeholder="Benutzer wählen ..." autocomplete="off">
			<span class="input-group-addon"><i class="fa fa-user"></i></span>
		</div>

		<p class="zeit">am: </p>
		<div class="input-group" id="zeit">
			<span class="input-group-addon"><i class="fa fa-table"></i></span>			
			<input type="text" class="form-control" autocomplete="off">
		</div>

		<button type="button" class="btn btn-primary"><i class="fa fa-save"></i> Speichern</button>
		
		<div id="background_pic">
			<img src="img/add.png" class="background_pic">
		</div>
	</div> <!-- Pop Up Box -->
</div>

<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization',
       'version':'1','packages':['corechart']}]}"></script>
<script src="plugins/xcharts/xcharts.min.js"></script>
<script src="plugins/d3/d3.v3.min.js"></script>

<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/bootbox/bootbox.min.js"></script>
<script src="plugins/tablesorter/jquery.tablesorter.js"></script>

<script src="plugins/fancybox/jquery.fancybox.js"></script>
<script src="plugins/jQuery-Knob/jquery.knob.js"></script>

<script src="js/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-3d.js"></script>

<script src="js/index.js"></script>
</body>

</html>