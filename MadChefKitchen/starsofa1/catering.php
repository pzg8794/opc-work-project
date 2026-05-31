<?php
/**
 */
?>


<!doctype html>
<html lang=en>

<head>
	<meta charset=utf-8>

		<style type ="text/css">
body::after {
  content: "";
  background: url(http://madchefkitchen.com/wp-content/uploads/2015/05/catering.jpg);
  
    background-repeat: no-repeat;
    background-size: 100% 100%;
  opacity: 0.2;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  position: absolute;
  z-index: -1;   
}

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
	
	word-wrap:break-word;
	text-align:left;
	font-family: 'FontAwesome', sans-serif; font-size: 15pt; 
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
			
			background-position: center;
			opacity: 0.01;
    filter: alpha(opacity=.10); /* For IE8 and earlier */
			position: absolute;
			z-index: -1;   
			
  content: "";
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
		}
	</style>
</head>
  
<body>
	<table class="table1">
		<tr>
			<th>
							<?php echo do_shortcode("[flgallery id=14 /]"); ?>
			</th>
			
			<td>
								Established in 2015, MadChefKitchen is pleased to offer catering services from 
								a very elegant cocktail party for 12 to a lavish dinner party for 125. Working 
								with our team, we custom create the event to your exact needs and desires down 
								to the last detail. Contact us for more information should you need assistance 
								with any type of venue.

								Sample catering menus are listed before from previous events we have performed.
			</td>
		</tr>
		
		<tr>
			<th  valign="top" style="width:33.3%">
				<div class="note yellow" style="width:100%">
					<table class="table2" align="center" style="width:100%">
						<tr>
						
						</tr>
					</table>
				</div>
			</th>
			
			<td  valign="top" style="width:33.3%">
				<div class="note yellow" style="width:100%">
					<table class="table2" align="rigth" style="width:100%">
						<tr>
					
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
</body>
</body>

</html>


