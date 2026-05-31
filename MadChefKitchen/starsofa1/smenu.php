<?php
/**
 */
?>

<!DOCTYPE html>
<html lang=en>

	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8">
		
		<style type ="text/css">
		<!-- CSS CODE FOR THE STRUCTURE OF THE  -->
		@import url(http://fonts.googleapis.com/css?family=Oxygen+Mono);
/* Please Keep this font import at the very top of any CSS file */
@charset "UTF-8";
/* Starter CSS for Flyout Menu */
#cssmenu {
  padding: 0;
  margin: 0;
  border: 0;
  line-height: 1;
  margin-left: -0%;
}
#cssmenu ul,
#cssmenu ul li,
#cssmenu ul ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
#menu
{
		position:relative;
		z-index:2;
}
#cssmenu ul {
	top:-0%;
	position: absolute;
	float: left;
  
    /*Step 2: Basic Button Styles*/
    width: 100%;
	background-color: none !important;
	
    /*opacity: 0;
    filter: alpha(opacity=0); */ /* For IE8 and earlier */
}
#cssmenu ul li {
  float: right;
  min-height: 1px;
  line-height: 1em;
  vertical-align: middle;
  position: relative;
}
#cssmenu ul li.hover,
#cssmenu ul li:hover {
  position:relative;
  z-index: 599;
  cursor: default;
}
#cssmenu ul ul {
  visibility: hidden;
  position: absolute;
  top: 100%;
  left: 0px;
  z-index: 598;
  width: 100%;
}
#cssmenu ul ul li {
  float: none;
}
#cssmenu ul ul ul {
  top: -2px;
  right: 0;
}
#cssmenu ul li:hover > ul {
  visibility: visible;
}
#cssmenu ul ul {
  top: 1px;
  left: 99%;
}
#cssmenu ul li {
  float: none;
}
#cssmenu ul ul {
  margin-top: 1px;
}
#cssmenu ul ul li {
  font-weight: normal;
}
/* Custom CSS Styles */
#cssmenu {
  width: 100px;
  background: purple;
  font-family: 'Oxygen Mono', Tahoma, Arial, sans-serif;
  zoom: 1;
  font-size: 12px;
}
#cssmenu:before {
  content: '';
  display: block;
}
#cssmenu:after {
  content: '';
  display: table;
  clear: both;
}
#cssmenu a {

  left:-110%;	
  display: block;
  padding: 5px 0px;
  text-decoration: none;
  text-transform: uppercase;
  
    border-collapse: collapse;
    z-index: 1;
  position: relative;
  font-family: 'Sansita One', cursive;
  
    display: inline-block
    padding: 5px 10px 5px 10px;
    font-family: 'Oxygen Mono', Tahoma, Arial, sans-serif;
}
#cssmenu > ul {
  width: 100px;
}
#cssmenu ul ul {
  width: 100px;
}
#cssmenu > ul > li > a {
  border-right: 0px solid #1b9bff;
  color: 003300;
  font-weight:bold;
  font-size:12px;
}
#cssmenu > ul > li > a:hover {
  color: #8B0000;
}
#cssmenu > ul > li.active a {
  background: #1b9bff;
}
#cssmenu > ul > li a:hover,
#cssmenu > ul > li:hover a {
	background-color: #F0FFFF;
}
#cssmenu li {
  position: absolute;
}
#cssmenu ul li.has-sub > a:after {
  content: '+';
  position: absolute;
  top: 50%;
  right: 15px;
  margin-top: -6px;
}
#cssmenu ul ul li.first {
  -webkit-border-radius: 0 3px 0 0;
  -moz-border-radius: 0 3px 0 0;
  border-radius: 0 3px 0 0;
}
#cssmenu ul ul li.last {
  -webkit-border-radius: 0 0 3px 0;
  -moz-border-radius: 0 0 3px 0;
  border-radius: 0 0 3px 0;
  border-bottom: 0;
}
#cssmenu ul ul {
  -webkit-border-radius: 0 3px 3px 0;
  -moz-border-radius: 0 3px 3px 0;
  border-radius: 0 3px 3px 0;
}
#cssmenu ul ul {
  border: 0px solid #0082e7;
}
#cssmenu ul ul a {
  font-size: 12px;
  color: #8B0000;
  font-weight:bold;
}
#cssmenu ul ul a:hover {
  color: #ffffff;
}
#cssmenu ul ul li {
  border-bottom: 0px solid #0082e7;
}
#cssmenu ul ul li:hover > a {
  background: #F0FFFF;
  color: 003300;
}
#cssmenu.align-right > ul > li > a {
  border-left: 4px solid #1b9bff;
  border-right: none;
  position: absolute;
  z-index: 597;
}
#cssmenu.align-right {
  float: right;
}
#cssmenu.align-right li {
  text-align: right;
}
#cssmenu.align-right ul li.has-sub > a:before {
  content: '+';
  position: absolute;
  top: 50%;
  left: 15px;
  margin-top: -6px;
}
#cssmenu.align-right ul li.has-sub > a:after {
  content: none;
}
#cssmenu.align-right ul ul {
  visibility: hidden;
  position: absolute;
  top: 0;
  left: -100%;
  z-index: 597;
  width: 100%;
}
#cssmenu.align-right ul ul li.first {
  -webkit-border-radius: 3px 0 0 0;
  -moz-border-radius: 3px 0 0 0;
  border-radius: 3px 0 0 0;
}
#cssmenu.align-right ul ul li.last {
  -webkit-border-radius: 0 0 0 3px;
  -moz-border-radius: 0 0 0 3px;
  border-radius: 0 0 0 3px;
}
#cssmenu.align-right ul ul {
  -webkit-border-radius: 3px 0 0 3px;
  -moz-border-radius: 3px 0 0 3px;
  border-radius: 3px 0 0 3px;
}

		</style>
	</head>
	
