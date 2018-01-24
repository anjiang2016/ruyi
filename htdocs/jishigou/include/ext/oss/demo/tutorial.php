<?php
/**
 * ����sdk���Լ���������
 */
require_once '../sdk.class.php';

$oss_sdk_service = new ALIOSS();

//�����Ƿ��curl����ģʽ
$oss_sdk_service->set_debug_mode(FALSE);

//���ÿ�����������������������Ҫע�⣬������֧��һЩ������ţ������ڴ���bucket��ʱ������ʹ��������������ò�Ҫʹ�������ַ�
//$oss_sdk_service->set_enable_domain_style(TRUE);

/**
 * ���Գ���
 */
try{
	/**
	 * Service��ز���
	 */
	//get_service($oss_sdk_service);
	
	/**
	 * Bucket��ز���
	 */
	//create_bucket($oss_sdk_service);
	//delete_bucket($oss_sdk_service);
	//set_bucket_acl($oss_sdk_service);
	//get_bucket_acl($oss_sdk_service);
	
	/**
	 * Object��ز���
	 */
	//list_object($oss_sdk_service);
	//create_directory($oss_sdk_service);
    //upload_by_content($oss_sdk_service);
   	//upload_by_file($oss_sdk_service);
	//copy_object($oss_sdk_service);
	//get_object_meta($oss_sdk_service);   
	//delete_object($oss_sdk_service);    
	//delete_objects($oss_sdk_service);   
	//get_object($oss_sdk_service);       
	//is_object_exist($oss_sdk_service);   
	//upload_by_multi_part($oss_sdk_service); 
	//upload_by_dir($oss_sdk_service); 
	//batch_upload_file($oss_sdk_service);
	
	/**
	 * ����url���
	 */
	//get_sign_url($oss_sdk_service);
	
}catch (Exception $ex){
	die($ex->getMessage());
}

/**
 * ��������
 */
/*%**************************************************************************************************************%*/
// Service ���

//��ȡbucket�б�
function get_service($obj){
	$response = $obj->list_bucket();
	_format($response);
}

/*%**************************************************************************************************************%*/
// Bucket ���

//����bucket
function create_bucket($obj){
	$bucket = 'phpsdk'.time();
	$acl = ALIOSS::OSS_ACL_TYPE_PRIVATE;
	//$acl = ALIOSS::OSS_ACL_TYPE_PUBLIC_READ;
	//$acl = ALIOSS::OSS_ACL_TYPE_PUBLIC_READ_WRITE;
	
	$response = $obj->create_bucket($bucket,$acl);
	_format($response);
}

//ɾ��bucket
function delete_bucket($obj){
	$bucket = 'phpsdk1349849369';
	
	$response = $obj->delete_bucket($bucket);
	_format($response);
}

//����bucket ACL
function set_bucket_acl($obj){
	$bucket = 'phpsdk1349849394';
	//$acl = ALIOSS::OSS_ACL_TYPE_PRIVATE;
	//$acl = ALIOSS::OSS_ACL_TYPE_PUBLIC_READ;
	$acl = ALIOSS::OSS_ACL_TYPE_PUBLIC_READ_WRITE;
	
	$response = $obj->set_bucket_acl($bucket,$acl);
	_format($response);
}

//��ȡbucket ACL
function get_bucket_acl($obj){
	$bucket = 'phpsdk1349849394';
	$options = array(
		ALIOSS::OSS_CONTENT_TYPE => 'text/xml',
	);
		
	$response = $obj->get_bucket_acl($bucket,$options);
	_format($response);	
}

/*%**************************************************************************************************************%*/
// Object ���

//��ȡobject�б�
function list_object($obj){
	$bucket = 'phpsdk1349849394';
	$options = array(
		'delimiter' => '',
		'prefix' => '',
		'max-keys' => 100,
		//'marker' => 'myobject-1330850469.pdf',
	);
	
	$response = $obj->list_object($bucket,$options);	
	_format($response);
}

//����Ŀ¼
function create_directory($obj){
	$bucket = 'phpsdk1349849394';
	$dir = 'myfoloder-'.time();
	
	$response  = $obj->create_object_dir($bucket,$dir);
	_format($response);
}

//ͨ�������ϴ��ļ�
function upload_by_content($obj){
	$bucket = 'phpsdk1349849394';
	$folder = 'object001/';
	
	for($index = 100;$index < 999;$index++){	
		
		$object = $folder.'myobj_'.$index.'.txt';
		
		$content  = 'uploadfile';
		/**
	    for($i = 1;$i<100;$i++){
			$content .= $i;
		}
		*/
	    
		$upload_file_options = array(
			'content' => $content,
			'length' => strlen($content),
			ALIOSS::OSS_HEADERS => array(
				'Expires' => '2012-10-01 08:00:00',
			),
		);
		
		$response = $obj->upload_file_by_content($bucket,$object,$upload_file_options);
		echo 'upload file {'.$object.'}'.($response->isOk()?'ok':'fail')."\n";
	}
	//_format($response);
}

