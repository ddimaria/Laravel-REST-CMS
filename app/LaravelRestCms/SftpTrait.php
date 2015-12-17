<?php namespace App\LaravelRestCms;

use App\Library\Sftp;

trait SftpTrait {
    
    /**
     * @var App\Library\Sftp
     */
    protected $sftp;
    
    /**
     * @var string
     */
    protected $sftpConnection;
    
    /**
     * @var string
     */
    protected $remotePath;
    
    /**
     * @var string
     */
    protected $remotePathSuccess;
    
    /**
     * @var string
     */
    protected $remotePathError;
    
    /**
     * @var string
     */
    protected $remotePathProcessed;
    
    /**
     * @var string
     */
    protected $localPath;
    
    /**
     * @var string
     */
    protected $localPathSuccess;
    
    /**
     * @var string
     */
    protected $localPathError;


    /**
     * Gets the path name of a given path
     *
     * @param  string $pathName
     * @return string
     */
   	public function getPath($pathName)
   	{ 	
    	if (!stripos($pathName, 'path') || !property_exists($this, $pathName)) {
    		return false;
    	} else {
    		return $this->{$pathName};
    	}
  	}

    /**
     * Downloads all XML files from a remote folder
     *
     * @param  string $path
     * @return array
     */
   	public function pullFiles($path)
   	{ 	
    	$files = $this->sftp->getFiles($path, $this->localPath);

    	return $files;
  	}

    /**
     * Uploads an XML file to a remote folder
     * 
     * @return array
     */
    public function pushFile($fileName, $fullFileName)
    {   
        $files = $this->sftp->putFile($this->remotePath . '/' . $fileName, $fullFileName);

        return $files;
    }

    /**
     * Moves a file to a folder
     * 
     * @param  string $fullFileName 
     * @param  string $fileName    
     * @param  string $path    
     * @return arrray            
     */
    public function moveTo($fullFileName, $fileName, $path)
    {
        return $this->sftp->rename($fullFileName, $path . '/' . $fileName);
    }

    /**
     * Moves a file to MP's Processed folder
     * 
     * @param  string $fullFileName 
     * @param  string $fileName    
     * @param  string $pathProcessed    
     * @return arrray            
     */
    public function moveToProcessed($fullFileName, $fileName, $pathProcessed = null)
    {
        $pathProcessed = $pathProcessed ?: $this->remotePathProcessed;

        return $this->moveTo($fullFileName, $fileName, $pathProcessed);
    }

    /**
     * Moves a file to MP's Success folder
     * 
     * @param  string $fullFileName 
     * @param  string $fileName    
     * @return arrray            
     */
    public function moveToSuccess($fullFileName, $fileName)
    {
        return $this->moveTo($fullFileName, $fileName, $this->remotePathSuccess);
    }
}