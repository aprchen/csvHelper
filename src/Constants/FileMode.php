<?php
/**
 * Created by PhpStorm.
 * User: sl
 * Date: 2018/2/28
 * Time: 下午4:42
 */

namespace Sl\CsvHelper\Constants;


class FileMode
{

    const HEAD_READ = "r";

    const HEAD_READ_WRITE = "r+";

    const HEAD_WRITE_CREATE = "w";

    const HEAD_READ_WRITE_CREATE = "w+";

    const FOOT_WRITE_CREATE = "a";

    const FOOT_READ_WRITE_CREATE = "a+";

    const MODE_LIST = [
        self::HEAD_READ,
        self::HEAD_READ_WRITE,
        self::HEAD_WRITE_CREATE,
        self::HEAD_READ_WRITE_CREATE,
        self::FOOT_WRITE_CREATE,
        self::FOOT_READ_WRITE_CREATE
    ];

}