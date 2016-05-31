<?php

class DBController
{
    public $dbConnection;
    
    function __construct()
    {
        $dblocation = "localhost"; // Имя сервера
        $dbuser = "root";          // Имя пользователя
        $dbpasswd = "";            // Пароль
        $this->dbConnection = mysqli_connect($dblocation, $dbuser, $dbpasswd, "opennotes");
        if (!$this->dbConnection) // Если дескриптор равен 0 соединение не установлено
        {
            echo("<P>В настоящий момент сервер базы данных не доступен, поэтому 
           корректное отображение страницы невозможно.</P>");
            exit();
        }
    }
}