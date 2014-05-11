<html>
<head>
	<title>New news submission</title>
	<style type="text/css">
	h1 {
		font-family: sans-serif, Arial;
		font-size: 48px;
		font-weight: bold;
	}
	h2 {
		font-family: sans-serif, Arial;
		font-size: 36px;
		font-weight: lighter;
	}

	</style>
</head>
<body>
<?php
if (empty($_POST["txt_Title"]) or empty($_POST["txtarea_Content"]) or empty($_POST["pwd_Password"])) {
	print "<h1> All infomation in the form is required please retry.</h1>";
} else {
	$title = $_POST["txt_Title"];
	$content = $_POST["txtarea_Content"];
	$date = time();
	$pass = $_POST["pwd_Password"];
	if ($pass == "yourpassword") {
		$config = parse_ini_file("config.ini", 1);
    	$username = $config['database']['username'];
    	$password = $config['database']['password'];
    	$host = $config['database']['host'];
    	$name = $config['database']['name'];    
    	DEFINE ('DB_USER', $username);   
    	DEFINE ('DB_PASSWORD', $password);   
    	DEFINE ('DB_HOST', $host);   
    	DEFINE ('DB_NAME', $name);
    	$connection = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
       		or die('Could not connect to database. Did you setup your config.ini correctly? Does ' . $username . "and " . $host . "sound familar?");
    	mysql_select_db(DB_NAME)
        	or die ('Could not select database. Did you enter the correct database name in config.ini, and does it exist?');
        $SQL = "INSERT INTO feed (title, content) VALUES ($title, $content)";
		$result = mysql_query($SQL);




	} else {
		print "<h1> Password incorrect. </h1><br><h2>If you continue to try and guess the password your IP will be banned and loogged.</h2>";
	}
}



?>
</body>
</html>




























































































































































































































































