<?php
/**
Template Name: testpage
 */

 	get_header(); 
?>

<!doctype html>
<html lang=en>

<head>
	<meta charset=utf-8>
</head>
  
<body>

<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','height=450,width=270');
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>


<a href="http://madchefkitchen.com/class/" onclick="return popitup('http://madchefkitchen.com/class/')"
	>Link to popup</a>

</body>
	<?php get_footer(); ?>
</html>


