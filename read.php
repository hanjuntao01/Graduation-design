<?php
include "head.php";

//删除留言
if(isset($_GET['did'])){
	$id = $_GET['did'];
	delete('guest','id='.$id);
	header('location:./read.php');
}

//分页显示留言内容
$rs = page('guest',3,'*','1=1','order by id desc');
$rows = $rs['rows'];

?>
<div id="read">
<table  border="0"  width="100%"  height="200" align="left" cellspacing="1" bgcolor="#DDE4F4" onsubmit="return dosubmit();">
 
  <tr>
    <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2" bgcolor="#EDEEF8">&nbsp;留言列表</td>
  </tr>
  <?php
 foreach($rows as $v){
  ?>
  <tr>
    <td width="167" height="25" bgcolor="#FFFFFF">
      <table width="100%" height="80%" border="0">
        <tr>
          <td align="center">姓名：<?=$v['truename']?></td>
        </tr>
      </table></td>
    <td width="726" height="25" valign="middle" bgcolor="#FFFFFF">
      <table width="100%" border="0" cellspacing="1" bgcolor="#EAEAEA">
      <tr>
        <td height="30" bgcolor="#FFFFFF">时间：<?php echo date( "Y-m-d H:i:s",$v['gtime']);  ?>&nbsp;&nbsp;主题：<?=$v['title']?></td>
      </tr>
      <tr>
        <td height="30" bgcolor="#FFFFFF">&nbsp;<?=$v['content']?></td>
      </tr>
	  <!--
      <tr>
        <td height="30" bgcolor="#FFFFFF"><a onclick="return confirm('是否要删除:<?=$v['title']?>?');" href='?did=<?=$v['id']?>'>&nbsp;删除</a></td>
      </tr>
	  -->
    </table></td>
  </tr>
  
  </div>
  <?php
  }
  
  ?>
  <tr>
    <td height="25" colspan="2" align="center" bgcolor="#EDEEF8">	<?=$rs['page']?></td>
  </tr>
  </table>
 </div>
  <?php 
   include "footer.php";
  ?>
  
  