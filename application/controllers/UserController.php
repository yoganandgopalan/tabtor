 <?php
class UserController extends Zend_Rest_Controller
{
    /**
     * The index action handles index/list requests; it should respond with a
     * list of the requested resources.
     */
    public function indexAction()
    {
		// am assuming user auth is done befor this process am not handling that in this api currently
		
		//Get the user id from the URL
		$request = $this->getRequest();
		//converting to int makes also SQL injection handled
		$userId = (int)$request->getParam('id');
		
		//Get user files form the DB
		$user = new DbTable_UserFile();
		$getUserFiles = $user->getUserFiles($userId);
		
		//Validate user contains files
		if( empty( $getUserFiles ) )
		{
			echo  'No files found for the user ';
			exit;
		}
		else
		{
			//folder path application global variable which is defined in aplication.ini .
			//this path is used for downloading URL files into the server
			$config = Zend_Controller_Front::getInstance()->getParam('bootstrap');
			$tmpPath = $config->getOption('tmpPath');
			
			$compressionFile = $tmpPath['forcompression'].$userId.'.zip';
			
			//Class to create a user folder (based on the id) if it doesn't exist .Also it delete the existing files if there is any
			$bootstrapFolder = new app_bootstrapFolder($userId);
			$compressionFilesArray = array();
			
			
			// This loop will return proper path of all files for the user , if its in remote system will download the file and return the local path
			foreach ($getUserFiles as $files)
			{
				//splitting the file to get file extension . PHP file extension
				$info = new SplFileInfo($files['file']);
				$fileExtension = $info->getExtension();
				$fileName = $info->getFilename();
				
				$className = 'extension_'.ucwords($fileExtension);
				

				if (class_exists($className))
				{
					// create Dynamic object based on the extension 
					$dynamicFile = new $className($userId,$fileExtension);
					$pathOfFile = $dynamicFile->renderFile ($files['file']);
					if ($pathOfFile)
					{
						$compressionFilesArray[] = array('file'=>$pathOfFile, 'newpath'=>$fileExtension.'/'.$fileName);
					}
				}
				else
				{
					//echo 'extension not found';
					exit;
				}
			}
			
			//print_r($compressionFilesArray);
			//exit;
			
			// Compressing as zip
			$zip = new ZipArchive();
			if(!$zip->open($compressionFile, ZipArchive::CREATE) !== true)
			{
				foreach ($compressionFilesArray as $key => $file)
				{
					$zip->addFile($file['file'],$file['newpath']);
				}
				$zip->close();
			}
			else
			{
				//echo 'cannot open file';
				exit;
			}
			//creating a downloadable file 
			header('Content-disposition: attachment; filename=tabtor_'.$userId.'_download.zip');
			header('Content-type: application/zip');
			readfile($compressionFile);
			exit;
		}
    }
    
    public function headAction()
    {
    }
    public function listAction()
    {
        $this->_forward('index');
    }
    public function getAction()
    {
        $this->_forward('index');
    }
    public function newAction()
    {
        $this->_forward('index');
    }
    public function postAction()
    {
        $this->_forward('index');
    }
    public function editAction()
    {
        $this->_forward('index');
    }
    public function putAction()
    {
        $this->_forward('index');
    }
    public function deleteAction()
    {
        $this->_forward('index');
    }
    
} 