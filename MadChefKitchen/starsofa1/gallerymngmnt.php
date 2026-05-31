<?php
/**
	Template Name: testpage
 */
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login Form</title>

		<style type ="text/css">
h1{
	font-size:30px;
	font-family:'Lato',sans-serif;
	color:black;
	text-align:center;
}
		</style>

		<script type="text/javascript">	

		</script>
		
	</head>

	<body>
	
		<h1> Upload Image(s) To MadChefKitchen Gallery 
		<form id="featured_upload" method="post" action="#" enctype="multipart/form-data">
			<input type="file" name="my_file_upload[]" id="my_file_upload[]" multiple="multiple">
			<input type="hidden" name="post_id[]" id="post_id[]" value="55" />
			<?php wp_nonce_field( 'my_image_upload[]', 'my_image_upload_nonce' ); ?>
			<input id="submit_my_image_upload" name="submit_my_image_upload" type="submit" value="Upload" />
		</form>
		</h1>
		
		
		<?php	
		global $post;
		
			// The nonce was valid and the user has the capabilities, it is safe to continue.			
			if( 'POST' == $_SERVER['REQUEST_METHOD']  ) 
			{
				function insert_attachment($file_handler,$post_id,$setthumb='false') 
				{
					// check to make sure its a successful upload
					if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();
					require_once(ABSPATH . "wp-admin" . '/includes/image.php');
					require_once(ABSPATH . "wp-admin" . '/includes/file.php');
					require_once(ABSPATH . "wp-admin" . '/includes/media.php');
					
					$attach_id = media_handle_upload( $file_handler, $post_id );
					if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);
					return $attach_id;
				} 
				
				if ( $_FILES ) 
				{
					$files = $_FILES['my_file_upload'];
					$i=0;
					foreach ($files['name'] as $key => $value) 
					{
						if ($files['name'][$key]) 
						{
							echo "<p>File #=". ++$i . ":</p>
							<p>
								Name: =". $files['name'][$key]. "<br>
							</p>";
							
							//	Temporary file: =". $files['tmp_name'][$key]." <br>
							//	Type: =". $files['type'][$key]. "<br>
							//	Size: =". $files['size'][$key]. "<br>
							//	Error: =". $files['error'][$key]. "<br>
							//	ID: =". ($myId = $post->ID + $i). "<br>
							
							$file = array(
								'name'     => $files['name'][$key],
								'type'     => $files['type'][$key],
								'tmp_name' => $files['tmp_name'][$key],
								'error'    => $files['error'][$key],
								'size'     => $files['size'][$key]
							);
							
							$_FILES = array("my_file_upload" => $file);
							foreach ($_FILES as $file => $array)
							{
								$newupload = insert_attachment($file, $myId);
							}
						}
					}
				} 
			}
		?>
	</body>
</html>