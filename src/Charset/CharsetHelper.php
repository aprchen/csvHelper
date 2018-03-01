<?php
/**
 * Created by PhpStorm.
 * User: sl
 * Date: 2018/2/28
 * Time: 上午10:15
 */

namespace Sl\CsvHelper\Charset;

use Sl\CsvHelper\Mapping\CharsetHelperInterface;
use Sl\CsvHelper\Mapping\FileInterface;

/**
 * Class CharsetHelper
 * @package App\Component
 *
 * TODO 过滤特殊字符,因为content中有html 和 &nbsp;&nbsp;&nbsp;&nbsp导致编码识别不准确.
 */
class CharsetHelper implements CharsetHelperInterface
{

    const DEFAULT_LENGTH = 200;

    const DEFAULT_ENCODING_LIST = ['GBK', 'UTF-8', 'UTF-16LE', 'UTF-16BE', 'ISO-8859-1'];

    protected $bom = false;

    protected  function detectUtfEncodingWithBom($text)
    {
        $first2 = substr($text, 0, 2);
        $first3 = substr($text, 0, 3);
        $first4 = substr($text, 0, 4);
        if ($first3 == UTF8_BOM) return 'UTF-8';
        elseif ($first4 == UTF32_BIG_ENDIAN_BOM) return 'UTF-32BE';
        elseif ($first4 == UTF32_LITTLE_ENDIAN_BOM) return 'UTF-32LE';
        elseif ($first2 == UTF16_BIG_ENDIAN_BOM) return 'UTF-16BE';
        elseif ($first2 == UTF16_LITTLE_ENDIAN_BOM) return 'UTF-16LE';
        return false;
    }

    public function hasBOM(){
        return $this->bom;
    }

    protected function detectUtfEncoding($string) {
        $list = self::DEFAULT_ENCODING_LIST;
        foreach ($list as $item) {
            $tmp = mb_convert_encoding($string, $item, $item);
            if (md5($tmp) == md5($string)) {
                return $item;
            }
        }
        return false;
    }


    /**
     * @param FileInterface $file
     * @return bool|false|mixed|string
     */
    public  function getFileEncodingWithPath(FileInterface $file)
    {
        $path = $file->getPath();
        $string = $this->getString($path,self::DEFAULT_LENGTH);
        if($string){
            return $this->getFileEncodingWithString($string);
        }
        return false;
    }

    public  function getFileEncodingWithString($str)
    {
        $encoding = $this->detectUtfEncodingWithBom($str);
        if($encoding){
            $this->bom = true;
        }else{
            $encoding = $this->detectUtfEncoding($str);
        }
        if(!$encoding){
            $encoding = mb_detect_encoding($str);
        }
        return $encoding;
    }

    /**
     * @param $path
     * @param string $length
     * @return bool|string
     */
    protected  function getString($path, $length = '')
    {
        if (file_exists($path) && is_readable($path)) {
            return file_get_contents($path, true,null,0,$length);
        }
        return false;
    }

    public function setEncoding($string, $inCharset, $outCharset)
    {
        if($inCharset == $outCharset){
            return $string;
        }
        return mb_convert_encoding ($string,$outCharset,$inCharset);
    }

}