﻿<html>
<head>
<link href="admin.css" rel="stylesheet" type="text/css">
<?php
include "inc/db.php";
//删除留言
if(isset($_GET['did'])){
	$id = $_GET['did'];
	delete('guest','id='.$id);
	header('location:./a_user.php');
}

//分页显示留言内容
$rs = page('user',5,'*','1=1','order by id asc');
$rows = $rs['rows'];

?>
</head>
<body>
<div class="nav-top">
	<span>后台管理系统</span>
    <div class="nav-topright">
    	<p><a href="index.php"><font color="#FF0000">返回首页</font></a></p>
        <span>您好：管理员</span><span><a href="login.php"><a onclick="return confirm('是否要退出');" href='login.php'><font color="yellow"> 注销</font></a></span>
    </div>
</div>

<div class="nav-down">
	<div class="leftmenu">
		<ul>
			<li>
				<a href="admin.php"><img src="image/ic_guest.png"> &nbsp;留言管理</a>
			</li>
			<li>
				<a href="a_user.php"><img src="image/ic_user.png">&nbsp; 用户管理</a>
			</li>
			<li>
				<a href=""><img src="image/ic_set.png"> &nbsp;网站设置</a>
			</li>
		  </ul>
	</div>
	
	<div class="rightcon">
		<div class="right_con">
		<br>
		<h2><center>用户管理</center></h2>
		  <table width="100%"  border="1"> 
		  			<tr height="30">
              <th scope="col">id</th>
              <th scope="col">用户名</th>
              <th scope="col">邮箱</th>
              <th scope="col">操作</th>
            </tr>
			<?php
				foreach($rows as $v){
			?>
  		<tr align="center">
          <td width="120" align="center"><?=$v['id']?></td> 
		  <td width="240" height="30" bgcolor="#FFFFFF"><?=$v['username']?></td>
		  <td width="240" height="30" bgcolor="#FFFFFF"><?=$v['email'] ?>
		  <td width="120" height="30" bgcolor="#FFFFFF"><a onclick="return confirm('是否要删除:<?=$v['username']?>?');" href='?did=<?=$v['id']?>'>&nbsp;删除</a></td>
        </tr>

		  <?php
		  }
		  ?>
		  
		  <tr>
			<td height="25" colspan="6" align="center" bgcolor="#EDEEF8">	<?=$rs['page']?></td>
		  </tr>
	    </div>
		
	</div>
</div>
</body>
</html>
