<?php
$id=$_POST['id'];
require_once 'DAOPDO.class.php';
$configs=array('dbname'=>'text');
$pdo=DAOPDO::getSingleton($configs);
$sql="delete from news where id=$id";
$res=$pdo->query($sql);
if($res==true){
    $arr=array(
        'code'=>0,
        'msg'=>'添加成功'
    );
    echo json_encode($arr);
}else{
    $arr=array(
        'code'=>1,
        'msg'=>'添加失败'
    );
    echo json_encode($arr);
}