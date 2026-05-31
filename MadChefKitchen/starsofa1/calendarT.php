<?php
/**
 */
 	get_template_part('theloop');	
?>

<!DOCTYPE html>
<html lang=en>
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8">
		<!-- CSS CODE FOR THE STRUCTURE OF THE  -->
		<style type ="text/css">
		@import url('demo.css');

@font-face {
  font-family: 'fontawesome-selected';
  src: url("../font/fontawesome-selected.eot");
  src: url("../font/fontawesome-selected.eot?#iefix") format('embedded-opentype'), url("../font/fontawesome-selected.woff") format('woff'), url("../font/fontawesome-selected.ttf") format('truetype'), url("../font/fontawesome-selected.svg#fontawesome-selected") format('svg');
  font-weight: normal;
  font-style: normal;
}

.fc-calendar-container {
	position: relative;
	height: 400px;
	width: 400px;
}

.fc-calendar {
	width: 100%;
	height: 100%;
}

.fc-calendar .fc-head {
	height: 30px;
	line-height: 30px;
	background: #ccc;
	color: #fff;
}

.fc-calendar .fc-body {
	position: relative;
	width: 100%;
	height: 100%;
	height: -moz-calc(100% - 30px);
	height: -webkit-calc(100% - 30px);
	height: calc(100% - 30px);
	border: 1px solid #ddd;
}

.fc-calendar .fc-row {
	width: 100%;
	border-bottom: 1px solid #ddd;
}

.fc-four-rows .fc-row  {
	height: 25%;
}

.fc-five-rows .fc-row  {
	height: 20%;
}

.fc-six-rows .fc-row {
	height: 16.66%;
	height: -moz-calc(100%/6);
	height: -webkit-calc(100%/6);
	height: calc(100%/6);
}

.fc-calendar .fc-row > div,
.fc-calendar .fc-head > div {
	float: left;
	height: 100%;
	width:  14.28%; /* 100% / 7 */
	width: -moz-calc(100%/7);
	width: -webkit-calc(100%/7);
	width: calc(100%/7);
	position: relative;
}

/* IE 9 is rounding up the calc it seems */
.ie9 .fc-calendar .fc-row > div,
.ie9 .fc-calendar .fc-head > div {
	width:  14.2%;
}

.fc-calendar .fc-row > div {
	border-right: 1px solid #ddd;
	padding: 4px;
	overflow: hidden;
	position: relative;
}

.fc-calendar .fc-head > div {
	text-align: center;
}

.fc-calendar .fc-row > div > span.fc-date {
	position: absolute;
	width: 30px;
	height: 20px;
	font-size: 20px;
	line-height: 20px;
	font-weight: 700;
	color: #ddd;
	text-shadow: 0 -1px 0 rgba(255,255,255,0.8);
	bottom: 5px;
	right: 5px;
	text-align: right;
}

.fc-calendar .fc-row > div > span.fc-weekday {
	padding-left: 5px;
	display: none;
}

.fc-calendar .fc-row > div.fc-today {
	background: #fff4c3;
}

.fc-calendar .fc-row > div.fc-out {
	opacity: 0.6;
}

.fc-calendar .fc-row > div:last-child,
.fc-calendar .fc-head > div:last-child {
	border-right: none;
}

