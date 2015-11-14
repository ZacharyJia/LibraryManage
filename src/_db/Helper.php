<?php

require_once('db.php');

/**
 * 获取环境变量
 * @param $key
 * @param null $default
 * @return null|string
 */
function env($key, $default = null)
{
    $value = getenv($key);

    if ($value === false) {
        return $default;
    }

    return $value;
}

/**
 * 获取ezSQL对象
 */
 function getDB()
 {
    $serverName = env("MYSQL_PORT_3306_TCP_ADDR", "localhost"); 
    $databaseName = env("MYSQL_INSTANCE_NAME", "library"); 
    $username = env("MYSQL_USERNAME", "jia199474"); 
    $password = env("MYSQL_PASSWORD", "jiazequn"); 
    
    $dsn = "mysql:host=$serverName;dbname=$databaseName";
    $db = new ezSQL_pdo($dsn, $username, $password);
    
    return $db;
 }
 