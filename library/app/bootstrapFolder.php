<?php
class app_bootstrapFolder
{
	public function __construct($userId)
    {
		$config = Zend_Controller_Front::getInstance()->getParam('bootstrap');
		$tmpPath = $config->getOption('tmpPath');
		
		//get folder path from application.ini
		$this->userId = $userId;
		$this->fullPathUserFoldes = $tmpPath['forcompression'].$userId;
		
		$this->createbootstrapFolder();
	}
	
	
	//check if the folder exist for the user and create one .
	//flush the folder to remove the old downloaded ones
	public function createbootstrapFolder ()
	{
		if(is_dir($this->fullPathUserFoldes))
		{
			$files = glob($this->fullPathUserFoldes.'/*');
			foreach($files as $file)
			{ // iterate files
				if(is_file($file))
				{
					unlink($file); // delete file
				}
			}
		}
		else
		{
			mkdir($this->fullPathUserFoldes, 0755);
		}
	}
}