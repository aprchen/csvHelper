<?php
/**
 * Created by PhpStorm.
 * User: sl
 * Date: 2018/2/28
 * Time: 上午10:41
 */

namespace Sl\CsvHelper\Mapping;

interface CharsetHelperInterface
{

    public function getFileEncodingWithPath(FileInterface $file);

    public function setEncoding($string, $inCharset, $outCharset);

    public function hasBOM();
}