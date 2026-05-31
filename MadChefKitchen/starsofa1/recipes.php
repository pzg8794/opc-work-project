<?php
/**
 */
 
 
	// CONNECTING TO THE DATABASE
			// This file provides the information for accessing the database and connecting to MySQL. It also sets the language coding to utf-8
			// First we define the constants:

			// ** MySQL settings - You can get this info from your web host ** //
			/** The name of the database for WordPress */
			define('DB_NAME', 'madchef_classes');

			/** MySQL database username */
			define('DB_USER', 'madchef_madchef');

			/** MySQL database password */
			define('DB_PASSWORD', 'Brando2025');

			/** MySQL hostname */
			define('DB_HOST', 'localhost');

			/** Database Charset to use in creating database tables. */
			define('DB_CHARSET', 'utf8');

			/** The Database Collate type. Don't change this if in doubt. */
			define('DB_COLLATE', '');

			//Make the connection
			$dbcon = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' .mysqli_connect_error() );

			//setting
			mysqli_set_charset($dbcon, 'utf8');
?>

<!DOCTYPE html>
<html>
<head>

		<style type ="text/css">
 table.table1 table.table2,  table.table1 table.table2 th,  table.table1 table.table2 td {
    border: 1px solid black;
    border-collapse: collapse;
}
table.table1{
    border: 0px solid black; 
    border-collapse: collapse;
}

table.table1 th, table.table1 td {
    padding: 5px;
    text-align: left;    
}

table.table1 table.table2 th, table.table1 table.table2 td{
	color: #8B0000; font-weight: bold;
	width:70%;
	word-wrap:break-word;
	font-family: 'FontAwesome', sans-serif; font-size: 10pt; 
}

table.table1 table.table2 th, table.table1 table.table2 th{
	color: black; font-weight: bold;
	width:30%;
	word-wrap:break-word;
	font-family: 'FontAwesome', sans-serif; font-size: 10pt; 
}

table.table1 table.table2, table.table1{
    border-collapse:collapse; table-layout:fixed; 
}
   
		.note
		{
			width: 100%;
		}	

		.yellow 
		{	
			width: 100%;
  			transform: rotate(0deg);	
			position: relative;
		}	

		.yellow::after 
		{
			width: 100%;
  			background-image: url("http://madchefkitchen.com/wp-content/uploads/2015/10/backg.jpg");
			background-size: 50%;
			opacity: .1;
			filter: alpha(opacity=10); /* For IE8 and earlier */
			position: absolute;
			z-index: -1;   
			
  content: "";
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
		}

</style>
    <script type="text/javascript">
    </script>
	<?php 	
function get_images_from_media_library() {
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' =>'image',
        'post_status' => 'inherit',
        'posts_per_page' => 331,
        'orderby' => 'rand'
    );
    $query_images = new WP_Query( $args );
    $images = array();
    foreach ( $query_images->posts as $image) {
        $images[]= $image->guid;
    }
    return $images;
}

function display_images_from_media_library($name) {

    $imgs = get_images_from_media_library();
    $html = '<div id="media-gallery">';

    foreach($imgs as $img) {
		//echo $img. '\r\n';
		if (strpos($img,$name) !== false) {
			
			 return $html .= '<img src="'. $img .'" style="width: 100%;" border="0" alt="'.$name.'"/> </div>';
		}
    }

    return $html.= '<img src="http://madchefkitchen.com/wp-content/uploads/2015/10/recipe.jpg" style="width: auto;" border="0" alt="Our Story"/> </div>';

}

?>
</head>

<body>
	<table class="table1" style="width:100%">
		<?php 
			$qr = mysqli_query($dbcon,"SELECT * FROM Recipes");	// run query
			$recipes = array();
			$cnt = 0;
			while($row = mysqli_fetch_assoc($qr))		// look through query
			{
				$recipes[] = $row;
				$cnt++;
			}
			
			$num =0;
			$tp = $cnt/2;
			//echo $cnt;
			while( $num < $cnt) 
			{
		
		?>	
				<?php if( $num % 2 == 0) 
					{
						echo '<tr>';
						echo '<td valign="top"  style="width:50%">';
					}
					else
					{
						echo '<td valign="top" style="width:50%; left:.5%;">';
					}
				?>
				
				<div class="note yellow" style="width:100%">
						<table class="table2" style="width:100%">
							<tr>
								<th>
									<?php 
									
									
										$name = str_replace(" ","-",$recipes[$num]["Rname"],$i);
										//echo $name."\r\n";
										echo display_images_from_media_library($name); 
									?>
								</th>
								
								<td colspan="3">
									<table style="width:100%">
										<tr>
											<th colspan="3"> <?php echo $recipes[$num]["Rname"] ?> </th>
										</tr>
								
										<tr>
											<th> Author: <br> <?php echo $recipes[$num]["Rauthor"] ?> </td>
											<td> Recipe type: <br> <?php echo $recipes[$num]["Rtype"] ?> </td>
											<td> Cuisine: <br> <?php echo $recipes[$num]["Rcusine"] ?> </td>
										</tr>
			 				
										<tr>
											<td> Prep time: <br> <?php echo $recipes[$num]["Rprep_time"] ?> </td>
											<td> Cook time: <br> <?php echo $recipes[$num]["Rcoock_time"] ?> </td>
											<td> Total time: <br> <?php echo $recipes[$num]["Rprep_time"] + $recipes[$num]["Rcoock_time"] ?> </td>
										</tr>
							
										<tr>
											<th colspan="3"> Serves: <?php echo $recipes[$num]["Ryield"] ?> Servings </th>
										</tr>
							
										<tr>
											<th colspan="3"> <?php echo $recipes[$num]["Rsummary"] ?> </th>
										</tr>
									</table>
								</td>
							</tr>
					
							<tr>
								<th colspan="2">
									<table  class="table2" style="width:100%">
										<tr>Ingredients:</tr>
										<tr>
											<td>
												<?php echo $recipes[$num]["Ringredients"]; ?>
											</td>
										</tr>
									</table>
								</th>
					
								<th colspan="2">
									<table class="table2" style="width:100%">
										<tr>Nutrition:</tr>
										<tr>
											<td>
												<?php echo $recipes[$num]["Rnutrition"]; ?>
											</td>
										</tr>
									</table>
								</th>
							</tr>
							
							<tr>
								<th colspan="4">
									<table class="table2" style="width:100%">
										<tr>Instructions:</tr>
										<tr>
											<td>
												<?php echo $recipes[$num]["Rinstructions"]; ?>
											</td>
										</tr>
									</table>
								</th>
							</tr>
   
							<tr>
								<th colspan="4">
									<table class="table2" style="width:100%">
										<tr>Notes:</tr>
										<tr>
											<td>
												<?php echo $recipes[$num]["Rnotes"]; ?>
											</td>
										</tr>
									</table>
								</th>
							</tr>
						</table>
						</div>
				
				<?php if( $num % 2 == 0) 
					{
						echo '</th>';
					}
					else
					{
						echo '</td>';
						echo '</tr>';
					}
				?>		
		<?php
			$num++;
			}			
		?>	
	</table>
</body>
</html>
