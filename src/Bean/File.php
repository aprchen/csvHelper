<?php
/**
 * Created by PhpStorm.
 * User: sl
 * Date: 2018/2/28
 * Time: 下午4:19
 */

namespace Aprchen\CsvHelper\Bean;

use Aprchen\CsvHelper\Constants\FileMode;
use Aprchen\CsvHelper\Mapping\FileInterface;

class File implements FileInterface
{
    const OPEN = 1;

    const CLOSE = 0;

    protected $basename;

    protected $filename;

    protected $path;

    protected $mode;

    protected $dir;

    protected $size;

    protected $extension;

    protected $handle;

    /**
     * @throws \Exception
     */
    public function getHandle()
    {
        if(!$this->handle){
            $file = $this->getPath();
            $this->handle = fopen($file, $this->getMode());
        }
        return $this->handle;
    }

    /**
     * @return mixed
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * @param mixed $dir
     */
    public function setDir($dir)
    {
        $this->dir = $dir;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getBasename()
    {
        return $this->basename;
    }

    /**
     * @param mixed $basename
     */
    public function setBasename($basename)
    {
        $this->basename = $basename;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }


    /**
     * @return mixed
     * @throws \Exception
     */
    public function getPath()
    {

        if (!$this->path) {
            throw new \Exception("请指定文件名和路径");
        }
        return $this->path;
    }

    /**
     * @param $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        if($this->handle){
            return self::OPEN;
        }
       return self::CLOSE;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getMode()
    {
        if(!in_array($this->mode,FileMode::MODE_LIST)){
            $this->setMode(FileMode::HEAD_READ);
        }
        return $this->mode;
    }


    public function setMode($mode)
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param mixed $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    public function close(){
        if(is_resource($this->handle)){
            fclose($this->handle);
        }
    }

    public function __destruct()
    {
        $this->close();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function __toString()
    {
       return $this->getPath();
    }

}