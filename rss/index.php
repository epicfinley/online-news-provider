<?php

    //make this page rss/xml in ISO-8859-1 for mysql compatibilty (TODO: WILL THIS WORK WITH UTF-8)

    header("Content-Type: application/rss+xml; charset=ISO-8859-1");


    // Retrieve config and define database connection info

    $config = parse_ini_file("../config.ini", 1);
    $username = $config['database']['username'];
    $password = $config['database']['password'];
    $host = $config['database']['host'];
    $name = $config['database']['name'];    
    DEFINE ('DB_USER', $username);   
    DEFINE ('DB_PASSWORD', $password);   
    DEFINE ('DB_HOST', $host);   
    DEFINE ('DB_NAME', $name);

    // Create head rss feed info

    $rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';    
    $rssfeed .= '<rss version="2.0">';
    $rssfeed .= '<channel>';
    $rssfeed .= '<title>Borden News</title>';
    $rssfeed .= '<link>http://www.webiste.bordengrammar.kent.sch.uk</link>';
    $rssfeed .= '<description>This is a news feed</description>';
    $rssfeed .= '<language>en-gb</language>';
    $rssfeed .= '<copyright>Copyright (C) 2014</copyright>';

    //connect to mysql

    $connection = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
        or die('Could not connect to mysql server, did you setup the config.ini file right?');
    mysql_select_db(DB_NAME)
        or die ('Could not select database, did you enter the right name in the config.ini file?');
 
    $query = "SELECT * FROM feed";
    //ORDER BY date DESC 
    // /\
    // ¦
    // TODO: test if this will work if there is more than 1 post
 
    $result = mysql_query($query) or die ("Could not execute query");
    $count = 0;
    $link = 'website.bordengrammar.kent.sch.uk';

    //extract all the posts and add metadata
 
    while($row = mysql_fetch_array($result)) {
        extract($row);
        $rssfeed .= '<item>';
        $rssfeed .= '<title>' . $title . '</title>';
        $rssfeed .= '<description>' . $content . '</description>';
        $rssfeed .= '<link>' . $link . '</link>';
        $rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", time()) . '</pubDate>';
        $rssfeed .= '</item>';
    }
    
    //closing rss tags

    $rssfeed .= '</channel>';
    $rssfeed .= '</rss>';

    //echo the finished result
 
    echo $rssfeed;
?>