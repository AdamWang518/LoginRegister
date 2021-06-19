<?php
require "DataBaseConfig.php";

class DataBase
{
    public $connect;
    public $data;
    private $sql;
    public $servername;
    public $username;
    public $password;
    public $databasename;



    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }
    
    function logIn($table, $username, $password)
    {
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $this->sql = "select * from " . $table . " where username = '" . $username . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
            $dbusername = $row['username'];
            $dbpassword = $row['password'];
            if ($dbusername == $username && password_verify($password, $dbpassword)) {
                $login = true;
            } else $login = false;
        } else $login = false;

        return $login;
    }
    function locaion($table, $city,$town,$road,$latitude,$longitude)
    {
        $city = $this->prepareData($city);
        $town = $this->prepareData($town);
        $road = $this->prepareData($road);
        $latitude = $this->prepareData($latitude);
        $longitude = $this->prepareData($longitude);
        $this->sql =
            "INSERT INTO " . $table . " (縣市,鄉鎮,道路門牌,緯度,經度) VALUES ('" . $city . "','" . $town . "','" . $road . "','" . $latitude . "','" . $longitude . "')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }
    function Add($table, $name, $city,$town,$road)
    {
        $name = $this->prepareData($name);
        $city = $this->prepareData($city);
        $town = $this->prepareData($town);
        $road = $this->prepareData($road);
        $this->sql =
            "INSERT INTO " . $table . " (名稱, 縣市,鄉鎮,道路門牌) VALUES ('" . $name . "','" . $city . "','" . $town . "','" . $road . "')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }
    function signUp($table, $username, $password)
    {
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        #hash加密，如果不想要加密可去掉這段並把verify改掉
        $this->sql =
            "INSERT INTO " . $table . " (username, password) VALUES ('" . $username . "','" . $password . "')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }
    function rePort($table, $report, $username)
    {
        $username = $this->prepareData($username);
        $report = $this->prepareData($report);
        $this->sql =
            "INSERT INTO " . $table . " (report, username) VALUES ('" . $report . "','" . $username . "')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }
}

?>