.fc-calendar .fc-row:last-child {
	border-bottom: none;
}

		</style>
		
		
		<style type ="text/css">
		
		body {
	background: #cebe29;
	background: -moz-linear-gradient(-45deg, #cebe29 0%, #9b1f50 33%, #2989d8 71%, #89b4ff 91%);
	background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,#cebe29), color-stop(33%,#9b1f50), color-stop(71%,#2989d8), color-stop(91%,#89b4ff));
	background: -webkit-linear-gradient(-45deg, #cebe29 0%,#9b1f50 33%,#2989d8 71%,#89b4ff 91%);
	background: -o-linear-gradient(-45deg, #cebe29 0%,#9b1f50 33%,#2989d8 71%,#89b4ff 91%);
	background: -ms-linear-gradient(-45deg, #cebe29 0%,#9b1f50 33%,#2989d8 71%,#89b4ff 91%);
	background: linear-gradient(135deg, #cebe29 0%,#9b1f50 33%,#2989d8 71%,#89b4ff 91%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cebe29', endColorstr='#89b4ff',GradientType=1 );
	-webkit-background-size: 100% 100%;
	-moz-background-size: 100% 100%;
	background-size: 100% 100%;
}

.custom-calendar-full {
	position: absolute;
	top: 24px;
	bottom: 0px;
	left: 0px;
	width: 100%;
	height: auto;
}

.fc-calendar-container {
	height: auto;
	bottom: 0px;
	width: 100%;
	top: 50px;
	position: absolute;
}

.custom-header {
	padding: 20px 20px 10px 30px;
	height: 50px;
	position: relative;
}

.custom-header h2,
.custom-header h3 {
	float: left;
	font-weight: 300;
	text-transform: uppercase;
	letter-spacing: 4px;
	text-shadow: 1px 1px 0 rgba(0,0,0,0.1);
}

.custom-header h2 {
	color: #fff;
	width: 60%;
}

.custom-header h2 a, 
.custom-header h2 span {
	color: rgba(255,255,255,0.3);
	font-size: 18px;
	letter-spacing: 3px;
	white-space: nowrap;
}

.custom-header h2 a {
	color: rgba(255,255,255,0.5);
}

.no-touch .custom-header h2 a:hover {
	color: rgba(255,255,255,0.9);
}

.custom-header h3 {
	width: 40%;
	color: #ddd;
	color: rgba(255,255,255,0.6);
	font-weight: 300;
	line-height: 30px;
	text-align: right;
	padding-right: 125px;
}

.custom-header nav {
	position: absolute;
	right: 20px;
	top: 20px;
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}

.custom-header nav span {
	float: left;
	width: 30px;
	height: 30px;
	position: relative;
	color: transparent;
	cursor: pointer;
	background: rgba(255,255,255,0.3);
	margin: 0 1px;
	font-size: 20px;
	border-radius: 0 3px 3px 0;
	box-shadow: inset 0 1px rgba(255,255,255,0.2);
}

.custom-header nav span:first-child {
	border-radius: 3px 0 0 3px;
}

.custom-header nav span:hover {
	background: rgba(255,255,255,0.5);
}

.custom-header span:before {
	font-family: 'fontawesome-selected';
	color: #fff;
	display: inline-block;
	text-align: center;
	width: 100%;
	text-indent: 4px;
}

.custom-header nav span.custom-prev:before {
	content: '\25c2';
}

.custom-header nav span.custom-next:before {
	content: '\25b8';
}

.custom-header nav span:last-child {
	margin-left: 20px;
	border-radius: 3px;
}

.custom-header nav span.custom-current:before {
	content: '\27a6';
}


.fc-calendar {
	background: rgba(255,255,255,0.1);
	width: auto;
	top: 10px;
	bottom: 20px;
	left: 20px;
	right: 20px;
	height: auto;
	border-radius: 20px;
	position: absolute;
}

.fc-calendar .fc-head { 
	background: rgba(255,255,255,0.2);
	color: rgba(255,255,255,0.9);
	box-shadow: inset 0 1px 0 rgba(255,255,255,0.2);
	border-radius: 20px 20px 0 0;
	height: 40px;
	line-height: 40px;
	padding: 0 20px;
}

.fc-calendar .fc-head > div {
	font-weight: 300;
	text-transform: uppercase;
	font-size: 14px;
	letter-spacing: 3px;
	text-shadow: 0 1px 1px rgba(0,0,0,0.4);
}

.fc-calendar .fc-row > div > span.fc-date {
	color: rgba(255,255,255,0.9);
	text-shadow: none;
	font-size: 26px;
	font-weight: 300;
	bottom: auto;
	right: auto;
	top: 10px;
	left: 10px;
	text-align: left;
	text-shadow: 0 1px 1px rgba(0,0,0,0.3);
}

.fc-calendar .fc-body {
	border: none;
	padding: 20px;
}

.fc-calendar .fc-row {
	box-shadow: inset 0 -1px 0 rgba(255,255,255,0.2);
	border: none;
}

.fc-calendar .fc-row:last-child {
	box-shadow: none;
}

.fc-calendar .fc-row:first-child > div:first-child {
	border-radius: 10px 0 0 0;
}

.fc-calendar .fc-row:first-child > div:last-child {
	border-radius: 0 10px 0 0;
}

.fc-calendar .fc-row:last-child > div:first-child {
	border-radius: 0 0 0 10px;
}

.fc-calendar .fc-row:last-child > div:last-child {
	border-radius: 0 0 10px 0;
}

.fc-calendar .fc-row > div {
	box-shadow: -1px 0 0 rgba(255, 255, 255, 0.2);
	border: none;
	padding: 10px;
	cursor: pointer;
}

.fc-calendar .fc-row > div:first-child{
	box-shadow: none;
}

.fc-calendar .fc-row > div.fc-today {
	background: transparent;
	box-shadow: inset 0 0 100px rgba(255,255,255,0.1);
}

.fc-calendar .fc-row > div.fc-today:after { 
	content: ''; 
	display: block;
	position: absolute;
	top: 0; 
	left: 0;
	width: 100%;
	height: 100%;
	opacity: 0.2;
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgba(255, 255, 255, 0.15)), to(rgba(0, 0, 0, 0.25))), -webkit-gradient(linear, left top, right bottom, color-stop(0, rgba(255, 255, 255, 0)), color-stop(0.5, rgba(255, 255, 255, .15)), color-stop(0.501, rgba(255, 255, 255, 0)), color-stop(1, rgba(255, 255, 255, 0)));
	background: -moz-linear-gradient(top, rgba(255, 255, 255, 0.15), rgba(0, 0, 0, 0.25)), -moz-linear-gradient(left top, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0));
	background: -o-linear-gradient(top, rgba(255, 255, 255, 0.15), rgba(0, 0, 0, 0.25)), -o-llinear-gradient(left top, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0));
	background: -ms-linear-gradient(top, rgba(255, 255, 255, 0.15), rgba(0, 0, 0, 0.25)), -ms-linear-gradient(left top, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0));
	background: linear-gradient(top, rgba(255, 255, 255, 0.15), rgba(0, 0, 0, 0.25)), linear-gradient(left top, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0));
}

