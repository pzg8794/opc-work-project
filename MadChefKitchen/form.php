<div id="container1">
	<?php
/* Set the default timezone */
date_default_timezone_set("America/Montreal");

/* Set the date */
$date = strtotime(date("Y-m-d"));

$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);
$firstDay = mktime(0,0,0,$month, 1, $year);
$title = strftime('%B', $firstDay);
$dayOfWeek = date('D', $firstDay);
$daysInMonth = cal_days_in_month(0, $month, $year);
/* Get the name of the week days */
$timestamp = strtotime('next Sunday');
$weekDays = array();
for ($i = 0; $i < 7; $i++) {
	$weekDays[] = strftime('%a', $timestamp);
	$timestamp = strtotime('+1 day', $timestamp);
}
$blank = date('w', strtotime("{$year}-{$month}-01"));
?>
<table class='table table-bordered' style="table-layout: fixed;">
	<tr>
		<th colspan="7" class="text-center"> <?php echo $title ?> <?php echo $year ?> </th>
	</tr>
	<tr>
		<?php foreach($weekDays as $key => $weekDay) : ?>
			<td class="text-center"><?php echo $weekDay ?></td>
		<?php endforeach ?>
	</tr>
	<tr>
		<?php for($i = 0; $i < $blank; $i++): ?>
			<td></td>
		<?php endfor; ?>
		<?php for($i = 1; $i <= $daysInMonth; $i++): ?>
			<?php if($day == $i): ?>
				<td><strong><?php echo $i ?></strong></td>
			<?php else: ?>
				<td><?php echo $i ?></td>
			<?php endif; ?>
			<?php if(($i + $blank) % 7 == 0): ?>
				</tr><tr>
			<?php endif; ?>
		<?php endfor; ?>
		<?php for($i = 0; ($i + $blank + $daysInMonth) % 7 != 0; $i++): ?>
			<td></td>
		<?php endfor; ?>
	</tr>
</table>
  
</div>
 
<div id="content1">    
	<div class="form">
      		<div class="tab-content1">
        		<div id="signup">   
          			<h1>Register for a Class</h1>
          
				<form action="/" method="post">
          				<div class="top-row">
            					<div class="field-wrap">
              						<label>
                						Name <span class="req">*</span>
              						</label>
              						<input type="name" required autocomplete="off" />
            					</div>
        
            					<div class="field-wrap">
              						<label>
                						Email <span class="req">*</span>
              						</label>
              						<input type="email"required autocomplete="off"/>
            					</div>
          				</div>
            
          				<div class="field-wrap">
            					<label>
              						Phone Number<span class="req">*</span>
            					</label>
            					<input type="number"required autocomplete="off"/>
          				</div>
          
            				<div class="field-wrap">
              					<!--<label>
              						<span class="req"> Choose Class and Date from Calendar</span>
            					</label> 
            					<input type="classtype"/>-->
            					<select name="classtype">
                  					<option value="volvo">Choose a Class</option>
                  					<option value="saab">SLIDERS and More</option>
                  					<option value="fiat">CLASSIC MEXICAN FLAVORS</option>
                  					<option value="audi">OKTOBERFEST</option>
                  					<option value="audi">PASTA BASICS(SAUCE)</option>
                  					<option value="audi">PASTA BASICS 101</option>
                  					<option value="audi">PASTA BASICS 201</option>
                  					<option value="audi">FALL IS IN THE AIR</option>
                 					<option value="audi">HALLOWEEN(TWEENS)</option>
                  					<option value="audi">HALLOWEEN(ADULTS)</option>
                  					<option value="audi">IT’S ALL ABOUT THE GOURD</option>
						</select>
            				</div>
          				<button type="submit" class="button button-block"/>Register</button>
          			</form>
        		</div>
        
        		<div id="login">   
        		</div>
        
      		</div><!-- tab-content -->
	</div> <!-- /form -->
    </div>
    
    <div id="sidebar">    
	<html>
		<head>   
			<link href="calendar.css" type="text/css" rel="stylesheet" />
		</head>
	
	</html>  

	<!-- <select name="classtype">
		option value="volvo">Choose a Class</option>
        	<option value="saab">SLIDERS and More</option>
        	<option value="fiat">CLASSIC MEXICAN FLAVORS</option>
        	<option value="audi">OKTOBERFEST</option>
        	<option value="audi">PASTA BASICS(SAUCE)</option>
        	<option value="audi">PASTA BASICS 101</option>
        	<option value="audi">PASTA BASICS 201</option>
        	<option value="audi">FALL IS IN THE AIR</option>
        	<option value="audi">HALLOWEEN(TWEENS)</option>
        	<option value="audi">HALLOWEEN(ADULTS)</option>
        	<option value="audi">IT’S ALL ABOUT THE GOURD</option>
	</select> -->
    
        <img id="octagon"/> 
		<strong><span style="font-family:; font-size: 10pt; color: black;">SLIDERS and More!</span></strong>
      	<img id="octagon1">
		<strong><span style="font-family:; font-size: 10pt; color: black;">CLASSIC MEXICAN FLAVORS</span></strong></p>
      	<img id="octagon2">
		<strong><span style="font-family:; font-size: 10pt; color: black;">SOKTOBERFEST</span></strong>
      	<img id="octagon4">
		<strong><span style="font-family:; font-size: 10pt; color: black;">FALL IS IN THE AIR</span></strong></p>
      	<img id="octagon3">
		<strong><span style="font-family:; font-size: 10pt; color: black;">PASTA BASICS(SAUCE)</span></strong>
      	<img id="octagon3">
		<strong><span style="font-family:; font-size: 10pt; color: black;">PASTA BASICS 101</span></strong></p>
   	<img id="octagon3">
		<strong><span style="font-family:; font-size: 10pt; color: black;"> PASTA BASICS 201</span></strong>
 	<img id="octagon5">
		<strong><span style="font-family:; font-size: 10pt; color: black;">HALLOWEEN(TWEENS))</span></strong></p>
 	<img id="octagon5">
		<strong><span style="font-family:; font-size: 10pt; color: black;">HALLOWEEN(ADULTS)</span></strong>
 	<img id="octagon6">
		<strong><span style="font-family:; font-size: 10pt; color: black;">IT’S ALL ABOUT THE GOURD</span></strong></p>	
	
	</div>
</div>

<div id="footer">
</div>