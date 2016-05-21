<?php
$con = mysql_connect("localhost", "peter", "abc123");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("my_db", $con);

$result = mysql_query("SELECT * FROM Persons");

while ($row = mysql_fetch_array($result)) {
    $data[] = $row;
}

mysql_close($con);

print_r($data);




class MysqlFacade {
    private $con;
    private $host;
    private $user;
    private $pwd;
    public function __construct($host, $user, $pwd) {
        $this->host =  $host;
        $this->user =  $user;
        $this->pwd  =  $pwd;
    }

    public function connect () {
        $this->con = mysql_connect($this->host, $this->user, $this->pwd);
        if (!$this->con) {
            die('Could not connect: ' . mysql_error());
        }
    }

    public function query($dbname, $sql) {
        $this->connect();
        mysql_select_db($dbname, $this->con);
        $result = mysql_query($sql);
        $data = array();
        while ($row = mysql_fetch_array($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function close() {
        mysql_close($this->con);
    }
}

$mysqlObj = new MysqlFacade("localhost", "peter", "abc123");
print_r($mysqlObj->query("my_db", "SELECT * FROM Persons"));
