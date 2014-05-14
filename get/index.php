<?php
	$number = $_GET['id'];
	$config = parse_ini_file("../config.ini", 1);
    $username = $config['database']['username'];
    $password = $config['database']['password'];
    $host = $config['database']['host'];
    $name = $config['database']['name'];    
    DEFINE ('DB_USER', $username);   
    DEFINE ('DB_PASSWORD', $password);   
    DEFINE ('DB_HOST', $host);   
    DEFINE ('DB_NAME', $name);
    $connection = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
        or die('Could not connect to mysql server, did you setup the config.ini file right?');
    mysql_select_db(DB_NAME)
        or die ('Could not select database, did you enter the right name in the config.ini file?');
    $query = "SELECT * FROM feed ";
    $result = mysql_query($query) or die ("Could not execute query");
    
    while($row = mysql_fetch_array($result)) {
        extract($row);
        $rssfeed .= '<item>';
        $rssfeed .= '<title>' . $title . '</title>';
        $rssfeed .= '<description>' . $content . '</description>';
        $rssfeed .= '<link>' . $link . '</link>';
        $rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", time()) . '</pubDate>';
        $rssfeed .= '</item>';
    }

    
