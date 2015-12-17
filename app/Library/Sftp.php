<?php 

namespace App\Library;

define('NET_SFTP_LOGGING', 2);

class Sftp
{
    
    protected $connectionName;

    /**
     * Constructor
     *
     * @param string $connectionName
     */
    public function __construct($connectionName)
    {
        $this->connectionName = $connectionName;
    }

    /**
     * Gets all XML files from a remote folder
     * 
     * @param  string $remoteDir 
     * @param  string $localDir 
     * @return array
     */
   	public function getFiles($remoteDir, $localDir)
   	{    	
    	$files = $this->remoteListPackaged($remoteDir);

    	foreach ($files as $file) {			
			$this->getFile($file['fullFileName'], $localDir . '/' . $file['fileName']);
		}

    	return $files;
  	}

    /**
     * Gets all XML files from a remote folder
     * 
     * @param  string 	$dir 
     * @param  bool     $sorted 
     * @param  string   $sortOrder 
     * @return array
     */
   	public function remoteListPackaged($dir, $sorted = true, $sortOrder = 'desc')
   	{    	
    	$files = [];
		$all = $this->remoteList($dir, $sorted, $sortOrder);
		
        foreach ($all as $file=>$val) {
			if ($this->isValidExtension($val['filename'])) {
				$files[] = [
                    'fileName' => $val['filename'], 
                    'fullFileName' => $dir . '/' .$val['filename'],
                    'size' => $val['size'],
                    'modified' => gmdate("m/d/Y H:i:s", $val['mtime']),
                ];
			}
		}

		return $files;
    }

    /**
     * Retrieves a file from a SSH/SFTP server
     * 
     * @param  string $remoteFile 
     * @param  string $localFile 
	 * @return \Symfony\Component\Console\Output\OutputInterface
     */
    public function getFile($remoteFile, $localFile)
    {	
    	return \SSH::into($this->connectionName)->get($remoteFile, $localFile);    
    }

    /**
     * Places a file on a remote SSH/SFTP server
     * 
     * @param  string $remoteFile 
     * @param  string $localFile 
	 * @return \Symfony\Component\Console\Output\OutputInterface
     */
    public function putFile($remoteFile, $localFile)
    {
    	return \SSH::into($this->connectionName)->put($localFile, $remoteFile);
    }

    /**
     * Retrieves a listing from directory
     * 
     * @param  string 	$dir 
     * @param  bool     $sorted 
     * @param  string   $sortOrder 
	 * @return array 	array of files and folders	
     */
    public function remoteList($dir, $sorted = true, $sortOrder = 'desc')
    {
    	$conn = $this->getConnection();
    	$conn->chdir($dir);
        $list = $conn->rawlist();

        if ($sorted) {
            $list = $this->sortList($list, $sortOrder);
        }
    	
    	return $list;    
    }

    /**
     * Retrieves a listing from directory
     * 
     * @param  array    $list 
     * @param  string   $sortOrder 
     * @return array    sorted array of a folder
     */
    public function sortList($list, $sortOrder = 'desc')
    {
        usort($list, function($a, $b) { return $a['mtime'] - $b['mtime']; }); 

        return $sortOrder == 'asc' ? $list : array_reverse($list);
    }

    /**
     * Retrieves a listing from directory
     * 
     * @param  string   $dir 
     * @return boolean  success
     */
    public function rename($remoteFileFrom, $remoteFileTo)
    {
        $conn = $this->getConnection();
        //print $conn->getSFTPLog();;
        return $conn->rename($remoteFileFrom, $remoteFileTo);
    }

    /**
     * Gets a Net_SFTP connection as Laravels SSH doesn't have all the functionality
     * 
     * @return Net_SFTP connection
     */
    protected function getConnection()
    {
    	return \SSH::into($this->connectionName)->getGateway()->getConnection();
    }

    /**
     * Gets a Net_SFTP connection as Laravels SSH doesn't have all the functionality
     * 
     * @param  string $fileName 
     * @return bool 	
     */
    protected function isValidExtension($fileName)
    {
    	return substr(strrchr($fileName,'.'),1) === 'xml' || substr(strrchr($fileName,'.'),1) === 'err';
    }
}