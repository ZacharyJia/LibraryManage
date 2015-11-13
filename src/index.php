<?PHP
    require_once("db/db.php");
    require_once("db/Helper.php");

    echo "Hello Docker!!";

    echo "Hello v0.1.1";
    
    $db = getDB();
    $db->get_row("select * from test");
    $db->debug();
    
    
?>