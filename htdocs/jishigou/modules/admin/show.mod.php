<?php
/**
 * [JishiGou] (C)2005 - 2099 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename show.mod.php $
 *
 * @Author http://www.jishigou.net $
 *
 * @Date 2014 2049745887 12956 $
 */



if(!defined('IN_JISHIGOU'))
{
    exit('invalid request');
}

class ModuleObject extends MasterObject
{
	
	function ModuleObject($config)
	{
		$this->MasterObject($config);
		$this->Execute();
	}

	
	function Execute()
	{
		ob_start();
		switch($this->Code)
		{
			case 'editlogo':
				$this->EditLogo();
				break;
			case 'edit_theme':
				$this->EditTheme();
				break;
			case 'doedittheme':
				$this->DoEditTheme();
				break;
			case 'modify':
				$this->Main();
				break;
			case 'domodify':
				$this->DoModify();
				break;
			case 'modify_theme':
				$this->ModifyTheme();
				break;
			case 'domodifytheme':
				$this->DoModifyTheme();
				break;
			case 'modify_template':
				$this->ModifyTemplate();
				break;
			case 'setopen':
				$this->setOpen();
				break;
			default:
				$this->Code = 'modify';
				$this->Main();
				break;
		}

		$body = ob_get_clean();

		$this->ShowBody($body);

	}

	
	function Main()
	{
		$this->Modify();
	}

	
	function EditLogo(){

		$flag = get_param('flag');
		if($flag){

	        if($_FILES['logo_guest']['name']){
				$this->loadLogo('logo_guest');
	        }
			if($_FILES['logo']['name']){
				$this->loadLogo('logo');
	        }
	        $this->Messager('设置成功','admin.php?mod=show&code=editlogo');
		}
		$flag = 1;
        include(template("admin/show_theme"));
	}

	function loadLogo($name){
		
		$image_name = $name.".png";
		$image_path = RELATIVE_ROOT_PATH . 'images/';
		$image_file = $image_path . $image_name;

		if (!is_dir($image_path))
		{
			jio()->MakeDir($image_path);
		}

		jupload()->init($image_path,$name,true);
		jupload()->setMaxSize(4000);
		jupload()->setNewName($image_name);
		$result=jupload()->doUpload();

		if($result)
        {
			$result = is_image($image_file);
		}
		if(!$result)
        {
			unlink($image_file);
			return false;
		}
		return true;
	}

	
	function EditTheme(){
		$id = $this->Get['id'];
		$theme_arr = jconf::get('theme');
		if(!$id){
			$this->Messager("主题不存在");
		}
		if(in_array($id,$theme_arr['theme_id'])){
			$open = 1;
		}

		$theme_bg_color = $theme_arr['theme_list'][$id]['theme_bg_color'] ? $theme_arr['theme_list'][$id]['theme_bg_color'] : "#2F97CA";
		$theme_link_color = $theme_arr['theme_list'][$id]['theme_link_color'] ? $theme_arr['theme_list'][$id]['theme_link_color'] : "#0073B2";;
		$theme_text_color = $theme_arr['theme_list'][$id]['theme_text_color'] ? $theme_arr['theme_list'][$id]['theme_text_color'] : "#333333";;
		$theme_bg_image_type = $theme_arr['theme_list'][$id]['theme_bg_image_type'] ? $theme_arr['theme_list'][$id]['theme_bg_image_type'] : "center";
		$theme_bg_image_type_s[$theme_bg_image_type] = "selected";


		include(template("admin/show_theme"));
	}

	
	function DoEditTheme(){
		$id = $this->Post['id'];
		if(!$id){
			$this->Messager("主题不存在","admin.php?mod=show&code=modify_theme");
		}
		
		$theme_arr = jconf::get('theme');
		$theme_arr['theme_list'][$id]['theme_bg_color'] = $this->Post['theme_bg_color'] ? $this->Post['theme_bg_color'] : "#2F97CA";
		$theme_arr['theme_list'][$id]['theme_link_color'] = $this->Post['theme_link_color'] ? $this->Post['theme_link_color'] : "#0073B2";
		$theme_arr['theme_list'][$id]['theme_text_color'] = $this->Post['theme_text_color'] ? $this->Post['theme_text_color'] : "#333333";
		$theme_arr['theme_list'][$id]['theme_bg_image_type'] = $this->Post['theme_bg_image_type'] ? $this->Post['theme_bg_image_type'] : "center";
		jconf::set('theme',$theme_arr);

				$config = array();
		if($this->Post['set_system_theme'] == 1){
			$config['theme_bg_color'] = $this->Post['theme_bg_color'] ? $this->Post['theme_bg_color'] : '#2F97CA';
			$config['theme_bg_image_type'] = $this->Post['theme_bg_image_type'] ? $this->Post['theme_bg_image_type'] : 'center';
			$config['theme_id'] = $id;
			$config['theme_link_color'] = $this->Post['theme_link_color'] ? $this->Post['theme_link_color'] : '#0073B2';
			$config['theme_text_color'] = $this->Post['theme_text_color'] ? $this->Post['theme_text_color'] : '#333333';
			jconf::update($config);
		}
	     




        if($_FILES['changePic']['name']){
			$type = trim(strtolower(end(explode(".",$_FILES['changePic']['name']))));
			$themebg = "themebg";

			$image_name = $themebg.".jpg";
			$image_path = RELATIVE_ROOT_PATH . './theme/'.$id.'/images/';
			$image_file = $image_path . $image_name;

			if (!is_dir($image_path))
			{
				jio()->MakeDir($image_path);
			}

			jupload()->init($image_path,'changePic',true);
			jupload()->setMaxSize(5120);
			jupload()->setNewName($image_name);
			$result=jupload()->doUpload();

						$themebg_preview = "themebg_preview";
			$themebg_preview_name = $themebg_preview.".jpg";
			$themebg_preview_path = RELATIVE_ROOT_PATH . './theme/'.$id."/";
			$image_file_min = $themebg_preview_path . $themebg_preview_name;

			image_thumb($image_file,$image_file_min,76,76);
			if($result)
	        {
				$result = is_image($image_file);
			}
			if(!$result)
	        {
				unlink($image_file);
				unlink($image_file_min);
				$this->Messager("上传失败",-1);
			}
        }
        $this->Messager("设置成功","admin.php?mod=show&code=modify_theme");
	}

	
	function ModifyTheme(){
		$theme_list = array();
		$theme_arr = jconf::get('theme');
		$open_theme_list = $theme_arr['theme_id'];
		$theme_list = $theme_arr['theme_list'];
				$dir = "./theme/";
		$fp=opendir($dir);
		while ($theme=readdir($fp))
		{
			if($theme=='..' || $theme=='.' || $theme=='.svn' || $theme=='_svn')continue;
			if(is_dir($dir.'/'.$theme))
			{
				$theme_name=$theme;
				$theme_config_file = $dir.'/'.$theme.'/theme_config.php';

				if(in_array($theme,$open_theme_list)){
					$theme_list[$theme]['sort'] = $theme_list[$theme]['sort'] ? $theme_list[$theme]['sort'] : 0;
					$theme_list[$theme]['open'] = '1';
					$theme_list[$theme]['themebg_preview'] = $dir.'/'.$theme.'/themebg_preview.jpg';
					continue;
				}

				if(is_file($theme_config_file))
				{
					@include($theme_config_file);
				}
				$theme_list[$theme]=array(
									'theme_id'=>$theme_name,
									'title'=>$theme_info['title'],
									'desc'=>$theme_info['desc'],
									'sort'=>$theme_info['sort'] ? $theme_info['sort'] : 0,
									'themebg_preview'=>$dir.'/'.$theme.'/themebg_preview.jpg',
				);
			}
		}
				$system_theme_id = $this->Config['theme_id'];


		include(template("admin/show_theme"));
		exit();
	}

