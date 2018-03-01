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

class Reader extends FileOperator
{

    /**
     * @param FileInterface $file
     * 设置只读
     * @param string $defaultMode
     */
    public function setFile(FileInterface $file,$defaultMode = FileMode::HEAD_READ)
    {
        parent::setFile($file,$defaultMode);
    }

    protected function  streamFilter($stream){
        return $stream;
    }

    /**
     * @return iterable
     */
    public function getFileContent(): iterable
    {
        $handle = $this->file->getHandle();
        if(is_resource($handle)){
            while (feof($handle) === false) {
                $stream = fgetcsv($handle);
                yield $this->streamFilter($stream);
            }
            $this->file->close();
        }
    }

}