<?php ob_start();require_once('Connections/rymssb.php'); ?>
<?php 
mysql_query("SET NAMES utf8;");
mysql_select_db($database_news, $news);//选择数据库
$page = intval($_GET['page']); //获取请求的页数 
$page1 = intval($_GET['page1']);
$start = $page; 


//sql字符串处理
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

if(empty($page1))
{
	$query=mysql_query("select * from novel order by id desc limit $start,1", $news) or die(mysql_error());
}
else
{
    $query_Recordset1 = sprintf("select * from novel where type_id = %s order by id desc limit $start,1", GetSQLValueString($page1, "int"));
	$query=mysql_query($query_Recordset1, $news) or die(mysql_error());
}


while ($row=mysql_fetch_array($query))
{ 
	$arr[] = array( 
	'title'=>$row['title'], 
	'id'=>$row['id']
	); 
} 
echo json_encode($arr); //转换为json数据输出 
//echo encode_json(arr_iconv("GBK", "UTF-8", $arr)); //转换为json数据输出 
//echo json_encode(tb_json_convert_encoding($value, "GBK", "UTF-8")); // 先将gbk转换为utf8 再转为json数据
//echo tb_json_decode(json_encode(tb_json_convert_encoding($value, "GBK", "UTF-8")));
//print_r(mysql_fetch_array($query));


mysql_free_result($query);

//echo my_json_encode($arr);





function encode_json($str) {
	return url_decode(json_encode(url_encode($str)));	
}

/**
 * 
 */
function url_encode($str) {
	if(is_array($str)) {
		foreach($str as $key=>$value) {
			$str[urlencode($key)] = url_encode($value);
		}
	} else {
		$str = urlencode($str);
	}
	
	return $str;
}
function url_decode($str) {
	if(is_array($str)) {
		foreach($str as $key=>$value) {
			$str[urldecode($key)] = url_decode($value);
		}
	} else {
		$str = urldecode($str);
	}
	
	return $str;
}
function arr_iconv($str){
	if(is_array($str)) {
		foreach($str as $key=>$value) {
			$str[iconv("GBK", "UTF-8", $key)] = iconv("GBK", "UTF-8", $value);
		}
	} else {
		$str = iconv("GBK", "UTF-8", $str);
	}
	
	return $str;
}


function tb_json_encode($value, $options = 0)
{
  return json_encode(tb_json_convert_encoding($value, "GBK", "UTF-8"));
}

function tb_json_decode($str, $assoc = false, $depth = 512)
{
  return tb_json_convert_encoding(json_decode($str, $assoc), "UTF-8", "GBK");
}


function tb_json_convert_encoding($m, $from, $to)
{
  switch(gettype($m)) {
    case 'integer':
    case 'boolean':
    case 'float':
    case 'double':
    case 'NULL':
      return $m;

    case 'string':
      return mb_convert_encoding($m, $to, $from);
    case 'object':
      $vars = array_keys(get_object_vars($m));
      foreach($vars as $key) {
        $m->$key = tb_json_convert_encoding($m->$key, $from ,$to);
      }
      return $m;
    case 'array':
      foreach($m as $k => $v) {
        $m[tb_json_convert_encoding($k, $from, $to)] = tb_json_convert_encoding($v, $from, $to);
      }
      return $m;
    default:
  }
  return $m;
}


function my_json_encode($data) {
        $s= array();
        foreach($data as $k => $v) {
            if(is_array($v)) {
                $v = my_json_encode($v);
                $s[] = "\"$k\":$v";
            }else{
                $v = addslashes( str_replace( array("\n","\r"), '', $v));
                $s[] = "\"$k\": \"$v\"";
            }
        }
        return '{'.implode(', ', $s).'}';
    }
?> 

