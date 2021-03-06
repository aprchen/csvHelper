<?php
/**
 * Created by PhpStorm.
 * User: sl
 * Date: 2018/2/28
 * Time: 上午10:41
 */

namespace Aprchen\CsvHelper\Mapping;

interface CharsetHelperInterface
{

    public function getEncoding(FileInterface $file);

    public function setEncoding($string, $inCharset, $outCharset);

    public function hasBOM();
}