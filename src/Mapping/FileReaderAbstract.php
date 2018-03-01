<?php
/**
 * Created by PhpStorm.
 * User: sl
 * Date: 2018/3/1
 * Time: 下午2:48
 */

namespace Sl\CsvHelper\Mapping;


abstract class FileReaderAbstract
{
    public abstract function run();

    /**
     * @param FileInterface $file
     * 设置只读
     */
    public abstract function setFile(FileInterface $file);

}