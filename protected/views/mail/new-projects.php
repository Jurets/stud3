<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Уведомления о новых проектах</title>
</head>

<body bgcolor="#FFFFFF" style="background: #FFFFFF; padding: 0px; margin: 0px;" >
<!-- START main table -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
	<td bgcolor="#FFFFFF" align="center" ><div align="center">
		<!-- START main centred table -->
		<table width="630" border="0" cellpadding="0" cellspacing="0">

            <tr> 
			<td>
				<!-- START main content table -->
				<table width="630" border="0" cellspacing="0" cellpadding="0">


					<!-- START module / header with ribbon, logo, info links and bottom shadow divider -->
					<tr>
					<td bgcolor="#FFFFFF" >
						<table width="630" border="0" cellspacing="0" cellpadding="0" >
							<tr>
							<!-- table column with top ribbon image-->
							<td bgcolor="#FFFFFF" width="196" align="left" style="padding: 0px;">
							<img src="<?=Yii::app()->params['site']?>/images/email/header-ribbon-top.jpg" alt="header ribbon top" border="no" style="margin: 0px; padding: 0px; display: block;"/>
							</td>
							<!-- table column with links -->
							<td width="434" align="right" valign="middle" style="font-family: Arial,Helvetica,sans-serif; font-size: 11px; color: #444444;">
							<a href="<?=Yii::app()->params['site']?>" title="" target="_blank" style="color: #54A9D0; text-decoration: none;">Отписаться</a>
							</td>
							</tr>
						</table>
					</td>
					</tr>
					<tr>
					<td bgcolor="#FFFFFF" style="padding-bottom: 0px;">
						<table width="630" border="0" cellspacing="0" cellpadding="0" >
							<tr>
							<!-- table column with bottom ribbon -->
							<td width="196" align="left" valign="top" style="padding: 0px;">
							<img src="<?=Yii::app()->params['site']?>/images/email/header-ribbon-notification.jpg" alt="header ribbon" border="no" style="margin: 0px; padding: 0px; display: block;"/>
							</td>
							<!-- table column with logo -->
							<td width="238" height="133" align="center" valign="middle" style="padding: 0px;">
							<a href="" title="" target="_blank"><img src="<?=Yii::app()->params['site']?>/images/logo.png" alt="logo header" border="no" style="margin: 0px; padding: 0px; display: block;"/></a>
							</td>
							<!-- blank table column -->
							<td width="196" align="left" style="padding: 0px;">
							</td>
							</tr>
						</table>
					</td>
					</tr>
					<tr>
					<td bgcolor="#FFFFFF" valign="top" style="border-top: none; border-right: none; border-bottom: none; border-left: none; padding-bottom: 20px;">
					<!-- divider goes here --><img src="<?=Yii::app()->params['site']?>/images/email/splitted-header.jpg" alt="" border="no" style="margin: 0px; padding: 0px; display: block;"/>	
					</td>
					</tr>
					<!-- END module -->

					<!-- START module / one column image with colored title and text -->
					<tr>
					<td bgcolor="#FFFFFF" valign="top" style="border-top: none; border-right: none; border-bottom: none; border-left: none; padding-bottom: 20px;">
						<table border="0" cellspacing="0" cellpadding="0" >
							<tr>
							<td bgcolor="#54A9D0" align="left" valign="top" style="font-family: Arial,Helvetica,sans-serif; font-size: 18px; line-height: 22px; color: #FFFFFF; padding: 15px;">
							<!-- colored title text goes here -->Новые проекты
							</td>
							</tr>
							<tr>
							<td align="left" valign="top" style="padding-bottom: 20px;">
							</td>
							</tr>
							<tr>
							<td align="left" valign="top" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; line-height: 20px; color: #888888; padding-top: 0px;">
							<!-- text goes here -->
							</td>
							</tr>
						</table>	
					</td>
					</tr>
					<!-- END module -->
					
<!-- START module / green divider -->
					<tr>
					<td bgcolor="#FFFFFF" valign="top" style="border-top: none; border-right: none; border-bottom: none; border-left: none; padding-bottom: 20px;">
						<!-- divider goes here --><img src="<?=Yii::app()->params['site']?>/images/email/splitted-color.jpg" alt="" border="no" style="margin: 0px; padding: 0px; display: block;"/>	
					</td>
					</tr>
<!-- END module -->