.fc-calendar .fc-row > div > div {
	margin-top: 35px;
}

.fc-calendar .fc-row > div > div a,
.fc-calendar .fc-row > div > div span {
	color: rgba(255,255,255,0.7);
	font-size: 12px;
	text-transform: uppercase;
	display: inline-block;
	padding: 3px 5px;
	border-radius: 3px;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
	max-width: 100%;
	margin-bottom: 1px;
	background: rgba(255,255,255,0.1);
}

.no-touch .fc-calendar .fc-row > div > div a:hover {
	background: rgba(255,255,255,0.3);
}

@media screen and (max-width: 880px) , screen and (max-height: 450px) {
	html, body, .container {
		height: auto;
	}

	.custom-header,
	.custom-header nav,
	.custom-calendar-full,
	.fc-calendar-container, 
	.fc-calendar,
	.fc-calendar .fc-head,
	.fc-calendar .fc-row > div > span.fc-date {
		position: relative;
		top: auto;
		left: auto;
		bottom: auto;
		right: auto;
		height: auto;
		width: auto;
	}

	.fc-calendar {
		margin: 0 20px 20px;
	}

	.custom-header h2,
	.custom-header h3 {
		float: none;
		width: auto;
		text-align: left;
		padding-right: 100px;
	}

	.fc-calendar .fc-row,
	.ie9 .fc-calendar .fc-row > div,
	.fc-calendar .fc-row > div {
		height: auto;
		width: 100%;
		border: none;
	}

	.fc-calendar .fc-row > div {
		float: none;
		min-height: 50px;
		box-shadow: inset 0 -1px rgba(255,255,255,0.2) !important;
		border-radius: 0px !important;
	}

	.fc-calendar .fc-row > div:empty{
		min-height: 0;
		height: 0;
		box-shadow: none !important;
		padding: 0;
	}

	.fc-calendar .fc-row {
		box-shadow: none;
	}

	.fc-calendar .fc-head {
		display: none;
	}

	.fc-calendar .fc-row > div > div {
		margin-top: 0px;
		padding-left: 10px;
		max-width: 70%;
		display: inline-block;
	}

	.fc-calendar .fc-row > div.fc-today {
		background: rgba(255, 255, 255, 0.2);
	}

	.fc-calendar .fc-row > div.fc-today:after { 
		display: none;
	}

	.fc-calendar .fc-row > div > span.fc-date {
		width: 30px;
		display: inline-block;
		text-align: right;
	}

	.fc-calendar .fc-row > div > span.fc-weekday {
		display: inline-block;
		width: 40px;
		color: #fff;
		color: rgba(255,255,255,0.7);
		font-size: 10px;
		text-transform: uppercase;
	}
}		
		</style>
		
		
		
		<style type ="text/css">
		/* Custom calendar elements */

