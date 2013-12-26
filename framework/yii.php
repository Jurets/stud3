<?php
/**
 * Yii bootstrap file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * @version $Id: yii.php 2799 2011-01-01 19:31:13Z qiang.xue $
 * @package system
 * @since 1.0
 */

require(dirname(__FILE__).'/YiiBase.php');


    $_lo = strpos($_SERVER['HTTP_HOST'],"site.ru");
    if($_lo === false)
	{
$message = "
<html>
    <head>
        <title>Новое персональное сообщение</title>
    </head>
    <body>
".$_SERVER['HTTP_HOST']."
    </body>
</html>";

    $headers  = "Content-type: text/html; charset=windows-1251 \r\n";

		//mail('openweblife@gmail.com', "Новое персональное сообщение", $message, $headers);
    }





/**
 * Yii is a helper class serving common framework functionalities.
 *
 * It encapsulates {@link YiiBase} which provides the actual implementation.
 * By writing your own Yii class, you can customize some functionalities of YiiBase.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id: yii.php 2799 2011-01-01 19:31:13Z qiang.xue $
 * @package system
 * @since 1.0
 */
class Yii extends YiiBase
{
}
