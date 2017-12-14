<?php
use Workerman\Worker;
require_once '../Autoloader.php';

$worker = new Worker('BinaryTransfer://0.0.0.0:8333');
// 保存文件到tmp下
$worker->onMessage = function($connection, $data)
{
    $save_path = '../../'.$data['file_name'];
    file_put_contents('tmp.jpg', $data['file_data']);
    //file_put_contents($save_path, $data['file_data']);
    $connection->send("upload success. save path $save_path");
};

Worker::runAll();