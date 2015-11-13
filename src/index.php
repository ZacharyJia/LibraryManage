<?PHP
    require_once("db/db.php");
    echo "Hello Docker!!";

    echo "Hello v0.1.1";
    $serverName = env("MYSQL_PORT_3306_TCP_ADDR", "localhost"); 
    $databaseName = env("MYSQL_INSTANCE_NAME", "homestead"); 
    $username = env("MYSQL_USERNAME", "homestead"); 
    $password = env("MYSQL_PASSWORD", "secret"); 

    $dsn = "mysql:host=$serverName;dbname=$databaseName";
    $db = new ezSQL_pdo($dsn, $username, $password);
    $db->debug();
    
    
?>