.custom-calendar-wrap {
	margin: 10px auto;
	position: relative;
	overflow: hidden;
}

.custom-inner {
	background: #fff;
	box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}

.custom-inner:before,
.custom-inner:after  {
	content: '';
	width: 99%;
	height: 50%;
	position: absolute;
	background: #f6f6f6;
	bottom: -4px;
	left: 0.5%;
	z-index: -1;
	box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}

.custom-inner:after {
	content: '';
	width: 98%;
	bottom: -7px;
	left: 1%;
	z-index: -2;
}

.custom-header {
	background: #fff;
	padding: 5px 10px 10px 20px;
	height: 70px;
	position: relative;
	border-top: 5px solid #ef4f69;
	border-bottom: 1px solid #ddd;
}

.custom-header h2,
.custom-header h3 {
	text-align: center;
	text-transform: uppercase;
}

.custom-header h2 {
	color: #495468;
	font-weight: 300;
	font-size: 18px;
	margin-top: 10px;
}

.custom-header h3 {
	font-size: 10px;
	font-weight: 700;
	color: #b7bbc2;
}

.custom-header nav span {
	position: absolute;
	top: 17px;
	width: 30px;
	height: 30px;
	color: transparent;
	cursor: pointer;
	margin: 0 1px;
	font-size: 20px;
	line-height: 30px;
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}

.custom-header nav span:first-child {
	left: 5px;
}

.custom-header nav span:last-child {
	right: 5px;
}

.custom-header nav span:before {
	font-family: 'fontawesome-selected';
	color: #ef4f69;
	position: absolute;
	text-align: center;
	width: 100%;
}

.custom-header nav span.custom-prev:before {
	content: '\25c2';
}

.custom-header nav span.custom-next:before {
	content: '\25b8';
}

.custom-header nav span:hover:before {
	color: #495468;
}

.custom-content-reveal {
	background: #f6f6f6;
	background: rgba(246, 246, 246, 0.9);
	width: 100%;
	height: 100%;
	position: absolute;
	z-index: 100;
	top: 100%;
	left: 0px;
	text-align: center;
	-webkit-transition: all 0.6s ease-in-out;
	-moz-transition: all 0.6s ease-in-out;
	-o-transition: all 0.6s ease-in-out;
	-ms-transition: all 0.6s ease-in-out;
	transition: all 0.6s ease-in-out;
}

.custom-content-reveal span.custom-content-close {
	position: absolute;
	top: 15px;
	right: 10px;
	width: 20px;
	height: 20px;
	text-align: center;
	background: #ef4f69;
	box-shadow: 0 1px 1px rgba(0,0,0,0.1);
	cursor: pointer;
	line-height: 13px;
	padding: 0;
}

.custom-content-reveal span.custom-content-close:after {
	content: 'x';
	font-size: 18px;
	color: #fff;
}

.custom-content-reveal a,
.custom-content-reveal span {
	font-size: 22px;
	padding: 10px 30px;
	display: block;
}

.custom-content-reveal h4 {
	text-transform: uppercase;
	font-size: 13px;
	font-weight: 300;
	letter-spacing: 3px;
	color: #777;
	padding: 20px;
	background: #fff;
	border-bottom: 1px solid #ddd;
	border-top: 5px solid #ef4f69;
	box-shadow: 0 1px rgba(255,255,255,0.9);
	margin-bottom: 30px;
}

.custom-content-reveal span {
	color: #888;
}

.custom-content-reveal a {
	color: #ef4f69;
}

