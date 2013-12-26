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
<? if( $projects ): ?>
<? foreach($projects as $row): ?>
<item>
<title><?=$row->title?></title>
<link>http://www.wkbox.ru/tenders/<?=$row->id?>.html</link>
<description><![CDATA[
Категория: <?=$row->category()?> <br />Бюджет: <b><?=$row->budget()?></b><br /><br /><?=$row->descr?>]]></description>
<comments>http://www.wkbox.ru/tenders/<?=$row->id?>.html#bids</comments>
<guid>http://www.wkbox.ru/tenders/<?=$row->id?>.html</guid>
</item>
<? endforeach; ?>
<? endif; ?>
    </channel>
</rss>