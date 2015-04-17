<?php
class app_processFile
{
	public function __construct($userId,$fileExtension)
    {
        $config = Zend_Controller_Front::getInstance()->getParam('bootstrap');
		$tmpPath = $config->getOption('tmpPath');
		
		$this->userId = $userId;
		$this->fullPathUserRepository = $tmpPath['repository'].$fileExtension.'/'.$userId;
		$this->forcompression = $tmpPath['forcompression'].$userId;
	}
	
	//check if it is a remote location file or local file
	//based on the input will call corresponding function . this can be extended like drop box, Google driver etc
	public function renderFile ($url)
	{
		if (!filter_var($url, FILTER_VALIDATE_URL) === false)
		{
			/*
			// drop box file download 
			$path = explode('/', $url );
			if ( is_array($path) && $path[2] == 'dropbox' )
			{
				echo ' do some o auth validation and download file';
			}
			*/
			return $this->downloadFile ($url);
		}
		else
		{
			return $this->localFile ($url);
		}
	}
	
	public function downloadFile ($url)
	{
		// downloadable file default path based on the user the path changes 
		$fileFullPath = $this->forcompression.'/'.$this->getFileName($url);
		$file = fopen ($url, "rb");
		if ($file)
		{
			$newf = fopen ($fileFullPath, "wb");
			if ($newf)
			while(!feof($file))
			{
				fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
			}
		}

		if ($file)
		{
			fclose($file);
		}

		if ($newf)
		{
			fclose($newf);
		}
		
		return $fileFullPath;
	}
	
	public function localFile ($url)
	{
		// Local file default path based on the user the path changes 
		if (file_exists($this->fullPathUserRepository.'/'.$url))
		{
			return $this->fullPathUserRepository.'/'.$url;
		}
		else
		{
			return false;
		}
	}
	
	public function getFileName($url)
	{
		$fileName = basename($url);
		return $fileName;
	}
}