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
    			font-size:50%;
    			font-weight:bold;
    			text-align:center;
    		}

		td
		{
			width: 100%;
		}

   		h
		{
    			font-color:black;
    			font-size:10px;
    			font-weight:bold;
    			text-align:left;
    		}

    		cevent
		{
    			font-color:black;
    			font-size:5px;
    			font-weight:bold;
    			text-align:center;
    		}

    		h4{
			text-align: center;
			width: 100%;
		}

    		h
		{
    			position:absolute; bottom:230px; right:50px; color:navy; width:50px; text-align:center;
    			margin:5px auto 0;
    		}
    
	    	/* calendar */
		table.calendar	{ border-left:2px solid black;}
    		tr.calendar-row	{  				}
    		td.calendar-day	{ min-height:50px; font-size:10px; position:relative; } * html div.calendar-day { height:50px; }
    		td.calendar-day:hover	{ background:#FFFFFD; }
    		td.calendar-day-np	{ background:#eee; min-height:50px; } * html div.calendar-day-np { height:50px; }
    		td.calendar-day-head 	{ 
						background: #5F9EA0; color: white; font-size:5px; font-weight:bold; text-align:center; 
						width:10px; padding:5px; border-bottom:2px solid black; 
						border-top:2px solid black; border-right:2px solid black; 
					}

    		div.day-number7		{ 	background:gray; padding:5px; color:white; font-weight:bold; 
						float:right; margin:-5px -5px 0 0;
						width:30px; text-align:center; 
					}

    		div.day-number6		{ 	background:orange; padding:5px; color:white; font-weight:bold; 
						float:right; margin:-5px -5px 0 0;
						width:30px; text-align:center; 
					}

    		div.day-number5		{ 	background:purple; padding:5px; color:white; font-weight:bold; 
						float:right; margin:-5px -5px 0 0;
						width:30px; text-align:center; 
					}

    		div.day-number4		{ 	background:green; padding:5px; color:white; font-weight:bold; 
						float:right; margin:-5px -5px 0 0;
						width:30px; text-align:center; 
					}

    		div.day-number3		{ 	background:blue; padding:5px; color:white; font-weight:bold; 
						float:right; margin:-5px -5px 0 0;
						width:30px; text-align:center; 
					}

    		div.day-number2		{ 	background:yellow; padding:5px; color:white; font-weight:bold; 
						float:right; margin:-5px -5px 0 0;
						width:30px; text-align:center; 
					}

    		div.day-number1		{ 	background:red; padding:5px; color:white; font-weight:bold; 
						float:right; margin:-5px -5px 0 0;
						width:30px; text-align:center; 
					}

    		div.day-number		{ 	background:#5F9EA0; padding:5px; color:white; font-weight:bold; 
						float:right; margin:-5px -5px 0 0;
						width:30px; text-align:center; 
					}
    		
		/* shared */
    		td.calendar-day, td.calendar-day-np { width:50px; padding:5px; border-bottom:2px solid black; border-right:2px solid black; }
  	</style>
</head>
  
<body>
	<div id='container'>
    			<div id='content'>
      				<!--Start of the view_users_page content. 
      				<h3 class="red"> Click on any Class Event for more Details </h3> -->
     				<h4>
	      			<?php 
					/* draws a calendar */
					function draw_calendar($month,$year)
					{
						/* draw table */
						$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

						/* table headings */
						$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
						$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	 					/* days and weeks vars now ... */
						$running_day 		= date('w',mktime(0,0,0,$month,1,$year));
						$days_in_month 		= date('t',mktime(0,0,0,$month,1,$year));
						$days_in_this_week 	= 1;
						$day_counter 		= 0;
						$dates_array 		= array();

						/* row for week one */
						$calendar.= '<tr class="calendar-row">';

	    					/* print "blank" days until the first of the current week */
						for($x = 0; $x < $running_day; $x++):
							$calendar.= '<td class="calendar-day-np"> </td>';
							$days_in_this_week++;
						endfor;

	   					/* keep going with days.... */
						for($list_day = 1; $list_day <= $days_in_month; $list_day++):
							$calendar.= '<td class="calendar-day">';
			
							/* add in the day number */
							if($month == "9" && $list_day == "12"){
								$calendar.= '<div class="day-number1">'.$list_day.'</div>';
								$calendar.= str_repeat('<cevent> <a href="#" data-toggle="tooltip" title="Celebrate the end of summer with tasty sliders. Our Chef/Instructors will teach you about grinding your own meat for more flavorful burgers. You will create a Red, White, and Blue Burger using freshly ground beef, blue cheese, lettuce, and sweet onions on a homemade sesame seed slider bun. For your second slider, you will learn to make a simple pickling solution for onions and cucumbers and a fresh tomato chutney. These will be served atop a grilled Portobello mushroom open face on a homemade roll. You will make plank cut French fries and thinner cut sweet potato fries. To celebrate National Chocolate Milkshake Day, you will finish your meal with a creamy chocolate shake.">
								SLIDERS & More<br> 10am-1pm </a></cevent>',1);
							}

							else if($month == "9" && $list_day == "13")
							{	
								$calendar.= '<div class="day-number6">'.$list_day.'</div>';
								$calendar.= str_repeat('<cevent> <a href="#" data-toggle="tooltip" title=" September 16th is Mexican Independence Day, and to celebrate our Chef/Instructors are offering a twist on classic Mexican flavors. You will start your class with a fresh pico de gallo and a choice of baked or fried tortilla chips. Next you will make a fresh green tomatillo salsa you can eat with chips, which will also serve as the base for a shredded chicken and cheese enchilada. A simple adjustment and you can make a cheese enchilada for those who do not eat meat. While your enchiladas are baking, you will make refried beans to round out your meal. You will finish your Mexican Independence Celebration with Tres Leches Cake.">
								CLASSIC MEXICAN FLAVORS with a Twist<br> 10am-1pm </a> </cevent>',1);
							}

							else if($month == "9" && $list_day == "18")
							{								
								$calendar.= '<div class="day-number2">'.$list_day.'</div>';
								$calendar.= str_repeat('<cevent> <a href="#" data-toggle="tooltip" title=" September 19th kicks of Oktoberfest and what better way to celebrate then fresh sausages and beer. Strike up the oompah-pah band and dig out your lederhosen and join us to kick off Oktoberfest. Our Chef/Instructor will teach you the techniques to making fresh sausages, from grinding your own meat and picking your seasonings, to choosing and sourcing casings. You will make a beef, a chicken, a pork, and a vegetarian sausage. You will create a beer-braised red cabbage with apples and onions and round out your meal with homemade spaetzli with a brown butter sauce. There will be different beers to taste and pair with your sausages. Prosit!"> 
								OKTOBERFEST! It is Sausage & Beer<br> (must be 21 years old)<br> 6pm-9pm</a></cevent>',1);
							}

							else if($month == "9" && $list_day == "19")
							{
								$calendar.= '<div class="day-number3">'.$list_day.'</div>';
								$calendar.= str_repeat('<cevent> <a href="#" data-toggle="tooltip" title=" Master the quick meal using pasta, the secret is in the sauce. You will create a slowly simmered red sauce which can be frozen and then thawed for a quick week-night meal. This classic marinara then becomes the basis for a vodka sauce, a clam sauce, and a simple meat sauce. You will learn to make a healthy fresh tomato sauce with vegetables for a simple take on the classic primavera. Next, a rich, creamy Alfredo can set the stage for a romantic dinner on date night. You will finish your sauce class with a pesto sauce that you can adapt, depending upon the ingredients in your pantry.">  
								PASTA BASICS:  It is all about the Sauce<br> 10am-1pm</a></cevent>',1);
							}

							else if($month == "9" && $list_day == "26")
							{
								$calendar.= '<div class="day-number3">'.$list_day.'</div>';
								$calendar.= str_repeat('<cevent> <a href="#" data-toggle="tooltip" title=" Create fresh pasta from simple ingredients. You will use a manual and a motorized pasta machine. You will start your evening with lasagna roll ups. While your fresh dough is resting, you will create a basic tomato sauce which becomes a springboard for your own flavor creations. You will create spaghetti, tagliatelle, and fettuccine noodles. As your pasta cooks you will turn your attention to a classic Alfredo. You will finish your meal with a lemon panna cotta.">  
								PASTA BASICS 101:  Making Fresh Pasta<br> 10am-1pm</a></cevent>',1);
							}

							else if($month == "10" && $list_day == "3")
							{
								$calendar.= '<div class="day-number4">'.$list_day.'</div>';
								$calendar.= str_repeat('<cevent> <a href="#" data-toggle="tooltip" title=" Have fun with fall ingredients and new techniques. Master a simple risotto you can start in advance before your guests arrive and finish in 10 minutes, just before dinner is served. Use your leftover risotto to make risotto balls and freeze as an appetizer for your next party. For a twist on the dreaded brussels sprout, a brussels sprout ceasar salad with rosemary-cranberry crouton. A simple pork tenderloin stuffed with cranberries and apricots, and glazed with an apple cider reduction. We will finish the evening with a simple chocolate pot au creme."> 
								FALL IS IN THE AIR<br> 12pm-3pm</a></cevent>',1);
							}

							else if($month == "10" && $list_day == "10")
							{
								$calendar.= '<div class="day-number3">'.$list_day.'</div>';
								$calendar.= str_repeat('<cevent> <a href="#" data-toggle="tooltip" title=" You have mastered the basics, now you will step it up a notch. You will start your evening with a Caprese salad on a stick with a balsamic drizzle Learn how to make a fresh gnocchi with a walnut pesto, fresh ravioli using two different fillings and two different tools, and create a decadent pasta al quattro fromaggio using a pasta extruder to make the pasta. You will finish your pasta experience with a southern classic simple beef with fresh egg noodles."> 
								PASTA BASICS 201:  Variations on a Theme<br> 12pm-3pm </a></cevent>',1);
							}

							else if($month == "10" && $list_day == "11")
							{
								$calendar.= '<div class="day-number3">'.$list_day.'</div>';
								$calendar.= str_repeat('<cevent> <a href="#" data-toggle="tooltip" title=" Create fresh pasta from simple ingredients. You will use a manual and a motorized pasta machine. You will start your evening with lasagna roll ups. While your fresh dough is resting, you will create a basic tomato sauce which becomes a springboard for your own flavor creations. You will create spaghetti, tagliatelle, and fettuccine noodles. As your pasta cooks you will turn your attention to a classic Alfredo. You will finish your meal with a lemon panna cotta."> 
								PASTA BASICS 101:  Making Fresh Pasta<br> 11am - 2pm </a></cevent>',1);
							}

							else if($month == "10" && $list_day == "17")
							{
								$calendar.= '<div class="day-number5">'.$list_day.'</div>';
								$calendar.= str_repeat('<cevent> <a href="#" data-toggle="tooltip" title=" Still working on the recipes and descriptions for this class."> 
								HALLOWEEN FOR TWEENS<br> 10am-12pm </a></cevent>',1);
							}

							else if($month == "10" && $list_day == "17")
							{
								$calendar.= '<div class="day-number5">'.$list_day.'</div>';
								$calendar.= str_repeat('<cevent> <a href="#" data-toggle="tooltip" title=" Still working on the recipes and descriptions for this class">
								HALLOWEEN FOR ADULTS<br> 2pm-5pm </a></cevent>',1);
							}

							else if($month == "10" && $list_day == "18")
							{
								$calendar.= '<div class="day-number3">'.$list_day.'</div>';
								$calendar.= str_repeat('<cevent> <a href="#" data-toggle="tooltip" title=" You have mastered the basics, now you will step it up a notch. You will start your evening with a Caprese salad on a stick with a balsamic drizzle Learn how to make a fresh gnocchi with a walnut pesto, fresh ravioli using two different fillings and two different tools, and create a decadent pasta al quattro fromaggio using a pasta extruder to make the pasta. You will finish your pasta experience with a southern classic, simple beef with fresh egg noodles.">
								PASTA BASICS 201:  Variations on a Theme<br> 12pm-3pm </a></cevent>',1);
							}


							else if($month == "10" && $list_day == "24")
							{
								$calendar.= '<div class="day-number7">'.$list_day.'</div>';
								$calendar.= str_repeat('<cevent> <a href="#" data-toggle="tooltip" title=" Still working on the recipes and descriptions for this class">
								IT IS ALL ABOUT THE GOURD: Are you a Pumpkin Eater?<br> 2pm-3pm </a></cevent>',1);
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

					echo draw_calendar(9,2015);
				?>
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

					// echo '<h2 align="center" >Cooking Classes for November 2015</h2>';
					//echo draw_calendar(11,2015);

					//echo '<h2 align="center" >Cooking Classes for December 2015</h2>';
					//echo draw_calendar(12,2015);
				?>
      				</h4>
    			</div>
  		</div>
	</body>
</html>