<h2>Login</h2>
<form action="login.php" method="post">
	<p><label class="label" for="user_id">User ID:</label>
	<input id="user_id" type="text" name="user_id" size="30" maxlength="60" value="<?php if (isset($_POST['user_id'])) echo $_POST['user_id']; ?>" > </p>
	<br>
	<p><label class="label" for="pswrd1">Please Create A New Password:</label>
	<input id="pswrd1" type="password" name="pswrd1" size="12" maxlength="12" value="<?php if (isset($_POST['pswrd1'])) echo $_POST['pswrd1']; ?>" ><span>&nbsp;Between 8 and 12 characters.</span></p>
  <br>
  <p>
  <label class="label" for="pswrd1">Please Verify Your New Password:</label>
  <input id="pswrd2" type="password" name="pswrd2" size="12" maxlength="12" value=""<?php if (isset($_POST['pswrd2'])) echo $_POST['pswrd2']; ?>" ><span>&nbsp;Between 8 and 12 characters.</span>
  </p>
  <p>&nbsp;</p><p><input id="submit" type="submit" name="submit" value="Login"></p>
</form><br>
