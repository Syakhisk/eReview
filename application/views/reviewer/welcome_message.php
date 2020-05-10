<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
	<title>Reviewer Home</title>
</head>

<body>
	<h1>Reviewer Home</h1>
	<form action="<?php echo site_url('AccountCtl/logout/'); ?>">
		<input type="submit" value="Log Out">
	</form>
</body>

</html>