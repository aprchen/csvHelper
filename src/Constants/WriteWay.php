<?php
/**
 * Created by PhpStorm.
 * User: sl
 * Date: 2018/3/1
 * Time: 下午12:19
 */

namespace Sl\CsvHelper\Constants;


class WriteWay
{
    const FILE_WAY = 1;

    const DB_WAY = 2;

    const WAY_LIST = [
        self::FILE_WAY,
        self::DB_WAY
    ];
}