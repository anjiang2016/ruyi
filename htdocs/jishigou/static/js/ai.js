/**
 * ����������ʾ��صĺ�����
 * ����������ʾ��At������ʾ�����е����ƣ�����Ҫͳһ�����е��鷳�����Ե��Ժ���ʱ����ͳһ����ʱ�������ˡ�
 * ʹ�û��߶��ο����뱣��������Ϣ
 *
 * @author     ~ZZ~<505171269@qq.com>
 * @version $Id$
 */

//��ʼ�����������
function initAiInput(handle_key, options)
{
	
	if (isUndefined(options)) {
		var options = {};
	}
	
	var at = new At(handle_key);
	var topic = new Topic(handle_key);
	
}

/**����At��ʾ**/
At = function(handle_key, options) {
	if (isUndefined(options)) {
		var options = {};
	}
	this.statusContentTextBox = $('#'+handle_key);
	if (options.itemListTips) {
		this.itemListTips = options.itemListTips;
	}
	this.init();
}

At.prototype = {
	statusContentTextBox:null,
	itemListTips:"<div class='list_tips'>����@�ᵽ˭��</div>",
	atAutocompleter:null,
	atUrl:'ajax.php?mod=misc&code=atuser',
	
	atResult:function(data) {
		return data[0];
	},
	
	//��ʼ��ֻ��At Tips
	init:function(){
		this.atAutocompleter = Autocompleter('__at_search_result__', this.atUrl, {resultCallback:this.atResult,item_list_tips:this.itemListTips});
		
		//�����������ʾ�ؼ�
		var self = this;
		this.statusContentTextBox.keyup(function(event){
			self.searchAtInStatus(self.statusContentTextBox, event);
		}).keydown(self.atAutocompleter.keydownListener)
		  .click(function(event){self.searchAtInStatus(self.statusContentTextBox, event);})
		  .blur(function(event){
			var lastEditIndex = self.statusContentTextBox.data('atLastEditIndex');
			if (lastEditIndex != null) {
				self.selectFirstAtFromSearchResultList(self.statusContentTextBox,true);
			}
		  });
	},
	insertAt:function(at, atIndex, contentTextBox){
		var startIndex = contentTextBox.getSelectionStart();
		var atLastEditIndex = contentTextBox.data('atLastEditIndex');
		contentTextBox.setSelection(atLastEditIndex,startIndex - atLastEditIndex);
		contentTextBox.insertString(['',$.trim(at.name),' '].join(''));
	},
	searchAtInStatus:function(handle, event){
		var contentTextBox = handle;
		//��ȡ��ǰ����λ��
		var startIndex = contentTextBox.getSelectionStart();
		if (event.type == 'keyup' && event.keyCode == 50 && contentTextBox.val().substr(startIndex-1, 1) === '@') {
			contentTextBox.data('atLastEditIndex',startIndex);
			return ;
		}
		
		if (contentTextBox.data('atLastEditIndex')) {
			var lastEditIndex = contentTextBox.data('atLastEditIndex');
			var content = contentTextBox.val().toString(); 
			
			if (this.atAutocompleter.itemList() && (event.keyCode == 38 || event.keyCode == 40 || event.keyCode == 13 || event.keyCode == 27)) {
				return;
			}
			
			var atuser = content.substr(lastEditIndex, startIndex - lastEditIndex);
			if (atuser == '') {
			  this.atAutocompleter.hideItemList();
			  return;
			}
			
			this.atAutocompleter.searchItems(atuser, this.getAtCaretPos(contentTextBox, contentTextBox.val()), contentTextBox.attr("id"));
			var self = this;
			this.atAutocompleter.setSelectCallback(contentTextBox.attr("id"),function(atuser){
				self.insertAt(atuser, startIndex, contentTextBox);
				contentTextBox.data('atLastEditIndex', null);
			});
		}
	},
	getAtCaretPos:function(textbox, content){
		var em = $("<em>&nbsp;</em>");
		var boxPos = textbox.offset();
		var cursorPos = {};
		if ($("#at_caret").length === 0) {
			caret = $("<pre></pre>").attr("id", 'at_caret').css({
			position: 'absolute',
			left: -9999,
			font: '12px/20px "Tahoma", Tahoma, Arial',
			width: textbox.width() + 'px',
			border: '1px',
			"word-wrap": "break-word"
		  });
		  caret.appendTo("body");
		}
		caret.html(content.substr(0, content.length-1)).append(em);
		cursorPos = em.position();
		var res =  {
		  left: cursorPos.left + boxPos.left,
		  top: cursorPos.top + boxPos.top + 20
		};
		return res;
	},
	selectFirstAtFromSearchResultList:function(contentTextBox,delay){
		var self = this;
		var _insertAt = function(){
		if (!self.atAutocompleter.itemList().is(':hidden') && self.atAutocompleter.itemList().find('ul li').length) {
			var startIndex = contentTextBox.getSelectionStart();
			self.atAutocompleter.setSelectCallback(contentTextBox.attr("id"), function(at){
				self.insertAt(at, startIndex, contentTextBox);
			});
			self.atAutocompleter.itemList().find('li:first').click();
		  }
		}
		if (delay) {
		  setTimeout(_insertAt,100);
		} else {
		  _insertAt();
		}
	}
};