	function DoModifyTheme(){
				$theme_arr = jconf::get('theme');
		foreach ($theme_arr['theme_list'] as $key => $val) {
			$theme_arr['theme_list'][$key]['title'] = $this->Post[$key]['title'];
			$theme_arr['theme_list'][$key]['sort'] = (int)$this->Post[$key]['sort'] ? (int)$this->Post[$key]['sort'] : 0;
			$theme_arr['theme_list'][$key]['desc'] = $this->Post[$key]['desc'];
		}

		uasort($theme_arr['theme_list'],create_function('$a,$b','if($a[sort]==$b[sort])return 0;return $a[sort]<$b[sort]?1:-1;'));
		jconf::set('theme',$theme_arr);
		$this->Messager("设置成功");
	}

	
	function setOpen(){
				$theme = $this->Get['id'];
				$state = (int) $this->Get['state'];
				$theme_arr = jconf::get('theme');

		$dir = "./theme/";
		$theme_config_file = $dir.'/'.$theme.'/theme_config.php';

		switch($state){
			case '0':
				unset($theme_arr['theme_id'][$theme]);
				unset($theme_arr['theme_list'][$theme]);
				break;
			case '1':
				if(is_file($theme_config_file)){
					@include($theme_config_file);
				}
				$theme_arr['theme_id'][$theme] = $theme;
				$theme_arr['theme_list'][$theme] = array(
					'theme_id' => $theme,
					'title' => $theme_info['title'],
					'desc' => $theme_info['desc'],
					'theme_bg_color'=>$theme_info['theme_bg_color'] ? $theme_info['theme_bg_color'] : '#2F97CA',
					'theme_text_color'=>$theme_info['theme_text_color'] ? $theme_info['theme_text_color'] : '#333333',
					'theme_link_color'=>$theme_info['theme_link_color'] ? $theme_info['theme_link_color'] : '#0073B2',
					'theme_bg_image_type'=>$theme_info['theme_bg_image_type'] ? $theme_info['theme_bg_image_type'] : 'center',
				);
				break;
		}

		$theme_arr = jconf::set('theme',$theme_arr);
		$this->Messager("设置成功");
	}

