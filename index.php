<?php
echo '
<!DOCTYPE html>
<html>
<head>
<style>
	h1 {text-align:center;color:blue;}
	body {background:#BABBD3;}
	td {text-align:center;}
	.solid {border:2px solid green; width:200px;} 
</style>
</head>
<body>
<h1>CS380 Project Login</h1>
<form action="ProcessForm.php" method="post" >
<table align="center">
<tr><td>Name:</td><td> <input type="text" name="name" class="solid"></td></tr><br>
<tr><td>Password:</td><td> <input type="password" name="password" class="solid"></td></tr><br>
<tr><td colspan="2"><input type="submit" value="Submit"></td></tr>
</table>
</form>
<br/>
<a href="NewUser.php">Register New User</a>
</body>
</html>
';
?>