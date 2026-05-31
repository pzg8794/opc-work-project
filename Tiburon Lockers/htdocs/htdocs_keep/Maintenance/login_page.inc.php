<h2>Login</h2>
<form action="login.php" method="post">
	<p><label class="label" for="user_id">User ID:</label>
	<input id="user_id" type="text" name="user_id" size="30" maxlength="60" value="<?php if (isset($_POST['user_id'])) echo $_POST['user_id']; ?>" > </p>
	<br>
	<p><label class="label" for="pswrd">Password:</label>
	<input id="pswrd" type="password" name="pswrd" size="12" maxlength="12" value="<?php if (isset($_POST['pswrd'])) echo $_POST['pswrd']; ?>" ><span>&nbsp;Between 8 and 12 characters.</span></p>
	<p>&nbsp;</p><p><input id="submit" type="submit" name="submit" value="Login"></p>
</form><br>