	function Modify($options = array())
	{
		$show=jconf::get('show');
		$cache = jconf::get('cache');

				$fp=opendir($this->Config['template_root_path']);
		while ($template=readdir($fp))
		{
			if($template=='..' || $template=='.' || $template=='.svn' || $template=='_svn')continue;
			if(is_dir($this->Config['template_root_path'].'/'.$template))
			{
				$tpl_name=$template;
				$tplinfo_file = $this->Config['template_root_path'].'/'.$template.'/tplinfo.php';
				if(is_file($tplinfo_file))
				{
					@include($tplinfo_file);
				}
				$template_list[$template]=array("name"=>"[{$template}]{$tpl_name}","value"=>$template);
				$template_name_list[$template]=$tpl_name;
			}
		}
		array_multisort($template_name_list,SORT_DESC,$template_list);

		$template_select=$this->jishigou_form->Select('template_path',$template_list,$this->Config['template_path']);
		$templatedeveloper_radio = $this->jishigou_form->YesNoRadio('templatedeveloper', (int) $this->Config['templatedeveloper']);
		$style_three_tol_radio = $this->jishigou_form->YesNoRadio('style_three_tol', (int) $this->Config['style_three_tol']);


		$tpl = $options['tpl'] ? $options['tpl'] : 'admin/show';
		include(template($tpl));
	}

	function DoModify()
	{
		if(isset($this->Post['show'])) {
			jconf::set('show',$this->Post['show']);
		}
		if(isset($this->Post['cache'])) {
			jconf::set('cache',$this->Post['cache']);
		}

		cache_clear();


				$config = array();
		if(($this->Post['template_path']!="" &&
			$this->Post['template_path']!=$this->Config['template_path'])) {
				$this->Post['template_path'] = dir_safe($this->Post['template_path']);
				$config['template_path'] = $this->Post['template_path'];
		}
		if((isset($this->Post['templatedeveloper']) &&
			$this->Post['templatedeveloper']!=$this->Config['templatedeveloper'])) {
			$config['templatedeveloper'] = ($this->Post['templatedeveloper'] ? 1 : 0);
		}
		if((isset($this->Post['style_three_tol']) &&
			$this->Post['style_three_tol']!=$this->Config['style_three_tol'])) {
			$config['style_three_tol'] = ($this->Post['style_three_tol'] ? 1 : 0);
		}
		if($config) {
			jconf::update($config);
		}


		$this->Messager("设置成功");
	}

	function cache_time($min=0,$max=0)
	{
		$list = array(
			10 => array('name'=>'10秒','value'=>'10',),
			30 => array('name'=>'30秒','value'=>'30',),
			60 => array('name'=>'1分钟','value'=>'60',),
			180 => array('name'=>'3分钟','value'=>'180',),
			300 => array('name'=>'5分钟','value'=>'300',),
			600 => array('name'=>'10分钟','value'=>'600',),
			1800 => array('name'=>'半小时','value'=>'1800',),
			3600 => array('name'=>'1小时','value'=>'3600',),
			7200 => array('name'=>'2小时','value'=>'7200',),
			14400 => array('name'=>'4小时','value'=>'14400',),
			28800 => array('name'=>'8小时','value'=>'28800',),
			43200 => array('name'=>'12小时','value'=>'43200',),
			86400 => array('name'=>'1天','value'=>'86400',),
			172800 => array('name'=>'2天','value'=>'172800',),
			345600 => array('name'=>'4天','value'=>'345600',),
			604800 => array('name'=>'1星期','value'=>'604800',),
			1209600 => array('name'=>'2星期','value'=>'1209600',),
			1814400 => array("name"=>"3星期",'value'=>1814400),
			2592000 => array('name'=>'1个月','value'=>'2592000',),
			5184000 => array('name'=>'2个月','value'=>'5184000',),
			7776000 => array("name"=>"3个月",'value'=>7776000),
			15552000 => array('name'=>'6个月','value'=>'15552000',),
			31104000 => array('name'=>'1年','value'=>'31104000',),
			62208000 => array('name'=>'2年','value'=>'62208000',),
		);
		if(0==$min && 0==$max) return $list;

		$_min = min((int) $min,(int) $max);
		$_max = max((int) $min,(int) $max);
		$cache_time = array();
		foreach ($list as $k=>$v) {
			if($k >= $_min && $k <= $_max) {
				$cache_time[$k] = $v;
			}
		}

		return $cache_time;
	}

	function ModifyTemplate()
	{
		$options = array(
			'tpl' => 'admin/show_template',
		);
		$this->Modify($options);
	}
}
?>
