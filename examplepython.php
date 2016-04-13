<html>
	<head>
		<title>PHP Test</title>
	</head>
	<body>
		<p>verification3</p>
		<?php
			$toaddr = "trevorm126@gmail.com";
			$body = "this is a testing123";
			exec("python.exe sendmail.py \"$toaddr\" \"$body\"");
		?>
	</body>
</html>