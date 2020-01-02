<?php
require_once 'DAOPDO.class.php';
$configs=array('dbname'=>'text');
$pdo=DAOPDO::getSingleton($configs);
$sql="select * from news";
$arr=$pdo->fetchAll($sql);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>编号</th>
            <th>标题</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($arr as $key=>$value) { ?>
        <tr>
            <td><?php echo $value['id'] ?></td>
            <td><?php echo $value['title'] ?></td>
            <td>
                <a href="javascript:void(0)" id="<?php echo $value['id'] ?>">删除</a>
            </td>
        </tr>
    </tbody>
    <?php }?>
</table>

<script src="jquery.min.js"></script>
<script>
    $("a").click(function(){
        var id=$(this).attr("id");
        $.ajax({
            url:'02.php',
            type:'post',
            data:{
                'id':id
            },
            dataType:'json',
            success:function(data){
                if(data.code==0){
                    alert('删除成功');
                }else{
                    alert('删除失败');
                }
            }
        })
    })

</script>

</body>
</html>
