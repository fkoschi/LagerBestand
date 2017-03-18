<?php

?>
<link rel="stylesheet" href="css/inventar.css">


<div class="container-fluid">

	<div class="row">
	
		<div class="col-lg-5">
			<h1>Hardware</h1>
			<h2 class="text-right">182 <small>Artikel</small></h2>
		</div>
		

		<div class="col-lg-5 col-lg-offset-2">
			<h1>Software</h1>
			<h2 class="text-right">23 <small>Lizenzen</small></h2>
		</div>

	</div>


	<div class="row">
		<div class="col-lg-3">
			<div id="highchart_hardware">
			</div>
		</div>

		<div class="col-lg-3 col-lg-offset-4">
			<div id="highchart_software">
			</div>
		</div>
	</div>

</div>
	


<script>
	
	$('.knob').knob({
		'readOnly' : true,
		'angleOffset' : -125,
		'angleArc' : 250,
		'fgColor' : '#0E6463'
	});

	$('#highchart_hardware').highcharts({
		chart: {
			backgroundColor: '',
			type: 'pie',
			options3d: {
				enabled: true,
				alpha: 45,
				beat: 0
			}
		},
		title: {
			text: ''
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.y}</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer', 
				depth: 35, 
				dataLabels: {
					enabled: true,
					format: '{point.name}'
				}
			}
		},
		series: [{
			type: 'pie',
			name: 'Anzahl',
			data: [
				['Laptops', 22],
				['Monitore', 9],
				{
					name: 'Tastaturen',
					y: 11, 
					sliced: true,
					selected: true,
				},
				['Handys', 3],
				['Mäuse', 2]
			]			
		}]
	});

	$('#highchart_software').highcharts({
		chart: {
			backgroundColor: '',
			type: 'pie',
			options3d: {
				enabled: true,
				alpha: 45,
				beat: 0
			}
		},
		title: {
			text: ''
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.y}</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer', 
				depth: 35, 
				dataLabels: {
					enabled: true,
					format: '{point.name}'
				}
			}
		},
		series: [{
			type: 'pie',
			name: 'Anzahl',
			data: [
				['Office', 1],
				['Photoshop', 9],
				{
					name: 'Symantec',
					y: 6, 
					sliced: true,
					selected: true,
				},
				['Norton', 3],				
			]			
		}]
	});

	$('#loading').hide();

</script>