<?php


namespace App;


abstract class Model implements \App\Models\Interfaces\Model
{
    protected $id;

    // #############  PROTECTED FUNCTIONS  #############

    protected function IsExists()
    {
        $cols = [];
        $data = [];
        $objArr = get_object_vars($this);
        foreach (static::SEARCH_ARGS as $k => $v) {
            $cols[] = '`' . $v . '`=:' . $v;
            $data[':' . $v] = $objArr[$v];
        }

        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE ' . implode(',', $cols);
        return !empty($db->query($sql, $data, static::class));
    }

    protected function update()
    {
        $db = new Db();
        $objArr = get_object_vars($this);
        $cols = [];
        $data = [];

        foreach ($objArr as $key => $value) {
            if ($key != 'id')
                $cols[] = '`' . $key . '`=' . ':' . $key;
            $data[':' . $key] = $value;
        }

        $sql = 'UPDATE `' . static::TABLE . '` SET ' . implode(',', $cols) . ' WHERE `' . static::TABLE . '`.`id` = :id';

        return $db->execute($sql, $data);
    }

    protected function insert()
    {
        if ($this->IsExists()) return true;

        $db = new Db();
        $objArr = get_object_vars($this);
        $cols = [];
        $data = [];

        foreach ($objArr as $key => $value) {
            if ($key == 'id') continue;
            $cols[] = $key;
            $data[':' . $key] = $value;
        }
        $sql = 'INSERT INTO `' . static::TABLE . '` (' . implode(',', $cols) . ') VALUES (' . implode(',', array_keys($data)) . ')';
        $this->id = $db->getLastId();

        return $db->execute($sql, $data);
    }
    // #############################################

    //  #############  STATIC FUNCTION  #############

    public static function loadAll()
    {
        $db = new Db();
        $sql = 'SELECT * FROM`' . static::TABLE . '`';
        return $db->query($sql, [], static::class);
    }

    public static function loadById($id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id = :id';
        return $db->query($sql, [':id' => $id], static::class)[0];
    }

    public static function deleteById($id)
    {
        $db = new Db();
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id = :id';
        return $db->execute($sql, [':id' => $id]);
    }

    //  #############  PUBLIC FUNCTIONS  #############

    public function getId()
    {
        return $this->id;
    }

    public function save()
    {

        if ($this->id)
            return $this->update();
        return $this->insert();
    }

    public function delete()
    {
        $db = new Db();
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id = :id';
        return $db->execute($sql, [':id' => $this->id]);
    }

    //######################################################

}