<body>

<div id='cssmenu'>
<ul>
   <li><a href='http://madchefkitchen.com/'><span> HOME </span></a></li>
   <li class='has-sub'><a href='http://madchefkitchen.com/explore/cooking-classes/'><span> CLASSES </span></a> 
<ul>
               <li><a href='http://madchefkitchen.com/explore/individual-cooking-lessons/'><span> Individualized Classes </span></a>
					<ul>
						<li><a href='#'><span>Online Classes </span></a></li>
						<li class='last'><a href='#'><span>In-Home Classes</span></a></li>
					</ul></li>
               <li class='last'><a href='http://madchefkitchen.com/class-schedules/'><span> Scheduled Classes </span></a>
            		<ul>
						<li><a href='#'><span>Online Classes </span></a></li>
						<li class='last'><a href='#'><span>In-Home Classes</span></a></li>
					</ul>
			</ul> </li>   
   <li class='has-sub'><a href='http://madchefkitchen.com/explore/'><span> SERVICES </span></a> 
   <ul>
               <li><a href='http://madchefkitchen.com/explore/private-chef-services/'><span> Private Chef </span></a></li>
               <li class='last'><a href='http://madchefkitchen.com/explore/the-personal-chef-services/'><span> Personal Chef </span></a></li>
			   
               <li><a href='http://madchefkitchen.com/explore/catering/'><span> Cateting </span></a></li>
			   
               <li><a href='http://madchefkitchen.com/explore/demonstrations/'><span> Demonstrations </span></a></li>
               <li class='last'><a href='http://madchefkitchen.com/explore/the-organized-kitchen-service/'><span> Organized Kitchen </span></a></li>
            </ul>
   </li>
   
   <li ><a href='http://madchefkitchen.com/hireus/'><span> HIRE A CHEF </span></a> </li>  
   <li> <a href='http://madchefkitchen.com/mckstore/'><span> MCK STORE </span></a></li>
   <li ><a href='http://madchefkitchen.com/recipe-2/'><span> RECIPES </span></a></li>
   <li ><a href='http://madchefkitchen.com/chefblog/'><span> CHEF'S BLOG </span></a></li> 
   <li ><a href='http://madchefkitchen.com/our-sponsors/'><span> OUR PARTNERS </span></a></li>
   <li><a href='http://madchefkitchen.com/our-story/'><span>  ABOUT US </span></a></li>
   <li ><a href='http://madchefkitchen.com/contact-us/'><span> CONTACT US </span></a></li>
   <li ><a href='http://madchefkitchen.com/signreg/'><span> MANAGEMENT </span></a></li>
   </ul>
</div>

</body>
</html>
