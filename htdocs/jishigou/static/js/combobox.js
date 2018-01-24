/**
 * ��Ͽ�ؼ�
 * ʹ�û��߶��ο����뱣��������Ϣ
 *
 * @author     ~ZZ~<505171269@qq.com>
 * @version $Id$
 */
 
ComboBoxManager = {
	container:Array(),
	create:function(id) {
		var comboboxHandler = new ComboBox(id);
		this.set(id, comboboxHandler);
		return comboboxHandler;
	},
	get:function(id) {
		return this.container[id];
	},
	set:function(id, val) {
		this.container[id] = val;
	}
};

ComboBox = function(id) {
	this.id = id;
	this.init();
}

ComboBox.prototype = {
	id:'null',
	combobox:'null',
	selectIndex:0,		//Ĭ�ϵ�һ��ѡ��
	currentOption:null,
	currentVal:null,
	optionLimit:5,		//option�б���ʾ����,Ĭ��10��
	init:function() {
		//��ʼ����Ͽ�
		this.combobox = $('<dt><div style="overflow:auto;zoom:1"><span id="__selected_option_'+this.id+'" class="m"></span><span id="__allow_'+this.id+'" class="icon"></span></div></dt>');
		$('#'+this.id+' dd').before(this.combobox);
		
		//��ȡselectIndexѡ��
		var iCount = 0;
		var self = this;
		$('#'+this.id+' dd ul li').each(function(){
			//���û���趨selected��Ĭ���ǵ�һ��ѡ�У����������һ��ѡ��
			if (iCount == self.selectIndex) {
				$('#__selected_option_'+self.id).html($(this).html());
				self.currentOption = this;
				self.currentVal = $(this).find('span[class="value"]').html();
				//$(this).hide();
			}
			
			var s = $(this).attr("selected");
			if (typeof s != 'undefined') {
				if (s.toLowerCase() == 'selected') {
					$('#__selected_option_'+self.id).html($(this).html());
					self.currentOption = this;
					self.currentVal = $(this).find('span[class="value"]').html();
				}
			}
			iCount++;
		});
		this.setOptionListWidth();
		
		if (iCount > this.optionLimit) {
			var optionHeight = this.getOptionListHeight() / iCount;
			this.setOptionListHeight(optionHeight * this.optionLimit);
		}

		//�����꾭���¼�
		$(this.combobox.get(0)).mouseover(function(){
			$("#__allow_"+self.id).css({'background-position':'0 -16px'});
		});
		
		$(this.combobox.get(0)).mouseout(function(){
			$("#__allow_"+self.id).css({'background-position':'0 0'});
		});
		
		//������¼�
		$(this.combobox.get(0)).click(function(){
			if ($('#'+self.id+' dd ul').is(":hidden")) {
				$('body').one('click',function(){
					$('#'+self.id+' dd ul').hide();
				});
				$('#'+self.id+' dd ul').show();
				self.brightOption(self.currentOption);
			} else {
				$('#'+self.id+' dd ul').hide();
			}
			return false;
    	});
		
		//�б������¼�
		$('#'+this.id+' dd ul li').click(function(){
			var itemContent = $(this).html();
			$('#__selected_option_'+self.id).html(itemContent);
			$(self.currentOption).show();
			//$(this).hide();
			self.currentOption = this;
			self.currentVal = $(this).find('span[class="value"]').html();
			self.change();
		});
		
		//�����б���꾭������
		$('#'+this.id+' dd ul li').mouseover(function(){
			self.brightOption(this);
		});
	},
	
	//����ѡ����Ŀ
	brightOption:function(c, color){
		if (typeof color == 'undefined') {
			var color = "#609adb";
		}
		$('#'+this.id+' dd ul li').each(function(){
			$(this).css({"background-color":"#fff"});
		});
		$(c).css({"background-color":color});
	},
	
	//��ȡ��ǰѡ�е�ֵ
	val:function() {
		return this.currentVal;
	},
	
	//�趨options�б��
	setOptionListHeight:function(h) {
		h = h+'px';
		$('#'+this.id+' dd ul').css({'height':h});
	},
	
	//��ȡoption�ĸ�
	getOptionListHeight:function() {
		var h = $('#'+this.id+' dd ul').height();
		return h;
	},
	
	//�趨�б���
	setComboBoxWidth:function(w) {
		w = w+'px';
		$('#'+this.id).css({'width':w});
		this.setOptionListWidth();
	},
	
	//�趨ѡ���б�Ŀ�
	setOptionListWidth:function() {
		var padding = parseInt($(this.combobox.get(0)).css('padding-left')) + parseInt($(this.combobox.get(0)).css('padding-right'));
		$('#'+this.id+' dd ul').width($(this.combobox.get(0)).width() + padding);
	},
	
	//����option�б����ʾ����
	setOptionLimit:function(limit) {
		this.optionLimit = limit;
	},
	
	//���б��Ƴ�һ��Ԫ��
	removeOption:function(li){
		$(li).remove();
	},
	
	//ѡ����ı�ص�
	change:function() {
	}
};