<?PHP
    require_once("db/db.php");
    echo "Hello Docker!!";

    echo "Hello v0.1.1";
    
    $db = new ezSQL_mysql();
    $db->debug();
    
    
?>