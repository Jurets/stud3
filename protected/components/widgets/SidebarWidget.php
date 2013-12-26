<?php
class SidebarWidget extends CWidget
{
    public function run()
	{		
			$this->render('sidebar', $data);
    } 
}