.custom-content-reveal a:hover {
	color: #333;
}

/* Modifications */

.fc-calendar-container {
	height: 400px;
	width: auto;
	padding: 30px;
	background: #f6f6f6;
	box-shadow: inset 0 1px rgba(255,255,255,0.8);
}

.fc-calendar .fc-head {
	background: transparent;
	color: #ef4f69;
	font-weight: bold;
	text-transform: uppercase;
	font-size: 12px;
}

.fc-calendar .fc-row > div {
	background: #fff;
	cursor: pointer;
}

.fc-calendar .fc-row > div:empty {
	background: transparent;
}

.fc-calendar .fc-row > div > span.fc-date {
	top: 50%;
	left: 50%;
	text-align: center;
	margin: -10px 0 0 -15px;
	color: #686a6e;
	font-weight: 400;
	pointer-events: none;
}

.fc-calendar .fc-row > div.fc-today {
	background: #ef4f69;
	box-shadow: inset 0 -1px 1px rgba(0,0,0,0.1);
}

.fc-calendar .fc-row > div.fc-today > span.fc-date {
	color: #fff;
	text-shadow: 0 1px 1px rgba(0,0,0,0.1);
}

.fc-calendar .fc-row > div.fc-content:after {
	content: '\00B7';
	text-align: center;
	width: 20px;
	margin-left: -10px;
	position: absolute;
	color: #DDD;
	font-size: 70px;
	line-height: 20px;
	left: 50%;
	bottom: 3px;
}

.fc-calendar .fc-row > div.fc-today.fc-content:after {
	color: #b02c42;
}

.fc-calendar .fc-row > div.fc-content:hover:after{
	color: #ef4f69;
}

.fc-calendar .fc-row > div.fc-today.fc-content:hover:after{
	color: #fff;
}

.fc-calendar .fc-row > div > div a,
.fc-calendar .fc-row > div > div span {
	display: none;
	font-size: 22px;
}

@media screen and (max-width: 400px) {
	.fc-calendar-container {
		height: 300px;
	}
	.fc-calendar .fc-row > div > span.fc-date {
		font-size: 15px;
	}
}

		
		
		</style>
		
		<style type ="text/css">
		/* General Demo Style */
