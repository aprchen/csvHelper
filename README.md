[![Build Status](https://travis-ci.org/aprchen/csvHelper.svg?branch=master)](https://travis-ci.org/aprchen/csvHelper)
[![License](https://img.shields.io/badge/license-Apache%202-4EB1BA.svg?style=flat-square)](https://www.apache.org/licenses/LICENSE-2.0.html)
[![Php Version](https://img.shields.io/badge/php-%3E=7.0-brightgreen.svg?maxAge=2592000)](https://github.com/aprchen/csvHelper)

# csvHelper

协程版文件处理,csv

 安装
```
composer require aprchen/csv-helper dev-master 
```

使用方法:

通过路径读取
```

/** @var Aprchen\CsvHelper\Mapping\FileInterface $file */
$file = Aprchen\CsvHelper\FileFactory::createFileWithPath($path);
$reader = new Aprchen\CsvHelper\Reader();
$reader->setFile($file);
$content = $reader->getContent();
$fileEncoding = (new Aprchen\CsvHelper\CharsetHelper())->getEncoding($file);

foreach($content as $item){
  //todo
}


```
