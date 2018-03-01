<?php
/**
 * Created by PhpStorm.
 * User: sl
 * Date: 2018/2/28
 * Time: 下午4:55
 */

namespace Aprchen\CsvHelper;

use Aprchen\CsvHelper\Constants\FileMode;
use Aprchen\CsvHelper\Mapping\FileInterface;

class Writer extends FileOperator
{

    public function __construct(FileInterface $file = null, string $defaultMode = FileMode::HEAD_WRITE_CREATE)
    {
        parent::__construct($file, $defaultMode);
    }

    public function setFile(FileInterface $file,$defaultMode = FileMode::HEAD_WRITE_CREATE)
    {
        parent::setFile($file,$defaultMode);
    }

    /**
     * @param $text
     * @throws \Exception
     */
    public function write($text){
        fwrite($this->file->getHandle(),$text);
    }

    protected function getBom(){
        /** UTF-8 */
        return chr(0xEF).chr(0xBB).chr(0xBF);
    }

    protected function filter($text){
        $text = str_replace(["\n","\r"], "<br />", $text); //过滤
        return $text;
    }
}