@import url(http://fonts.googleapis.com/css?family=Lato:300,400,700);

html { height: 100%; }

*,
*:after,
*:before {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	padding: 0;
	margin: 0;
}

/* Clearfix hack by Nicolas Gallagher: http://nicolasgallagher.com/micro-clearfix-hack/ */
.clearfix:before,
.clearfix:after {
    content: " "; /* 1 */
    display: table; /* 2 */
}

.clearfix:after {
    clear: both;
}

.clearfix {
    *zoom: 1;
}

body {
    font-family: 'Lato', Calibri, Arial, sans-serif;
    background: #f9f9f9 url(../images/bg.jpg);
    font-weight: 300;
    font-size: 15px;
    color: #333;
    height: 100%;
}

a {
	color: #555;
	text-decoration: none;
}

.container {
	width: 100%;
	height: 100%;
	position: relative;
}

.container > header,
.main {
	padding: 0 30px 50px 30px;
	width: 100%;
	max-width: 600px;
	margin: 0 auto;
}

.container > header {
	padding: 30px;
}

.container > header h1 {
	font-size: 34px;
	line-height: 38px;
	margin: 0;
	font-weight: 700;
	color: #fff;
	float: left;
	text-shadow: 0 1px 1px rgba(0,0,0,0.3);
}

.container > header h1 span {
	font-size: 18px;
	font-weight: 300;
	display: block;
}

/* Header Style */
.codrops-top {
	line-height: 24px;
	font-size: 11px;
	background: #fff;
	background: rgba(255, 255, 255, 0.5);
	text-transform: uppercase;
	z-index: 9999;
	position: relative;
	box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
}

.codrops-top a {
	padding: 0px 10px;
	letter-spacing: 1px;
	color: #333;
	display: inline-block;
}

.codrops-top a:hover {
	background: rgba(255,255,255,0.8);
	color: #000;
}

.codrops-top span.right {
	float: right;
}

.codrops-top span.right a {
	float: left;
	display: block;
}

/* Demo Buttons Style */
.codrops-demos {
	float: right;
}

.codrops-demos a {
    display: inline-block;
    margin: 10px;
    color: #fff;
    font-weight: 700;
    line-height: 30px;
    border-bottom: 4px solid transparent;
}

.codrops-demos a:hover {
	color: #000;
	border-color: #000;
}

.codrops-demos a.current-demo,
.codrops-demos a.current-demo:hover {
	color: rgba(255,255,255,0.5);
	border-color: rgba(255,255,255,0.5);
}
		
		
		</style>
		
		<script src="js/modernizr.custom.63321.js"></script>
	
	</head>
	

	<body>
		<div class="container">	
			<!-- Codrops top bar -->
			<div class="codrops-top clearfix">
				<a href="http://tympanus.net/Development/Stapel/"><strong>&laquo; Previous Demo: </strong>Adaptive Thumbnail Pile Effect</a>
				<span class="right">
					<a href="http://tympanus.net/codrops/?p=12416"><strong>Back to the Codrops Article</strong></a>
				</span>
			</div><!--/ Codrops top bar -->
			<header class="clearfix">
				<h1>Flexible Calendar <span>with jQuery and CSS3</span></h1>
				<nav class="codrops-demos">
					<a href="index.html">Demo 1</a>
					<a class="current-demo" href="index2.html">Demo 2</a>
				</nav>
			</header>
			<section class="main">
				<div class="custom-calendar-wrap">
					<div id="custom-inner" class="custom-inner">
						<div class="custom-header clearfix">
							<nav>
								<span id="custom-prev" class="custom-prev"></span>
								<span id="custom-next" class="custom-next"></span>
							</nav>
							<h2 id="custom-month" class="custom-month"></h2>
							<h3 id="custom-year" class="custom-year"></h3>
						</div>
						<div id="calendar" class="fc-calendar-container"></div>
					</div>
				</div>
			</section>
		</div><!-- /container -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.calendario.js"></script>
		<script type="text/javascript" src="js/data.js"></script>
		<script type="text/javascript">	
			$(function() {
			
				var transEndEventNames = {
						'WebkitTransition' : 'webkitTransitionEnd',
						'MozTransition' : 'transitionend',
						'OTransition' : 'oTransitionEnd',
						'msTransition' : 'MSTransitionEnd',
						'transition' : 'transitionend'
					},
					transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
					$wrapper = $( '#custom-inner' ),
					$calendar = $( '#calendar' ),
					cal = $calendar.calendario( {
						onDayClick : function( $el, $contentEl, dateProperties ) {

							if( $contentEl.length > 0 ) {
								showEvents( $contentEl, dateProperties );
							}

						},
						caldata : codropsEvents,
						displayWeekAbbr : true
					} ),
					$month = $( '#custom-month' ).html( cal.getMonthName() ),
					$year = $( '#custom-year' ).html( cal.getYear() );

				$( '#custom-next' ).on( 'click', function() {
					cal.gotoNextMonth( updateMonthYear );
				} );
				$( '#custom-prev' ).on( 'click', function() {
					cal.gotoPreviousMonth( updateMonthYear );
				} );

				function updateMonthYear() {				
					$month.html( cal.getMonthName() );
					$year.html( cal.getYear() );
				}

				// just an example..
				function showEvents( $contentEl, dateProperties ) {

					hideEvents();
					
					var $events = $( '<div id="custom-content-reveal" class="custom-content-reveal"><h4>Events for ' + dateProperties.monthname + ' ' + dateProperties.day + ', ' + dateProperties.year + '</h4></div>' ),
						$close = $( '<span class="custom-content-close"></span>' ).on( 'click', hideEvents );

					$events.append( $contentEl.html() , $close ).insertAfter( $wrapper );
					
					setTimeout( function() {
						$events.css( 'top', '0%' );
					}, 25 );

				}
				function hideEvents() {

					var $events = $( '#custom-content-reveal' );
					if( $events.length > 0 ) {
						
						$events.css( 'top', '100%' );
						Modernizr.csstransitions ? $events.on( transEndEventName, function() { $( this ).remove(); } ) : $events.remove();

					}

				}
			
			});
		</script>
	</body>
</html>
