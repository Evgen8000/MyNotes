<?php

class mongoWorker
{
    public $connection;
    public $collection;

    function __construct($selCollection)
    {
        $this->connection = (new MongoClient())->selectDB('opennotes');
        $this->collection = new MongoCollection($this->connection, $selCollection);
    }

    function findAllByValue($key,$value){
        $result = array();
        $cursor = $this->collection->find(array($key => $value));
        foreach ($cursor as $item){
            array_push($result, $item);
        }
        return $result;
    }
    
    function findFirstByValue($key, $value)
    {
        $cursor = $this->collection->find(array($key => $value));
        foreach ($cursor as $item) {
            return ($item);
        }
        return null;
    }

    static function findByValueInCollection($key, $value, $collection)
    {
        $cursor = (new MongoClient())->selectDB('opennotes')->selectCollection($collection)->find(array($key => $value));
        foreach ($cursor as $item) {
            return ($item);
        }
        return null;
    }

    static function docUpdate($collection, $_id, $key, $value)
    {
        $colWorker = new mongoWorker($collection);
        $colWorker->collection->update(array("_id" => "u$_id"), array('$set' => array($key, $value)));
    }
}