<?php
    header("Content-Type: application/rss+xml; charset=ISO-8859-1");
    
    $title = "Test";
    $desc = "This is a test";
    $link = 'http://kchris.uni.cx';
    $date = '2012-11-29';
    
    $rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
    $rssfeed .= '<rss version="2.0">';
    $rssfeed .= '<channel>';
    $rssfeed .= '<title>kchris.uni.cx</title>';
    $rssfeed .= '<link>http://kchris.uni.cx/</link>';
    $rssfeed .= '<description>The kchris.uni.cx newsfeed</description>';
    $rssfeed .= '<language>en-us</language>';
    $rssfeed .= '<copyright>Copyright (C) 2012 kchris.uni.cx</copyright>';
    
    // Loop
    
    $rssfeed .= '<item>';
    $rssfeed .= '<title>' . $title . '</title>';
    $rssfeed .= '<description>' . $desc . '</description>';
    $rssfeed .= '<link>' . $link . '</link>';
    $rssfeed .= '<pubDate>' . $date . '</pubDate>';
    $rssfeed .= '</item>';
    
    // End loop
    
    $rssfeed .= '</channel>';
    $rssfeed .= '</rss>';
    
    echo $rssfeed;
?>