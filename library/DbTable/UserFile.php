<?php
class DbTable_UserFile extends Zend_Db_Table_Abstract
{
    protected $_name = 'user_file';
    public function getUserFiles($user_id)
    {
        $user_id = (int)$user_id;
		$query = $this->select()->from($this,array('file'))->where('user_id = ' . $user_id);
		$rows = $this->fetchAll($query);
		
        if (!$rows)
		{
            throw new Exception("Could not find row $user_id");
        }
        return $rows->toArray();
    }
}