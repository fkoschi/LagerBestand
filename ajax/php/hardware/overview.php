<?php
	
	//var_dump( $_GET['type'] );
?>

<link rel="stylesheet" href="css/hardware/overview.css">

<div class="row">
	<div class="page-header">
		<a class="btn btn-default" id="back_to_overview"><i class="fa fa-angle-double-left"></i> Zurück</a>
		<h2 class="text-center"><?php echo $_GET['type']; ?></h2>
		<div id="type_image">
		<?php 
			// 	@ GET['type']
			//
		    //	Welches Bild soll eingeblendet werden ?
			// 
			switch ($_GET['type']) 
			{
				case 'Mäuse':
					echo '<img src="./img/hardware/mouse.png" name="'.$_GET['type'].'">';	
					break;
				case 'Notebooks':
					echo '<img src="./img/hardware/laptop.png" name="'.$_GET['type'].'">';
					break;
				case 'Handys':
					echo '<img src="./img/hardware/iphone.png" name="'.$_GET['type'].'">';
					break;
				case 'Tastaturen':
					echo '<img src="./img/hardware/keyboard.png" name="'.$_GET['type'].'">';
					break;
				case 'Festplatten':
					echo '<img src="./img/hardware/festplatte.png" name="'.$_GET['type'].'">';
					break;
				case 'Monitore':
					echo '<img src="./img/hardware/monitor.png" name="'.$_GET['type'].'">';
					break;
				case 'Drucker':
					echo '<img src="./img/hardware/printer.png" name="'.$_GET['type'].'">';
					break;
				case 'Beamer':
					echo '<img src="./img/hardware/beamer.png" name="'.$_GET['type'].'">';
					break;
				case 'Kameras':
					echo '<img src="./img/hardware/camera.png" name="'.$_GET['type'].'">';
					break;
				case 'Rohling':
					echo '<img src="./img/hardware/rohling.png" name="'.$_GET['type'].'">';
					break;
				default:
					
					break;
			}
		?>
		</div>
	</div>
</div>

<div class="row">
		
	<div class="col-lg-4">
		<h3>Aktuell auf Lager: </h3>
		<p class="anzahl_auf_lager">12</p>
	</div>

	<div class="col-lg-1">
		<br><br><br><br>
		<p class="text-center"><input type="text" class="knob_small" value="10" data-max="12" ></p>
		<p class="status text-center">Verfügbar</p>
	</div>

	<div class="col-lg-2">
		<p class="text-center"><input type="text" class="knob" value="12" data-max="12" ></p>
	</div>

	<div class="col-lg-1">
		<br><br><br><br>
		<p class="text-center"><input type="text" class="knob_small" value="2" data-max="12"></p>
		<p class="status text-center">Verliehen</p>
	</div>

	<div class="col-lg-2">
		
	</div>

	<div class="col-lg-2">
		<div class="input-group" id="suche">
			<innput class="form-control" type="text" name="suche" />
			<div class="input-group-btn">
				<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
			</div>
		</div>
	</div>
</div>


<div class="row" id="table">

	<div class="col-lg-12">

		<table class="table">
			<thead>
				<th><i class="fa fa-filter"></i></th>
				<th>Seriennummer</th>
				<th>Modell</th>
				<th>Standort</th>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>HDSKALS</td>
					<td>Logitech HD12</td>
					<td><a href="#">HP_1_23</a></td>
				</tr>
			</tbody>
		</table>


	</div>

</div>

<script>

	$('.knob').knob({
		'readOnly' : true,		
		'angleOffset' : -125,
		'angleArc' : 250,
		'fgColor' : '#87CEEB',
		'width' : 200,
		'height' : 200
	});

	$('.knob_small').knob({
		'readOnly' : true,		
		'angleOffset' : -125,
		'angleArc' : 250,
		'fgColor' : '#87CEEB',
		'width' : 100,
		'height' : 100
	});

	$(document).bind('click' , '#back_to_overview' , function(){
		//$('#content').load('./ajax/php/hardware.php');		
	});

</script>