//ͨ��·���ϴ��ļ�
function upload_by_file($obj){
	$bucket = 'phpsdk1349849394';
	$object = 'netbeans-7.1.2-ml-cpp-linux.sh';	
	$file_path = "D:\\TDDOWNLOAD\\netbeans-7.1.2-ml-cpp-linux.sh";
	
	$response = $obj->upload_file_by_file($bucket,$object,$file_path);
	_format($response);
}

//����object
function copy_object($obj){
		//copy object
		$from_bucket = 'phpsdk1349849394';
		$from_object = 'netbeans-7.1.2-ml-cpp-linux.sh';
		$to_bucket = 'phpsdk1349849394';
		$to_object = 'copy-netbeans-7.1.2-ml-cpp-linux-'.time().'.sh';

		$response = $obj->copy_object($from_bucket,$from_object,$to_bucket,$to_object);
		_format($response);
}

//��ȡobject meta
function get_object_meta($obj){
	$bucket = 'phpsdk1349849394';
	$object = 'netbeans-7.1.2-ml-cpp-linux.sh'; 

	$response = $obj->get_object_meta($bucket,$object);
	_format($response);
}

//ɾ��object
function delete_object($obj){
	$bucket = 'phpsdk1349849394';	
	$object = 'myfoloder-1349850939/';
	$response = $obj->delete_object($bucket,$object);
	_format($response);
}

//ɾ��objects
function delete_objects($obj){
	$bucket = 'phpsdk1349849394';
	$objects = array('myfoloder-1349850940/','myfoloder-1349850941/',);   
	
	$options = array(
		'quiet' => false,
		//ALIOSS::OSS_CONTENT_TYPE => 'text/xml',
	);
	
	$response = $obj->delete_objects($bucket,$objects,$options);
	_format($response);
}

//��ȡobject
function get_object($obj){
	$bucket = 'phpsdk1349849394';
	$object = 'netbeans-7.1.2-ml-cpp-linux.sh'; 
	
	$options = array(
		ALIOSS::OSS_FILE_DOWNLOAD => "d:\\cccccccccc.sh",
		//ALIOSS::OSS_CONTENT_TYPE => 'txt/html',
	);	
	
	$response = $obj->get_object($bucket,$object,$options);
	_format($response);
}

//���object�Ƿ����
function is_object_exist($obj){
	$bucket = 'phpsdk1349849394';
	$object = 'netbeans-7.1.2-ml-cpp-linux.sh';  
							
	$response = $obj->is_object_exist($bucket,$object);
	_format($response);
}

//ͨ��multipart�ϴ��ļ�
function upload_by_multi_part($obj){
	$bucket = 'phpsdk1349849394';
	$object = 'Mining.the.Social.Web-'.time().'.pdf';  //Ӣ��
	$filepath = "D:\\Book\\Mining.the.Social.Web.pdf";  //Ӣ��
		
	$options = array(
		ALIOSS::OSS_FILE_UPLOAD => $filepath,
		'partSize' => 5242880,
	);

	$response = $obj->create_mpu_object($bucket, $object,$options);
	_format($response);
}

//ͨ��multipart�ϴ�����Ŀ¼
function upload_by_dir($obj){
	$bucket = 'phpsdk1349849394';
	$dir = "D:\\alidata\\www\\logs\\aliyun.com\\oss\\";
	$recursive = false;
	
	$response = $obj->create_mtu_object_by_dir($bucket,$dir,$recursive);
	var_dump($response);	
}

//ͨ��multi-part�ϴ�����Ŀ¼(�°�)
function batch_upload_file($obj){
	$options = array(
		'bucket' 	=> 'phpsdk1349849394',
		'object'	=> 'picture',
		'directory' => 'D:\alidata\www\logs\aliyun.com\oss',
	);
	$response = $obj->batch_upload_file($options);
}



/*%**************************************************************************************************************%*/
// ǩ��url ���

//����ǩ��url,��Ҫ�û�˽��Ȩ���µķ��ʿ���
function get_sign_url($obj){
	$bucket = 'phpsdk1349849394';
	$object = 'netbeans-7.1.2-ml-cpp-linux.sh';
	$timeout = 3600;

	$response = $obj->get_sign_url($bucket,$object,$timeout);
	var_dump($response);
}

/*%**************************************************************************************************************%*/
// ��� ���

//��ʽ�����ؽ��
function _format($response) {
	echo '|-----------------------Start---------------------------------------------------------------------------------------------------'."\n";
	echo '|-Status:' . $response->status . "\n";
	echo '|-Body:' ."\n"; 
	echo $response->body . "\n";
	echo "|-Header:\n";
	print_r ( $response->header );
	echo '-----------------------End-----------------------------------------------------------------------------------------------------'."\n\n";
}




