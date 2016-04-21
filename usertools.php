<?php
require('mongotools.php');

class usersWorker
{
    public $usersWorker;
    public $systemWorker;

    function __construct(){
        $this->usersWorker = new mongoWorker('users');
        $this->systemWorker = new mongoWorker('systemInfo');
    }

    function usersAdd($email, $pword, $fullname)
    {
        $pword = hash("sha512", $pword);
        if ($this->usersWorker->collection->findOne(array("email" => $email)) != null) return false;
        $uId = $this->systemWorker->collection->findOne(array('_id' => 'uIdCurr'))['data'];
        $this->systemWorker->collection->update(array("_id" => "uIdCurr"), array('$set' => array('data' => $uId + 1)));
        $this->usersWorker->collection->insert(array("_id" => "u$uId", "email" => $email, "pword" => $pword, "fullname" => $fullname));
        return true;
    }

    function getUserById($id){
        return $this->usersWorker->findFirstByValue('_id', $id);
    }

    function getIdByEmail($email){
        return $this->usersWorker->findFirstByValue('email', $email)['_id'];
    }
}