/**����������ʾ**/
Topic = function(handle_key, options) {
	if (isUndefined(options)) {
		var options = {};
	}
	this.statusContentTextBox = $('#'+handle_key);
	if (options.itemListTips) {
		this.itemListTips = options.itemListTips;
	}
	this.init();
}

Topic.prototype = {
	statusContentTextBox:null,
	defaultTopicText:'�����Զ��廰��',
	repostStatusContentTextBox:null,
	dmTextBox:null,
	topicAutocompleter:null,
	itemListTips:"<div class='list_tips'>��Ҫ����ʲô���⣿</div>",
	tUrl:"ajax.php?mod=misc&code=tag",
	tFormatItem:function(data) {
		return '<span id="'+data[0]+'_st_name">'+data[1]+'</span>';	
	},
	tResult:function(data) {
		return data[1];
  	},
	init:function(){
		this.repostStatusContentTextBox = $('#repostStatusTextBox');
		this.dmTextBox = $("#dmTextBox");
		this.topicAutocompleter = Autocompleter('__st_search_result__', this.tUrl, {formatItemCallback:this.tFormatItem,resultCallback:this.tResult,item_list_tips:this.itemListTips});
		
		var self = this;
		//��Ӽ����¼�
		this.statusContentTextBox.add(this.repostStatusContentTextBox)
		.add(this.dmTextBox).keyup(function(event){self.searchTopicInStatus(event);})		//��������ʱ#���ż��
		.keydown(self.topicAutocompleter.keydownListener)									//��������ʱ���¼�����
		.click(function(event){self.searchTopicInStatus(event);}).blur(function(event){
    		var contentTextBox = self.statusContentTextBox.get(0) == event.target  ? self.statusContentTextBox : (self.repostStatusContentTextBox.get(0) == event.target ? self.repostStatusContentTextBox : self.dmTextBox);
    		var lastEditIndex = contentTextBox.data('lastEditIndex');
			if (lastEditIndex != null) {
				//self.selectFirstTopicFromSearchResultList(contentTextBox,true);
				self.topicAutocompleter.hideItemList();
			}
  		});
	},
	insertTopic:function(stock, stockIndex, contentTextBox) {
		var startIndex = contentTextBox.getSelectionStart();
		var range = JSGST.API.Statuses.getEditTopicRange(startIndex, contentTextBox.val());
		contentTextBox.setSelection(range.start,range.end-range.start);
		contentTextBox.insertString(['#',$.trim(stock.name),'#'].join(''));
	},
	autoInsertTopic:function(event) {
		var contentTextBox = this.statusContentTextBox.get(0) == event.target  ? this.statusContentTextBox : (this.repostStatusContentTextBox.get(0) == event.target ? this.repostStatusContentTextBox : this.dmTextBox);
		var lastEditIndex = contentTextBox.data('lastEditIndex');
		if (lastEditIndex !== null) {
			var startIndex = contentTextBox.getSelectionStart();
			var range = JSGST.API.Statuses.getEditTopicRange(startIndex, contentTextBox.val());
			var lastRange = JSGST.API.Statuses.getEditTopicRange(lastEditIndex, contentTextBox.val());
		  	if ((range.start != lastRange.start && range.end != lastRange.end) || startIndex == lastRange.start || startIndex == lastRange.end) {
				//contentTextBox.setSelection(lastRange.start+1,lastRange.end - lastRange.start);
				//this.selectFirstTopicFromSearchResultList(contentTextBox,false);
				this.topicAutocompleter.hideItemList();
				return false;
				/*
				range = JSGST.API.Statuses.getEditTopicRange(lastRange.start+1, contentTextBox.val());
				var indexOffset = 0;
				if (startIndex <= lastRange.start) {
			  		indexOffset = startIndex;
				} else {
			  		indexOffset = startIndex + range.end - lastRange.end;
				} 
				contentTextBox.setSelection(indexOffset,0);
				*/
		  }
		}
  	},
	searchTopicInStatus:function(event) {
    	var contentTextBox = this.statusContentTextBox.get(0) == event.target  ? this.statusContentTextBox : (this.repostStatusContentTextBox.get(0) == event.target ? this.repostStatusContentTextBox : this.dmTextBox);
    	var lastEditIndex = contentTextBox.data('lastEditIndex');
		
		//��黺���еı���
		if (contentTextBox.data('lastEditIndex')) {
			this.autoInsertTopic(event);
		}
	
		contentTextBox.data('lastEditIndex',null);
	
		//��ȡ��ǰ����λ��,51��#�ŵ�KeyCode
		var startIndex = contentTextBox.getSelectionStart();
		if (event.type == 'keyup' && event.keyCode == 51 && contentTextBox.val().substr(startIndex-1, 1) === '#') {
			contentTextBox.insertString(this.defaultTopicText+'#');
			contentTextBox.setSelection(startIndex,this.defaultTopicText.length);
			return;
		}
		
		if (this.topicAutocompleter.itemList() && (event.keyCode == 38 || event.keyCode == 40 || event.keyCode == 13 || event.keyCode == 27)) {
			return;
		}
	
		//��ǰ#**#�ڵ��ַ���
		var topic = JSGST.API.Statuses.getEditTopic(startIndex, contentTextBox.val());
		
		//��#**#Ϊ�յ�ʱ������ز�ѯ�б�
		if (topic == '') {
			contentTextBox.data('lastEditIndex',null);
			this.topicAutocompleter.hideItemList();
			return;
		}
	
		//�������༭��λ��
		contentTextBox.data('lastEditIndex',startIndex);
	
		//��ѯ������
		this.topicAutocompleter.searchItems(topic, this.getCaretPos(contentTextBox, contentTextBox.val()), contentTextBox.attr("id"));
		
   		var self = this;
		this.topicAutocompleter.setSelectCallback(contentTextBox.attr("id"),function(topic){
			self.insertTopic(topic, startIndex, contentTextBox);
		});
	},
	getCaretPos:function(textbox, content) {
		var em = $("<em>&nbsp;</em>");
		var boxPos = textbox.offset();
		var cursorPos = {};
		if ($("#caret").length === 0) {
			caret = $("<pre></pre>").attr("id", 'caret').css({
			position: 'absolute',
			left: -9999,
			font: '12px/20px "Tahoma", Tahoma, Arial',
			width: textbox.width() + 'px',
			border: '1px',
			"word-wrap": "break-word"
		  });
		  caret.appendTo("body");
		}
		caret.html(content.substr(0, content.length-1)).append(em);
		cursorPos = em.position();
		var res =  {
			left: cursorPos.left + boxPos.left,
			top: cursorPos.top + boxPos.top + 20
		};
		return res;
	},
	insertTopicToStatus:function(event){
		var startIndex = -1;
		var contentTextBox = event.target.id =='addTopicToStatusButton' ? this.statusContentTextBox : ('addTopicToRepostButton' == event.target.id ? this.repostStatusContentTextBox : this.dmTextBox);
		startIndex = contentTextBox.val().indexOf('#'+this.defaultTopicText+'#');
		if (startIndex < 0) {
			startIndex = contentTextBox.getSelectionStart();
			contentTextBox.insertString('#'+this.defaultTopicText+'#');
		}
		contentTextBox.setSelection(startIndex + 1, this.defaultTopicText.length);
	},
	selectFirstTopicFromSearchResultList:function(contentTextBox,delay) {
		var self = this;
		var _insertTopic = function(){
			if (!self.topicAutocompleter.itemList().is(':hidden') && self.topicAutocompleter.itemList().find('ul li').length) {
				var startIndex = contentTextBox.getSelectionStart();
				self.topicAutocompleter.setSelectCallback(contentTextBox.attr("id"), function(stock){
					self.insertTopic(stock, startIndex, contentTextBox);
				});
				self.topicAutocompleter.itemList().find('li:first').click();
			}
		};
		if (delay) {
			setTimeout(_insertTopic,100);
		} else {
			_insertTopic();
		}
	}
};