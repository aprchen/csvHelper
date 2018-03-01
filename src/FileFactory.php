<?php
/**
 * Created by PhpStorm.
 * User: sl
 * Date: 2018/3/1
 * Time: 下午4:02
 */

namespace Sl\CsvHelper;


use Sl\CsvHelper\Bean\File;
use Sl\CsvHelper\Constants\FileMode;

class FileFactory
{
    /**
     * @param $path
     * @param string $mode
     * @return File
     */
    public static function createFileWithPath($path,$mode = FileMode::HEAD_READ){
        return self::initWithPath($path,$mode);
    }

    protected static function initWithPath($path,$mode){
        $file = new File();
        if(file_exists($path)){
            $size = filesize($path);
        }else{
            $size = 0;
        }
        $parts = pathinfo($path);
        $file->setDir($parts['dirname']);
        $file->setMode($mode);
        $file->setPath($path);
        $file->setSize($size);
        $file->setExtension($parts['extension']);
        $file->setFilename($parts['filename']);
        $file->setBasename($parts['basename']);
        return $file;
    }

}