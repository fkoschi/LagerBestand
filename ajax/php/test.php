<?php
	
	require_once('../../php/Controller/DBclass.php');

	$DB = new DB;
	$DB->set_database('Lindorff_DB_Arbeitserfassung');
	$DB->_connect();

	$sql = "SELECT * FROM [Monatsaufgaben]";

	$DB->set_sql( $sql );

	$DB->_query();
	print_r( $DB->_fetch_array(1) );
	$DB->_close();

?>

<div class="row">
	
	<div class="col-lg-5" id="content_box">
		<div id="content_box_header">
			<i class="fa fa-tags"></i>
			<label>BOX #1</label>
			<i class="fa fa-expand" name="expand_box" title="expand_box"></i>
			<i class="fa fa-times" name="hide_box"></i>
		</div>
		<hr>
		<div id="content_box_content">
			<div id="columnChart"></div>
		</div>
	</div>

</div>

	<button>Push Me Hard </button>


<script>

$(document).ready(function(){

	$("button").click(function() {

		console.log(" gepushed ");

	});

});

</script>