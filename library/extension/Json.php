<?php
class extension_Json extends app_processFile
{
	public function __construct($userId,$fileExtension)
    {
        parent::__construct($userId,$fileExtension);
    }
	
	public function renderFile ($file)
	{
		//some costume process can be done based on the file types 
		return parent::renderFile ($file);
	}
}