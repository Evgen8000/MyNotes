<?php
include_once ('DBController.php');
class UserController
{
    private $DBConnection;

    function __construct()
    {
        $this->DBConnection = new DBController();
    }

    function InfoByID($userID){
        return mysqli_fetch_object(mysqli_query($this->DBConnection->dbConnection,
            "SELECT * FROM users WHERE ID = $userID"));
    }

    function Create($email,$passHash,$fullname){
        if(mysqli_query($this->DBConnection->dbConnection,
            "INSERT INTO users (Mail, PWord, FullName) VALUES ('$email','$passHash','$fullname')")) return 1;
            else return 0;
    }

    function Delete($id){
        if(mysqli_query($this->DBConnection->dbConnection,
            "DELETE FROM users WHERE ID $id")) return 1;
            else return 0;
    }

    function Edit($id,$fullname = null,$email = null,$passHash = null){
        if($fullname != null)
            mysqli_query($this->DBConnection->dbConnection,
                "UPDATE users SET FullName = '$fullname' WHERE ID = $id");
        if($email != null)
            mysqli_query($this->DBConnection->dbConnection,
                "UPDATE users SET Mail = '$email' WHERE ID = $id");
        if($passHash != null)
            mysqli_query($this->DBConnection->dbConnection,
                "UPDATE users SET PWord = $passHash WHERE ID = $id");
    }

    function Exsistance($email){
        if(mysqli_fetch_object(mysqli_query($this->DBConnection->dbConnection,
            "SELECT * FROM users WHERE Mail=LOWER('$email')")) == null) return 0;
            else return 1;
    }

    function GetIdByMail($email){
        return mysqli_fetch_object(mysqli_query($this->DBConnection->dbConnection,
            "SELECT ID FROM users WHERE Mail = '$email'"))->ID;
    }

    function ValidateAccount($email,$pHash){
        if(mysqli_fetch_object(mysqli_query($this->DBConnection->dbConnection,
            "SELECT * FROM users WHERE Mail = '$email' AND PWord = '$pHash'")) != null) return true;
        else return false;
    }
    
    function SetRememberHash($pHash,$id){
        $randomed = $id + $pHash + rand(0,2000) + rand(10000, 90000);
        setcookie("REMEMBERED",$randomed);
        mysqli_query($this->DBConnection->dbConnection,
            "INSERT INTO remembered (hashnum,id) VALUES ('$randomed','$id')");
    }
    function CheckRememberHash(){
        $hash = $_COOKIE['REMEMBERED'];
        if(mysqli_fetch_object(mysqli_query($this->DBConnection->dbConnection, "SELECT id FROM remembered WHERE hashnum='$hash'")) != null){
            $_SESSION['ID'] = mysqli_fetch_object(mysqli_query($this->DBConnection->dbConnection,"SELECT id FROM remembered WHERE hashnum='$hash'"))->id;
            return true;
        }
        return false;
    }
}

class NoteController
{
    private $DBConnection;

    function __construct()
    {
        $this->DBConnection = new DBController();
    }

    function Create($userID,$name,$text){

    }

    function GetByUserIDNoFetch($userID){
        return mysqli_query($this->DBConnection->dbConnection,"SELECT * FROM Notes WHERE UserID='$userID'");
    }

    function GetNoteByID($noteID){
        return mysqli_fetch_object(mysqli_query($this->DBConnection->dbConnection,"SELECT * FROM Notes WHERE NoteID='$noteID'"));
    }

    function Edit($noteID,$noteName,$noteText){
        mysqli_query($this->DBConnection->dbConnection,"UPDATE Notes SET NoteText='$noteText',NoteName='$noteName' WHERE NoteID='$noteID'");
    }

    function SetDeleteStamp($noteId){

    }

    function ClearByDeleteStamp($userId){

    }
}