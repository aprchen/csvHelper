<?php
/**
 * Created by PhpStorm.
 * User: sl
 * Date: 2018/2/28
 * Time: 下午6:45
 */

namespace Sl\CsvHelper;

use App\Lib\FileInterface;
use Sl\CsvHelper\Constants\WriteWay;
use Swoft\Bean\Annotation\Bean;

/**
 * Class SqlWriter
 * @package App\Component
 * @Bean()
 * 里面不能有方法 init..
 */
class SqlWriter extends Writer
{
    protected $table;

    protected $fields;

    protected $insertHead;
    /**
     * 写入数据库,和写入文件
     */
    protected $writeWay;

    /**
     * @return mixed
     */
    public function getWriteWay()
    {
        return $this->writeWay;
    }

    /**
     * @param $writeWay
     * @return $this
     * @throws \Exception
     */
    public function setWriteWay($writeWay)
    {
        if (!in_array($writeWay, WriteWay::WAY_LIST)) {
            throw new \Exception("wrong way");
        }
        $this->writeWay = $writeWay;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param $table
     * @return $this
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return $this
     * @throws \Exception
     */
    public function begin()
    {
        $this->write("BEGIN;\n");
        return $this;
    }

    /**
     * @return $this
     * @throws \Exception
     */
    public function commit()
    {
        $this->write("COMMIT;\n");
        return $this;
    }

    /**
     * Bom 必须第一行插入
     * @throws \Exception
     */
    public function insertBom()
    {
        $this->write($this->getBom());
        return $this;
    }

    protected function NRFilter($text)
    {
        $text = str_replace(["\n", "\r"], "<br />", $text); //过滤
        return $text;
    }

    public function specialCharacterFilter($text)
    {
        return addslashes($text);
    }

    /**
     * @param $conditions
     * @return $this
     * @throws \Exception
     */
    public function clearData($conditions)
    {
        $table = $this->getTable();
        $sql = sprintf("DELETE FROM `%s` WHERE %s;\n", $table, $conditions);
        parent::write($sql);
        return $this;
    }

    protected function getInsertHead()
    {
        if (!$this->insertHead) {
            $table = $this->getTable();
            $fields = $this->getFields();
            $str = implode(',', $fields);
            $sql = sprintf("INSERT INTO `%s` (%s) VALUES", $table, $str);
            $this->insertHead = $sql;
        }
        return $this->insertHead;
    }

    /**
     * @param $sql
     * @return $this
     * @throws \Exception
     */
    public function insert($sql)
    {
        $head = $this->getInsertHead();
        $text = $head . $sql;
        parent::write($text);
        return $this;
    }

}