<?php
/**
 * Created by PhpStorm.
 * User: sl
 * Date: 2018/2/28
 * Time: 下午5:00
 */

namespace Aprchen\CsvHelper;



use Aprchen\CsvHelper\Constants\FileMode;
use Aprchen\CsvHelper\Mapping\FileInterface;

class FileOperator
{



    /**
     * @var FileInterface
     */
    protected $file;



    public function __construct(FileInterface $file = null,$defaultMode = FileMode::HEAD_READ)
    {
        if($file){
            $this->setFile($file);
        }
    }

    /**
     * @param FileInterface $file
     * @param string $defaultMode
     */
    public function setFile(FileInterface $file,$defaultMode = FileMode::HEAD_READ)
    {
        if(!$file->getMode()){
            $file->setMode($defaultMode);
        }
        $this->file = $file;
    }

    /**
     * @return FileInterface
     */
    public function getFile(){
        return $this->file;
    }


}