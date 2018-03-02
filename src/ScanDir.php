<?php
/**
 * Created by PhpStorm.
 * User: sl
 * Date: 2018/2/26
 * Time: 下午9:07
 */

namespace Aprchen\CsvHelper;

use Aprchen\CsvHelper\Mapping\FileInterface;

/**
 * Class ScanDir
 */
class ScanDir
{


    protected $files;

    /**
     * @var
     * 路径
     */
    protected $dir;
    /**
     * @var
     * 文件类型
     */
    protected $fileExtension;


    /**
     * @return mixed
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * @param $dir
     * @return $this
     */
    public function setDir($dir)
    {
        $this->dir = $dir;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFileExtension()
    {
        return $this->fileExtension;
    }

    /**
     * @param $fileExtension
     * @return $this
     */
    public function setFileExtension($fileExtension)
    {
        $this->fileExtension = $fileExtension;
        return $this;
    }

    /**
     * @param $dir
     * @throws \Exception
     */
    protected function run($dir)
    {
        $cDir = scandir($dir);
        foreach ($cDir as $key => $item) {
            if (!in_array($item, array(".", ".."))) {
                if (is_dir($dir . DS . $item)) {
                    $this->run($dir . DS . $item);
                }
                /** @var FileInterface $file */
                $file = FileFactory::createFileWithPath($dir . DS . $item);
                if ($this->getFileExtension()) {
                    if ($this->fileExtension !== $file->getExtension()) {
                        continue;
                    }
                }
                $this->files[] = $file;
            }
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getFiles()
    {
        if (!$this->getDir()) {
            throw new \Exception("need dir");
        }
        $this->run($this->dir);
        return $this->files;

    }
}