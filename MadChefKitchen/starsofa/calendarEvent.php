<?php

?>

<!doctype html>
<html lang=en>

<head>
	<title>Search page</title>
	<meta charset=utf-8>

 	<style type ="text/css">
    		h3.red 
		{
    			color:red;
    			font-size:105%;
    			font-weight:bold;
    			text-align:center;
    		}

		#container
		{
			width: 100%;
		}

   		h
		{
    			font-color:black;
    			font-size:15px;
    			font-weight:bold;
    			text-align:left;
    		}

    		cevent
		{
    			font-color:black;
    			font-size:10px;
    			font-weight:bold;
    			text-align:center;
    		}

    		h4{ text-align: center;}

    		h
		{
    			position:absolute; bottom:230px; right:50px; color:navy; width:666px; text-align:center;
    			margin:5px auto 0;
    		}
    
	    	/* calendar */
		table.calendar		{ border-left:2px solid black; }
    		tr.calendar-row		{  }
    		td.calendar-day		{ min-height:80px; font-size:11px; position:relative; } * html div.calendar-day { height:80px; }
    		td.calendar-day:hover	{ background:#FFFFFD; }
    		td.calendar-day-np	{ background:#eee; min-height:80px; } * html div.calendar-day-np { height:80px; }
    		td.calendar-day-head 	{ 
						background: #5F9EA0; color: white; font-weight:bold; text-align:center; 
						width:120px; padding:5px; border-bottom:2px solid black; 
						border-top:2px solid black; border-right:2px solid black; 
					}

    		div.day-number		{ 	background:#5F9EA0; padding:5px; color:white; font-weight:bold; 
						float:right; margin:-5px -5px 0 0; 
						width:30px; text-align:center; 
					}
    		
		/* shared */
    		td.calendar-day, td.calendar-day-np { width:120px; padding:5px; border-bottom:2px solid black; border-right:2px solid black; }
  	</style>
</head>
  
<body>

	<?php
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


	<script language="javascript" type="text/javascript">
		<!--
		function popitup(url) {
			newwindow=window.open(url,'name','height=450,width=270');
			if (window.focus) {newwindow.focus()}
			return false;
		}
		// -->
	</script>

	<div id='container'>
    			<div id='content'>
      				<!--Start of the view_users_page content. 
      				<h3 class="red"> Click on any Class Event for more Details </h3> -->
     				<h4> <?php 
					/* draws a calendar */
					function draw_calendar($month,$year)
					{
						/* draw table */
						$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

						/* table headings */
						$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
						$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	 					/* days and weeks vars now ... */
						$running_day = date('w',mktime(0,0,0,$month,1,$year));
						$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
						$days_in_this_week = 1;
						$day_counter = 0;
						$dates_array = array();

						/* row for week one */
						$calendar.= '<tr class="calendar-row">';

	    					/* print "blank" days until the first of the current week */
						for($x = 0; $x < $running_day; $x++):
							$calendar.= '<td class="calendar-day-np"> </td>';
							$days_in_this_week++;
						endfor;	

						static $ind = 1;
	   					/* keep going with days.... */
						for($list_day = 1; $list_day <= $days_in_month; $list_day++):
							$calendar.= '<td class="calendar-day">';

							// run query
							$num = 0;
							$day = sprintf("%02d", $list_day);

							// run query
							$query = mysql_query("SELECT * FROM Classes");

							// set array
							$array = array();

							// look through query
							while($row = mysql_fetch_assoc($query))
							{
								$pieces = explode("-", $row['Class_Date']);
								$mth = $pieces[0]; // piece1
								$dte = sprintf("%02d", $pieces[1]); // piece2
								//echo $dte;
 							 	//echo "AND";
								//echo $list_day;
								//echo $dte;
 							 	// add each row returned into an array
								if( $mth == $month && $dte == $day)
								{
									$array[] = $row;
							 		// OR just echo the data:
							  		// echo $row['Class_Date']; // etc
							 		// echo $datef;
									// exit();
								}
							}
							$num = sizeof($array);

							/* add in the day number */
							if($num > 0)
							{
								for($count = 0; $count<$num; $count++)
								{
									$topic = $array[$count]['Class_Name'];

									$pieces = explode(":", $array[$count]['Class_sTime']);
									$tm1   = $pieces[0].":".$pieces[1];

									$pieces = explode(":", $array[$count]['Class_eTime']);
									$tm2   = $pieces[0].":".$pieces[1];
									//$box = "day-number".$ind;
									$col = $array[$count]['ColorId'];
									$com = $array[$count]['Comments'];

									//echo $col;
									$temp = '<cevent> <a href="#" data-toggle="tooltip" title="'.$com.'">';
									$temp .= $topic;
									$temp .= "<br>";
									$temp .= $tm1."-".$tm2;
									$temp .= "</a></cevent>";
									
									//$temp2 = '<div class="'.$box.'">'.$list_day.'</div>';
									$temp2 = '<div class="day-number" style="background-color:'.$col.'">'.$list_day.'</div>';

									$calendar.= $temp2;
									$calendar.= str_repeat($temp,1);
								} $ind++;
							}
							else
							{
								$calendar.= '<div class="day-number">'.$list_day.'</div>';
								$calendar.= str_repeat('<p> </p>',2);
							}
						
							/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
							//$calendar.= str_repeat('<p> Test </p>',1);
							$calendar.= '</td>';
    				
							if($running_day == 6):
								$calendar.= '</tr>';
								
								if(($day_counter+1) != $days_in_month):
									$calendar.= '<tr class="calendar-row">';
								endif;
								
								$running_day = -1;
								$days_in_this_week = 0;
							endif;
		
							$days_in_this_week++; $running_day++; $day_counter++;
						endfor;
	
  						/* finish the rest of the days in the week */
						if($days_in_this_week < 8):
							for($x = 1; $x <= (8 - $days_in_this_week); $x++):
								$calendar.= '<td class="calendar-day-np"> </td>';
							endfor;
						endif;

						/* final row */
						$calendar.= '</tr>';

						/* end the table */
						$calendar.= '</table>';
	
					/* all done, return result */
					return $calendar;
					}
					
					/* sample usages */
					//echo '<h2>September 2015</h2>';
					//echo draw_calendar(9,2015);
					
					$cMonth  =  date("m")-1;
					$cNMonth =  date("m");
					$monthName = date("F", mktime(null, null, null, $cMonth));
					$nMonthName = date("F", mktime(null, null, null, $cNMonth));
					$cyear = date("Y");

					echo '<h2 align="center" >Cooking Classes for '. $monthName.' '.date("Y").'</h2>';
					echo draw_calendar($cMonth,2015);

					echo '<h2 align="center" >Cooking Classes for '. $nMonthName.' '.date("Y").'</h2>';
					echo draw_calendar($cNMonth,2015);
				?>
   
				<div class="field-wrap">
					<br/><strong>Next Two Months:</strong><br/>
            				<select name="nmonths">
						<option value=" "> 	Choose a Month </option>
                 				<option value="first"> 	November</option>
               					<option value="second"> December</option>
					</select>
        			</div>

				<?php	
					if(isset($_POST['nmonths']) )
					{
						$nmonth = $_POST['nmonths']; 

						if( $nmonth == "first")
						{
							echo '<h2 align="center" >Cooking Classes for November 2015</h2>';
							echo draw_calendar(11,2015);
						}

						if( $nmonth == "second")
						{
							echo '<h2 align="center" >Cooking Classes for December 2015</h2>';
							echo draw_calendar(12,2015);
						}
					}

				?> </h4>
    			</div>
  		</div>
	</body>
</html>