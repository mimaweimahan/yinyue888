<?php
$host = 'db';
$user = 'root';
$pass = 'yinyue_db';
$db   = 'yinyue_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("连接失败: " . $conn->connect_error);

$sql = file_get_contents('/var/www/html/yinyue888/123.sql');
if ($conn->multi_query($sql)) {
    echo "数据库导入成功！";
} else {
    echo "错误: " . $conn->error;
}
