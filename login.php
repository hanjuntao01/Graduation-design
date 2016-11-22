<?php
include "head.php";
define('ADMIN_USER','admin');
define('ADMIN_PASS',123456);

if(isset($_POST["do"])&&($_POST["do"]=="login"))	//单击了“提交”按钮
{
//  session_start();
$user=trim($_POST['user']);
$pass=trim($_POST['pass']);
if($user==ADMIN_USER && $pass==ADMIN_PASS){   //判断该用户和密码是否正确
	
	$_SESSION['adminuser']=$user;
	$_SESSION['adminpass']=$pass;
	echo "<meta http-equiv=\"refresh\" content=\"0;url=admin.php\">";
}else{
	echo "<script>alert('登录失败!');history.back();</script>"; 
}
}
if(isset($_GET["do"])&&($_GET["do"]=="exit")){
	$_SESSION["adminuser"]=null;
	$_SESSION["adminpass"]=null; 
	echo "<script>alert('退出成功!');history.back();</script>"; 
}
?>

<div id="text2">
      <h1><img src="image/edit-icon.gif"/>管理员登录</h1>
      <table width="600" height="96" border="0" cellpadding="0" cellspacing="0">
        <form method="post" action="login.php">
          <tr>
            <td width="138" height="35">用户名：
              <input name="user" type="text" id="user3" size="15"></td>
          </tr>
          <tr>
            <td height="29">密&nbsp;&nbsp;&nbsp;&nbsp;码：
              <input name="pass" type="password" id="pass2" size="15"></td>
          </tr>
          <tr>
            <td height="32"><input type="hidden" name="do" id="do" value="login">
              <input type="submit" value="登录 " style="width:60px;"/>
              <input name="重置" type="reset" value="重置 " style="width:60px;"/></td>
          </tr>
        </form>
      </table>
    </div>
	
<?php
include "footer.php";