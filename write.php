<?php
include "head.php";
?>

 <script>
	function check(){
		//检查标题不能空
		var t = document.getElementById('title');
		if(t.value==''){
			alert("请注意，留言标题不能为空.");	
			t.focus();
			return false;
		}
		return true;	
	}
	</script>
<?php
//接提交的留言并保存
if(isset($_POST['title'])){
		$_POST['gtime'] = time();
//		print_r($_POST);
//		echo "</br>";
		save('guest',$_POST);
		header('location:./read.php');
};
?>
  	
    <div id="text">
      <h1><img src="image/edit-icon.gif"/>发表新留言</h1>
	  <form action="" method="post" onSubmit="return check()">

        <dl>
          <dt>
            <label for="title">标题：</label>
            <input type="text" width="260px" name="title" />
            （*必填）</dt>
			
          <dt>
            <label for="truename">姓名：</label>
            <input type="text" width="260px" name="truename" />
            （*必填）</dt>
          
          <dt>
            <label for="content">内容：</label>
            <textarea cols="40" rows="5" name="content" ></textarea>
          </dt>  
        </dl>

	
        <input type="submit" value="保存" style="width:60px;" />
        <input type="reset"  value="重置"  style="width:60px;"/>
      </form>
    </div>
 
<?php
include "footer.php";
?>
