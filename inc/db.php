<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$dbport = 3306;
$dbname = 'graduation-design';
$dbcharset = 'utf8';
$dsn = "mysql:host=$dbhost;dbname=$dbname;port=$dbport";
$opt = array(1002=>"set names $dbcharset");
try{
    $db = new pdo($dsn,$dbuser,$dbpass,$opt);	
}catch(Exception $e){
	exit('MySQL Connection Fail...');	
}
date_default_timezone_set('PRC'); 

/**
 *	功能：数据插入
 */
function save($tablename,$data){
	global $db;
	foreach($data as $k=>$v){
		$kk[] = 	$k;
		$vv[] = ':'.$k;
	}
	$kk = implode(',',$kk);
	$vv = implode(',',$vv);
	$stmt = $db->prepare("insert into $tablename($kk) values($vv)");
	$stmt->execute($data);
}
/**
 * 功能：删除表
 */
function drop($tablename){
	global $db;
	$db->exec("drop table if exists $tablename");	
}

/**
 * 功能：删除表的记录
 */
function delete($tablename,$where='1=1'){
	global $db;
	$stmt = $db->prepare("delete from $tablename where $where");
	$stmt->execute();
}

/**
 * 功能：实现某字段累加 
 */
function updateinc($tablename,$data,$where='1=1'){
	global $db;
	foreach($data as $k=>$v){
		$kk[] = 	$k.'='.$k.'+'.$v;
	}
	$kk = implode(',',$kk);
	$stmt = $db->prepare("update $tablename set $kk where $where");
	$stmt->execute($data);
}

/**
 * 功能：修改记录
 */
function update($tablename,$where='1=1',$data=array()){
	global $db;	
	foreach($data as $k=>$v){
		$kk[] = 	$k.'=:'.$k;
	}
	$kk = implode(',',$kk);
	$stmt = $db->prepare("update $tablename set $kk where $where");
	$stmt->execute($data);
}
/**
 * 功能：实现查询返回多条记录，结果是二维数组
 */
function query($tablename,$fields='*',$where='1=1',$order='',$limit='limit 0,10'){
	global $db;
	$stmt = $db->prepare("select $fields from $tablename where $where $order $limit");
	$stmt->execute();
	return $stmt->fetchAll(2);
}

/**
 * 功能：实现查询返回一条记录，结果是一维数组
 */
function queryone($tablename,$fields='*',$where='1=1',$limit='limit 0,1'){
	global $db;
	$stmt = $db->prepare("select $fields from $tablename where $where $limit");
	$stmt->execute();
	$rows = $stmt->fetchAll(2);
	return $rows[0];
}

/**
 * 功能：数据分页
 */
function page($tablename,$pagesize=10,$fields='*',$where='1=1',$order='',$type=''){
	 global $db;
	 $currpage = isset($_GET['p']) ?  $_GET['p'] : 1;
	 //统计总记录数
	 $stmt = $db->prepare("select count(*) from $tablename where $where");
	 $stmt->execute();
	 $stmt->bindColumn(1,$recordcount);
	 $stmt->fetch(PDO::FETCH_BOUND);
	 
	 //求出总页数
	 $pagecount = ceil($recordcount/$pagesize);
	 
	 if($currpage<1) $currpage = 1;
	 if($currpage>$pagecount) $currpage = $pagecount;
	 
	 //求出当前页的记录
	 $stmt = $db->prepare("select $fields from $tablename where $where $order limit ?,?");
	 $start = $currpage*$pagesize - $pagesize;
	 $stmt->bindParam(1,$start,PDO::PARAM_INT);
	 $stmt->bindParam(2,$pagesize,PDO::PARAM_INT);
	 $stmt->execute();
	 $rows = $stmt->fetchAll(2);
	 
	 //求出分页信息
	 $page = "<div class='page'>";
	 $ss = 1;
	if($currpage>=5){
		$ss = $currpage-5+1;		
	}
	$ee = $ss+8;
	if($currpage>1){
		$page .= "<a href='?p=1'>首页</a>";
		$prev = $currpage-1;
		$page.="<a href='?p=$prev'>上一页</a>";
	}
	for($i=$ss;$i<=$ee;$i++){
		if($i>$pagecount) break;
		if($i==$currpage){
			$page.= "<span>&nbsp;$i&nbsp;</span>";
			continue;	
		}
		$page.="<a href='?p=$i'>$i</a>";
	}
	$next = $currpage+1;
	if($currpage<$pagecount){
		$page.= "<a href='?p=$next'>下一页</a>";
		$page.= "<a href='?p=$pagecount'>尾页</a>";
	}
	$page .= "</div>";
	
	return array('rows'=>$rows,'page'=>$page);
}