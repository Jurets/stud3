<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'."\n"; ?>
<rss version="2.0">  
    <channel>
        <title><?php echo $this->title?></title>
        <link>http://www.wkbox.ru</link>
        <description><?php echo $this->description?></description>
        <language>ru-ru</language>
        <copyright>2012 Wkbox.ru</copyright>
<image>
<url>http://www.wkbox.ru/images/logo.png</url>
<link>http://www.wkbox.ru/projects/</link>
<width>182</width>
<height>61</height>
</image>

<?php echo $content?>   
    </channel>
</rss>