<? foreach($projects as $row): ?>
					<!-- START module / two diff size column with itinerar data title and description EVENT 1-->
					<tr>
					<td bgcolor="#FFFFFF" valign="top" style="border-top: none; border-right: none; border-bottom: none; border-left: none; padding-bottom: 0px;">
						<table width="630" border="0" cellspacing="0" cellpadding="0">
							<tr>
							<!-- start left table column -->
							<td width="196" align="left" valign="top" >
								<table width="196" border="0" cellspacing="0" cellpadding="0" >
									<tr>
									<td bgcolor="#54A9D0" align="center" valign="middle" style="font-family: Arial,Helvetica,sans-serif; font-size: 11px; color: #FFFFFF; padding-top: 6px; padding-bottom: 6px; padding-left: 5px; padding-right: 5px; border-right: solid 1px #FFFFFF;">
									<!-- day --><?=Date_helper::date_smart($row->date)?>
									</td>
									</tr>
								</table>
							</td>
							<td width="20">
							<!-- this is BLANK table column DO NOT DELETE -->
							</td>
							<!-- start right table column -->
							<td width="414" align="left" valign="top" >
								<table width="414" border="0" cellspacing="0" cellpadding="0" >
									<tr>
									<td align="left" valign="top" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; line-height: 20px; color: #888888; padding-bottom: 20px;">
									<!-- Event title goes here --><a href="<?=Yii::app()->params['site']?>/tenders/<?=$row->id?>.html" target="_blank"  style="font-weight: bold; color: #444444;"><?=$row->title?></a><br/>
									<!-- description goes here --><?=$row->descr?>
									</td>
									</tr>
								</table>
							</td>
							</tr>
						</table>
					</td>
					</tr>
					<!-- END module -->
<? endforeach; ?>

					
<!-- START module / dark gray divider -->
					<tr>
					<td bgcolor="#FFFFFF" valign="top" style="border-top: none; border-right: none; border-bottom: none; border-left: none; padding-bottom: 20px;">
						<!-- divider goes here --><img src="<?=Yii::app()->params['site']?>/images/email/splitted-gray-dark.jpg" alt="" border="no" style="margin: 0px; padding: 0px; display: block;"/>	
					</td>
					</tr>
<!-- END module -->

					
					<!-- START module / footer -->
					<tr>
					<td bgcolor="#FFFFFF" valign="top" style="border-top: none; border-right: none; border-bottom: none; border-left: none; padding-bottom: 20px;">
					<!-- divider goes here --><img src="<?=Yii::app()->params['site']?>/images/email/splitted-footer.jpg" alt="" border="no" style="margin: 0px; padding: 0px; display: block;"/>	
					</td>
					</tr>
					<tr>
					<td bgcolor="#FFFFFF" valign="top" style="border-top: none; border-right: none; border-bottom: none; border-left: none; padding-bottom: 0px;">
						<table width="630" border="0" cellspacing="0" cellpadding="0">
							<tr>
							<!-- start left table column with contact data -->
							<td width="21">
							<!-- this is BLANK table column DO NOT DELETE -->
							</td>
							<!-- start center table column with links-->
							<td width="196" align="left" valign="top" style="padding-bottom: 20px; padding-top: 0px;">
								<table width="196" border="0" cellspacing="0" cellpadding="0" >
									<tr>
									<td align="left" valign="top" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; line-height: 20px; color: #888888; ">
									<a href="" title="" target="_blank" style="color: #54A9D0; text-decoration: none;">Связаться с администрацией</a><br/>
									<a href="" title="" target="_blank" style="color: #54A9D0; text-decoration: none;">Fnetwork.ru</a>
									</td>
									</tr>
								</table>
							</td>
							<td align="right">
							<!-- this is BLANK table column DO NOT DELETE -->
							</td>
							<!-- start right table column with social media links -->
							<td align="right" valign="middle" style="margin:0px; padding-bottom: 20px; padding-top: 0px;">
							<!-- this is BLANK table column DO NOT DELETE -->
							</td>
							</tr>
							<tr>
							<td align="left" colspan="5" valign="top">
								<table width="196" border="0" cellspacing="0" cellpadding="0" >
									<tr>
									<td align="left" valign="middle" style="font-family: Arial,Helvetica,sans-serif; font-size: 16px; font-weight: bold; color: #444444; padding-bottom: 30px; padding-top: 20px; border-top: solid 5px #444444; ">
									<!-- featuring text-->Fnetwork.ru
									</td>
									</tr>
								</table>
							</td>
							</tr>
						</table>
					</td>
					</tr>
					<!-- END module -->
				
				</table>
				<!-- END main content table -->
			 </td>
		</tr>
		</table>
		<!-- END main centred table -->
	</div></td>
	</tr>
</table>
<!-- END main table -->
</body>
</html>