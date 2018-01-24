<?php
/**
 *
 * �ļ��ϴ���ز�����
 *
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @copyright Copyright (C) 2005 - 2099 Cenwor Inc.
 * @license http://www.cenwor.com
 * @link http://www.jishigou.net
 * @author ����<foxis@qq.com>
 * @version $Id: upload.class.php 5263 2013-12-13 07:55:28Z chenxianfeng $
 */

if(!defined('IN_JISHIGOU'))
{
    exit('invalid request');
}

class jishigou_upload
{
	
    var $_error;

	
	var $_new_name;

	
	var $_save_name;

   
    var $_path;

    
    var $_field;

   
    var $_max_size;

   
    var $_image;

   
    var $_ext;

   
    var $_ext_types;

   
    var $_image_types;


	
	function jishigou_upload() {
	   ;
	}

	
    function init($path, $field = 'upload', $image = false, $attach = false) {
    	if(!is_dir($path)) {
    		jmkdir($path);
    	}

        $this->_path       =  $path;
        $this->_field      =  $field;
        $this->_max_size   =  2048;         $this->_image      =  $image;
		$this->_attach     =  $attach;
        $this->_ext        =  '';
        $this->_new_name   =  '';
        $this->_save_name  =  '';
		$this->_attach_types = explode('|',$GLOBALS['_J']['config']['attach_file_type']);
        $this->_ext_types   = array('cgi', 'pl', 'js', 'asp', 'php', 'html', 'htm', 'jsp', 'jar', 'txt', 'rar', 'zip');
        $this->_image_types = array('gif', 'jpg', 'jpeg', 'png');
    }

	
    function setMaxSize($size)
    {
        $this->_max_size = (int) $size;
        return true;
    }

	
    function setExtTypes($array)
    {
        if(false == is_array($array))
        {
            return false;
        }

        $this->_ext_types =& $array;
        return true;
    }

	
    function setImgTypes($array)
    {
        if(false == is_array($array))
        {
            return false;
        }

        $this->_image_types =& $array;
        return true;
    }

	
    function setAttachTypes($array)
    {
        if(false == is_array($array))
        {
            return false;
        }

        $this->_attach_types =& $array;
        return true;
    }

	
    function setNewName($name)
    {
        $this->_new_name = trim($name);
        return true;
    }

	
    function getExt()
    {
        return $this->_ext;
    }

	
    function getSaveName()
    {
        return $this->_save_name;
    }


	
	function doUpload()
    {
        if(false == is_writable($this->_path))
        {
            $this->_setError(504);
            return false;
        }

        if(false == isset($_FILES[$this->_field]))
        {
            $this->_setError(501);
            return false;
        }

        $name = $_FILES[$this->_field]['name'];
        $size = $_FILES[$this->_field]['size'];
        $type = $_FILES[$this->_field]['type'];
        $temp = $_FILES[$this->_field]['tmp_name'];

        $type = preg_replace("/^(.+?);.*$/", "\\1", $type);

        if(false == $name || $name == 'none')
        {
            $this->_setError(501);
            return false;
        }

        $_exts = explode('.', $name);
		$this->_ext = strtolower(end($_exts));
		
		if(false == $this->_ext)
		{
            $this->_setError(502);
            return false;
		}
        if(false == $this->_image)
        {
            if(false == $this->_attach) {
				if(false == in_array($this->_ext, array_merge($this->_image_types, $this->_ext_types))) {
					$this->_setError(502);
					return false;
				}
			} else {
				if(false == in_array($this->_ext, $this->_attach_types)){
					$this->_setError(508);
					return false;
				}
			}
        } else {
            if(false == in_array($this->_ext, $this->_image_types))
            {
                $this->_setError(507);
                return false;
            }

            
        }


        if($this->_max_size && $this->_max_size * 1000 < $size)
        {
            $this->_setError(503);
            return false;
        }

        if(false == $this->_new_name)
        {
            $this->_save_name = $name;
            $full_path        = $this->_path . $name;
        }
        else {
            $this->_save_name = $this->_new_name;
            $full_path        = $this->_path     . $this->_save_name;
        }


		if(false == move_uploaded_file($temp, $full_path))
		{
			if(false == copy($temp,$full_path))
			{
	            $this->_setError(505);
	            return false;
			}
		}

		
		if($this->_image && !is_image($full_path)) {
			@unlink($full_path);
			$this->_setError(507);
			return false;
		}

        $this->_setError(506);
        return true;
    }

	
    function getError()
    {
        return $this->_error;
    }
	
	function _GetError()
	{
		$type=$_FILES[$this->_field]['error'];
		$error_types=array(0=>'û�д��������ļ��ϴ��ɹ���',
							1=>'�ϴ����ļ������� php.ini �� upload_max_filesize ѡ�����Ƶ�ֵ��',
							2=>'�ϴ��ļ��Ĵ�С������ HTML ���� MAX_FILE_SIZE ѡ��ָ����ֵ��',
							3=>'�ļ�ֻ�в��ֱ��ϴ���',
							4=>'û���ļ����ϴ���',
							6=>'�Ҳ�����ʱ�ļ��С�',
							7=>'�ļ�д��ʧ��');
        if(false == isset($error_types[$type]))
        {
            $error_types[$type] = $val;
        }
        $this->_error = $error_types[$type];
        return true;

	}



   
    function _setError($type, $val = '')
    {

        $error_types = array(501 => 'û�����ص��ļ�',
                             502 => '���������չ��',
                             503 => '���ص��ļ������˷�����������Ƶ�ֵ������ʧ�ܣ�'.$val,
                             504 => 'Ŀ¼����д',
                             505 => '�ƶ��ļ�ʱ����'.$val,
                             506 => '���سɹ�',
                             507 => '���ص�ͼƬ�ļ�������Ч��ͼƬ�ļ�',
                             508 => '���ص��ļ�������Ч�ĸ����ļ�',
			);

        if(false == isset($error_types[$type]))
        {
            $error_types[$type] = $val;
        }
        $this->_error_no=$type;

        $this->_error = $error_types[$type];
        return true;
    }

    function getErrorNo()
    {
    	return $this->_error_no;
    }
}

?>