<?php
/**
 * Created by PhpStorm.
 * User: sl
 * Date: 2018/3/1
 * Time: 下午1:48
 */

namespace Aprchen\CsvHelper\Mapping;


interface FileInterface
{
    public function setMode($mode);

    public function getMode();

    public function getPath();

    public function getHandle();

    public function getFilename();

    public function getBasename();

    public function getExtension();

    public function getDir();

    public function close();

    public function __toString();
}