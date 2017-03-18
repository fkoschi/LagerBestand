$(document).ready(function(){

	/** 
	  ** JEWEILIGE SEITE LADEN
	   **
	    ** ZU BEGINN WIRD HOME GELADEN 
	     **/
	$('#content').load('ajax/php/home.php');

	// SOFTWARE _ HARDWARE
	$('a[id="hardware"]').click(function(){
		setActiveLink( $('a.inventar') );
		$('#loading').show();
		$('#content').load('ajax/php/hardware.php');
	});
	$('a[id="software"]').click(function(){
		setActiveLink( $('a.inventar') );
		$('#loading').show();
		$('#content').load('ajax/php/software.php');
	});
	// NAVIGATION LINKS
	$('a.inventar , a.brezeln , a.bestellungen , a.leihschein , a.home , a.gallery').click( function() {
		setActiveLink( $(this) );
		$('#loading').show();
		$('#content').load('ajax/php/' + $(this).attr('class') + '.php' );
	});

	function setActiveLink( _this ) {
		// Array mit Klassennamen aller verfügbaren Links in der Sidebar
		var pages = ['home' , 'desktop' , 'bestellungen' , 'leihschein' , 'gallery' , 'brezeln' , 'inventar'];

		$.each( pages , function() {
			$('a.' + this + ' ').attr('name','');
		});
		$( _this ).attr('name','active');    // aktiven Link setzen
	}

	$("#hover")
		.mouseover(function(){
			$("a.two").show();
		})
		.mouseleave(function(){
			$("a.two").hide();
		});
	

	/** 
	  ** Datepicker 
	   **/
	$("#zeit input").datepicker({
		dateFormat : 'dd-mm-yy'
	});

	/**
	  ** Toggle Sidebar 
	   **/
	$("i.fa-bars").click(function(){

		var mode = $(this).attr("name");

		if ( mode == 'show' )
		{
			$("#content").animate({
				left: '0',
				right: '0'				
			});			
			$("#content").animate({
				opacity: '1'
			})
		
			
			$("svg").css({
				'width' : '100%',
				'position' : 'absolute',
				'left' : '-45px'
			}); 

			$(this).attr("name","hide");
		}
		else 
		{
			$("#content").animate({
				left: '250px'				
			});
			$("#content").animate({
				opacity: '1'
			})			
			$("svg").css({
				'width' : '',
				'position' : ''
			})
			$(this).attr("name", "show");
		}

	});

	/** 
	  ** 
	   ** Animate Logo
	    **/
	$("img.logo")
		.mouseenter(function(){
		$(this).animate({
			bottom: '+=25px'
		})	
		})
		.mouseleave(function(){
		$(this).animate({
			bottom: '-=25px'
		})
	});
	
	/**
	  **
	   ** Show Pop Up
	    **/
	$("i.fa-plus-square-o").click(function(){
		$("#pop_up_box , #overlay").show();
		//$("body").css("background-color","white");		
	});

	$("i.fa-times").click(function(){
		$("#pop_up_box , #overlay").hide();
		//$("body").show();
	});
	
	/** 
	  ** 
	   ** Resize Boxes
	    **/
	$('i[name="expand_box"]').click(function() {
		
		var height = $(document).height();
		var width = $(document).width();

		var box = $(this).parent().parent();
		var box_content = $(this).parent().next().next();
		var chart = $(this).parent().next().next().children();
				

		if ( $(this).attr("title") == 'expand_box' )
		{
			box.css({
				'position' : 'absolute',
				'top' : 10,
				'left' : 10,
				'width' : '99%',
				'height' : '90%',			
				'z-index' : '500' 
			});
			
			box_content.css({
				'height' : '93%',
				'z-index' : '600'
			});

			
			$(this).attr("title","re_expand_box");
		}	
		else 
		{
			box.css({
			'position' : '',
			'top' : '',
			'left' : '',
			'width' : '',
			'height' : '',			
			'z-index' : '' 
			});
			
			box_content.css({
				'position' : 'relative',
				'height' : '',
				'z-index' : ''
			});


			$(this).attr("title","expand_box");
		}		

	});

	/**
	  **
	   ** Hide Boxes 
	    **/
	$("i[name='hide_box']").click(function(){

		var box = $(this).parent().parent();

		box.hide();

	});

	
/*	
	function drawLineChart()
	{
		var data = google.visualization.arrayToDataTable([
          	['Year', 'Sales', 'Expenses'],
          	['2004',  1000,      400],
          	['2005',  1170,      460],
          	['2006',  660,       1120],
          	['2007',  1030,      540],
          	['2008',  5010,      720],
          	['2009',  1030,      540],
          	['2010',  1230,      240],
          	['2011',  1530,      450],
          	['2012',  1230,      770],
          	['2013',  3030,      40],
          	['2014',  7030,      340]
        ]);

        var options = {
          title: 'Company Performance'
        };

        var chart = new google.visualization.LineChart(document.getElementById('linechart'));
        chart.draw(data, options);
	}

	function drawPieChart()
	{
		var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);

	}

	function drawColumnChart() 
	{
		var data = google.visualization.arrayToDataTable([
			['KW', 'Verliehen', 'Lager'],
          	['24',  10,      55],
          	['25',  11,      56],
          	['26',  8,       53],
          	['27',  9,      54]
		]);

		var options = {
			title: 'Leihübersicht',
			hAxis: {title: 'Kalenderwoche', titleTextStyle: {color: 'black'}}
		};

		var chart = new google.visualization.ColumnChart(document.getElementById('columnChart'));
		chart.draw(data,options);
	}
*/
	
	//
	//	@ hardware.php
	//
	// Weiterleiten auf Übersicht über die einzelnen Kategorien
	//
	$(document).on('click', 'a[name="anzeigen"]', function(){
		var page = $(this).parent().prev().prev().text();
		
		$('#content').empty().load('./ajax/php/hardware/overview.php?type=' + page );
	});
	$(document).on('click' , '#back_to_overview' , function(){
		$('#content').empty().load('./ajax/php/hardware.php');
	});
});