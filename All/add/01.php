<?php
$name=$_POST['name'];
$sex=$_POST['sex'];
require_once 'DAOPDO.class.php';
$configs=array(
    'dbname'=>'text'
);
$pdo=DAOPDO::getSingleton($configs);
$sql="insert into student1 values(null,'$name','$sex')";
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