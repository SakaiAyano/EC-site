<?php 
class DB{
    public static function connectDB(){
        $dsn = 'mysql:dbname=ec-site;host=localhost';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password);
        return $dbh;
    }
    
}

?>