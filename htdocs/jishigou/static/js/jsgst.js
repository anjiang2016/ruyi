/**
 * ���¹�΢��
 * 
 * @author 		~ZZ~
 * @package 	jishigou.net
 * @category	JSGST
 * @version $Id$
 */

(function($){
  if (typeof JSGST == 'undefined') {
    JSGST = {};
  }
  
  if (typeof JSGST.API_URL == 'undefined') {
    JSGST.API_URL = {
		'topic.search':'ajax.php?mod=misc&code=tag',
		'at.search':'ajax.php?mod=misc&code=atuser'
	};
  }

  /**
   * ��չFunction���ܣ��������Ե���api����ʵ��api�ӿ�
   * 
   * @example function(){}.api('/account/contains');
   */ 
  $.extend(Function.prototype,{
	_isApi: false,
    _apiUrl: null,
    _apiFormat: 'json',
    _apiParams : null,
    
    getApiUrl: function(params) {
      var url = this._apiUrl;
	  
      // ���Ҳ��滻URL�еĲ���
      var matches = null;
      var regex = /\{([^}]+)\}/i;
      while (matches = regex.exec(url)) {
        if (!params || !params[matches[1]]) {
          throw 'ȱ�ٵ��ò���';
        }
        url = url.replace(matches[0], params[matches[1]]);
      }
      return url;
    },
    
    /**
     * ���ô˷�����ʵ��API�ӿ�
     */
    api: function(url,params,format) {
      var ext = format;
      
      this._isApi = true;
      this._apiUrl = url;
      this._apiParams = params;
      if (typeof format == 'string') {
        this._apiFormat = format;
        ext = arguments.length > 3 ? arguments[3] : null;
      }
      if (ext) {
        $.extend(this,ext);
      }
      return this;
    },
    
    /**
     * API�첽����
     */
    request: function(method,params,callback,fail,url) {
      if (!this._isApi) {
        throw '�ú���û��ʵ��API�ӿ�';
      }
      var self = this;
      var data = null;
      var paramKey;
      var required;
      var defaultValue;
      
      if (this._apiParams) {
        data = {};
        for (var i = 0; i < this._apiParams.length; i++) {
          required = false;
          defaultValue = null;
        
          if ($.isPlainObject(this._apiParams[i])) {
            paramKey = this._apiParams[i].key;
            required = typeof this._apiParams[i].required == 'boolean' ? this._apiParams[i].required : !!this._apiParams[i].required;
            defaultValue = typeof this._apiParams[i].defaultValue == 'undefined' ? null : this._apiParams[i].defaultValue;
          } else {
            paramKey = this._apiParams[i];
          }

          if (!params || typeof params[paramKey] === 'undefined' || params[paramKey] === null) {
            if (required) {
              throw '����API(' + this._apiUrl + ')ʱȱ�ٲ�����'+paramKey;
            } else if (defaultValue) {
              if (!params) {
                params = {};
              }
              params[paramKey] = defaultValue;
            }
          } 
          if (params && params[paramKey] !== undefined) {
            data[paramKey] = params[paramKey];
          }
        }
      }
      url = url ? url : this.getApiUrl(params);
      $.ajax({
        url:   url,
        type:  method,
        data:  data,
        dataType: this._apiFormat,
        async: true,
        cache: false,
        
        success: function() {
          var args = $(arguments).toArray();
          var ret = self.apply(self,args);
          args.unshift(ret);
          if (callback) {
            callback.apply(self, args);
          }
        },
        
        error: function(ret) {
          if (fail) {
            fail.apply(self,arguments);
            return;
          }
          
          var args = $(arguments).toArray();
          args.unshift(null);
          callback.apply(self, args);
        }
      });
    },
    
    /**
     * ͨ��GET����API
     */
    get: function(url, params,callback,fail) {
      if ($.isPlainObject(url)) {
        fail = callback;
        callback = params;
        params = url;
        url = null;
      } else if ($.isFunction(url)) {
        fail = params;
        callback = url;
        params = null;
        url = null;
      } else if ($.isFunction(params)) {
        fail = callback;
        callback = params;
        params = null;
      }
      this.request('GET', params, callback, fail, url);
    },
    
    /**
     * ͨ��POST����API
     */
    post: function(url, params, callback, fail) {
      if ($.isPlainObject(url)) {
        fail = callback;
        callback = params;
        params = url;
        url = null;
      } else if ($.isFunction(url)) {
        fail = params;
        callback = url;
        params = null;
        url = null;
      } else if ($.isFunction(params)) {
        fail = callback;
        callback = params;
        params = null;
      }
      this.request('POST', params, callback, fail, url);
    }
  });

  JSGST.parseJSON = function(json) {
    if (typeof json == 'string') {
      try {
        json = $.parseJSON(json);
      } catch (e) {
        json = null;
      }
    }
    
    return json;
  };

  JSGST.API = {};

  /**
   * ����API
   * 
   * @package JSGST.Topic
   */
  JSGST.API.Topic = {
      
    /**
     * ��ѯ���⣬�Է���ֵ���д���
     * 
     * @param String fchar
     * @result Object
     */
    search: function(result) {
      result = $.trim(result);
      if (result === '') {
        return null;
      }
      
      var data = [];
      var rows = result.split("\n");
      var row;
      for (var i = 0; i < rows.length; i++) {
        if ($.trim(rows[i]) === '') {
          continue;
        }
		//��::�ָ�
        row = rows[i].split('|');
        if (!row || row.length === 0) {
          continue;
        }
        data[data.length] = row;
      }
      return data;
    }.api(JSGST.API_URL['topic.search'],['q'],'text')
  };

  /**
   * ΢��API
   * 
   * @package JSGST.Statuses
   */
  JSGST.API.Statuses = {
	  
	searchAt: function(result) {
      result = $.trim(result);
      if (result === '') {
        return null;
      }
      
      var data = [];
      var rows = result.split("\n");
      var row;
      for (var i = 0; i < rows.length; i++) {
        if ($.trim(rows[i]) === '') {
          continue;
        }
		//��::�ָ�
        row = rows[i].split('|');
        if (!row || row.length === 0) {
          continue;
        }
        data[data.length] = row;
      }
      return data;
    }.api(JSGST.API_URL['at.search'],['q'],'text'),
	
	 //��ȡ�������λ�õĻ���(##��)
    getEditTopic: function(startIndex, content) {
		//�ҳ�΢���е����л���
		var topics = JSGST.API.Statuses.findTopics(content);
		var topic = '';
		for (var i = 0; i < topics.length; i++) {
			var len = topics[i].length;
			var start = content.replace(/[\r\n]/ig,' ').indexOf(topics[i]);
			if (startIndex > start && startIndex < (start+len)) {
				topic = topics[i];
				break;
			}
		}
		topic = topic.replace(/#/ig,'');
		return topic;
    },
    getEditTopicRange: function(startIndex, content){
		var topics = JSGST.API.Statuses.findTopics(content);
		var range = {start:0,end:0};
		for (var i = 0; i < topics.length; i++) {
			var len = topics[i].length;
			var start = content.indexOf(topics[i]);
			if (startIndex >= start && startIndex <= (start+len)){
				range.start = start;
				range.end = start+len;
				break;
			}
		}
		return range;
    },

	//��΢�������е�����##֮����ַ�������������
    findTopics:function(content) {
		var topics = [];
		var reg = /#[^#]+#/ig;
		var result;
		while (result = reg.exec(content)){
			topics.push(result[0]);
		}
		return topics;
    }
  };

  $.extend($.fn,{
	//��ȡ�ı����ڹ��λ��
    getSelectionStart: function() {
      var e = this[0];
      if (e.selectionStart) {
        return e.selectionStart;
      } else if (document.selection) {
        e.focus();
        var r=document.selection.createRange();
        var sr = r.duplicate();
        sr.moveToElementText(e);
        sr.setEndPoint('EndToEnd', r);
        return sr.text.length - r.text.length;
      }
      
      return 0;
    },
    getSelectionEnd: function() {
      var e = this[0];
      if (e.selectionEnd) {
        return e.selectionEnd;
      } else if (document.selection) {
        e.focus();
        var r=document.selection.createRange();
        var sr = r.duplicate();
        sr.moveToElementText(e);
        sr.setEndPoint('EndToEnd', r);
        return sr.text.length;
      }
      
      return 0;
    },
	
	//�Զ�����Ĭ���ַ���
    insertString: function(str) {
      $(this).each(function() {
          var tb = $(this);
          tb.focus();
          if (document.selection){
              var r = document.selection.createRange();
              document.selection.empty();
              r.text = str;
              r.collapse();
              r.select();
          } else {
              var newstart = tb.get(0).selectionStart+str.length;
              tb.val(tb.val().substr(0,tb.get(0).selectionStart) + 
          str + tb.val().substring(tb.get(0).selectionEnd));
              tb.get(0).selectionStart = newstart;
              tb.get(0).selectionEnd = newstart;
          }
      });
      
      return this;
    },
    setSelection: function(startIndex,len) {
      $(this).each(function(){
        if (this.setSelectionRange){
          this.setSelectionRange(startIndex, startIndex + len);  
        } else if (document.selection) {
          var range = this.createTextRange();  
          range.collapse(true);  
          range.moveStart('character', startIndex);  
          range.moveEnd('character', len);  
          range.select();
        } else {
          this.selectionStart = startIndex;
          this.selectionEnd = startIndex + len;
        }
      });
      
      return this;
    },
    getSelection: function() {
      var elem = this[0];
    
        var sel = '';
        if (document.selection){
            var r = document.selection.createRange();
            document.selection.empty();
            sel = r.text;
        } else {
            var start = elem.selectionStart;
            var end = elem.selectionEnd;
        var content = $(elem).is(':input') ? $(elem).val() : $(elem).text();
            sel = content.substring(start, end);
        }
        return sel;
    }
  });
})(jQuery);


/**
 * ΢��������Զ���ʾ
 * 
 * @author 		~ZZ~
 * @package 	jishigou.net
 * @category	Publish
 * @version $Id$
 */
var __JSGST_AUTO_CACHE__ = new Array();
function JSGST_Autocompleter() 
{
   var jsgst_auto = new Object();
   jsgst_auto.item_list_tips = '';
   jsgst_auto.handle_key = '_searchResult_';
   jsgst_auto.key =  0;
   jsgst_auto.selectCallback = function() {};
   jsgst_auto.filterSearchResultCallback = null;
   jsgst_auto.formatItemCallback = null;
   jsgst_auto.setItemIdCallback = null;
   jsgst_auto.resultCallback = null;
   jsgst_auto.url = '';

   jsgst_auto._selectCallback =  function(event) {
	   var option = jsgst_auto.itemList().find('li.active');
	   if (jsgst_auto.resultCallback != null) {
		   	jsgst_auto.itemList().hide();
		    var name = jsgst_auto.resultCallback(__JSGST_AUTO_CACHE__[option.attr('id')]);
			var item_name = {code:option.attr('id'),name:name};
			jsgst_auto.selectCallback[jsgst_auto.focusingElement](item_name);
	   }
  };
  
   jsgst_auto.itemList =  function() {
      if ($('#'+jsgst_auto.handle_key).length > 0) {
      	return $('#'+jsgst_auto.handle_key);
      }
	  //<div>����@�ᵽ˭��</div>
      var list = $('<div>').addClass('quicksearchbar').attr('id',jsgst_auto.handle_key).hide().html(
        jsgst_auto.item_list_tips+'<ul class="stocks">' +
        '</ul>'
        ).appendTo(document.body);
      list.find('.min_btn').click(function(){
        list.hide();
      });
      return list;
  };
  
   	jsgst_auto.searchItems = function(code,pos, el_id) {
    jsgst_auto.focusingElement = el_id;
    jsgst_auto.itemList().hide().find('ul').empty();

	//��ȡ��ѯ�ַ����ĵ�һ���ַ�
    var firstChar = code;//.substr(0,1);
	
	//�������Ƿ���ڵ�һ���ַ�
    if (jsgst_auto.itemList().data(firstChar)) {

      var filterResult = jsgst_auto.filterSearchResult(jsgst_auto.itemList().data(firstChar), code);
	  
	  //���˽���������ھ�����
      if (filterResult.length === 0) {
        jsgst_auto.itemList().hide();
        return;
      }
	  //���õ�ǰѡ����
      jsgst_auto.setSearchResult(filterResult);
      jsgst_auto.itemList().css('left', pos.left).css('top', pos.top).show();
      return;
    }
	
    jsgst_auto.searchingCode = code;
	
	//��ѯ�ַ������ַ�
    if (jsgst_auto.searchingChar && jsgst_auto.searchingChar === firstChar) {
      return;
    } else {
      jsgst_auto.searchingChar = firstChar;
    }
	
    jsgst_auto.searchingCode = code;
    
	var ret = null;
	$.get(jsgst_auto.url, {"q":jsgst_auto.searchingCode}, function(result){
	  result = $.trim(result);
      if (result === '') {
        jsgst_auto.itemList().css('left', pos.left).css('top', pos.top).show();
        return null;
      }

      var data = [];
      var rows = result.split("\n");
      var row;
      for (var i = 0; i < rows.length; i++) {
        if ($.trim(rows[i]) === '') {
          continue;
        }
		//��::�ָ�
        row = rows[i].split('|');
        if (!row || row.length === 0) {
          continue;
        }
        data[data.length] = row;
      }
	  ret = data;
      jsgst_auto.itemList().find('ul').empty();
      if (!ret || ret.length === 0) {
        jsgst_auto.itemList().hide();
        return;
      }
	  
      $(ret).map(function(){
        //this[0] = this[0].replace('��','(').replace('��',')');
        return this;
      });
	  
	  //����ѯ�������
      jsgst_auto.itemList().data(firstChar, ret);
	  
	  //��ѯ�������
	  var filterResult = jsgst_auto.filterSearchResult(ret, jsgst_auto.searchingCode);
	  jsgst_auto.setSearchResult(filterResult);
	  if (filterResult && filterResult.length > 0) {
      	jsgst_auto.itemList().css('left', pos.left).css('top', pos.top).show();
      }						   
	});
  };
  
  //�Է��ؽ�����д���
   jsgst_auto.filterSearchResult =  function (result, code) {
	 if (jsgst_auto.filterSearchResultCallback == null) {
		var ret = [];
		var len = code.length;

		$(result).each(function(){
		  //if (this[1].substr(0, len).toUpperCase() == code.toUpperCase() || $.trim(this[0]).substr(0,len) == code || $.trim(this[2]).substr(0,len).toUpperCase() == code.toUpperCase() || $.trim(this[3]).substr(0,len) == code) {
			ret.push(this);
		  //} 
								
		});
	
		return ret;
	  } else {
	  	jsgst_auto.filterSearchResultCallback(result, code);
	  }
  };
  
  //�ƶ�ѡ��
   jsgst_auto.moveSelectedItem = function(index) {
	   var list = jsgst_auto.itemList().find("li");
	   var activeLi = 0;
	   for (i=0;i<list.length;++i) {
		   if ($(list[i]).attr("class") == 'active') {
			   activeLi = i;
		   }
	   }
	   if (jsgst_auto.key) {
		   activeLi += index;
		   if (activeLi >= jsgst_auto.key || activeLi < 0) {
			   activeLi -= index;
		   }
		}
    	list.css({ 'background-color':'', 'color':'' }).removeClass('active');
    	$(list[activeLi]).addClass('active');
  };

  //����ѡ����
  jsgst_auto.setSearchResult = function (result) {
    result = result.slice(0,10);
    var list = jsgst_auto.itemList().find('ul');
    jsgst_auto.key = 0;
    $(result).each(function(i){
	  __JSGST_AUTO_CACHE__[jsgst_auto.handle_key+i+'__'] = this;
      var o = $('<li>').attr('id',jsgst_auto.handle_key+i+'__');
	  
	  //������ʾ��ʽ
	  if (jsgst_auto.formatItemCallback != null) {
	  	o.html(jsgst_auto.formatItemCallback(this));
	  } else {
	  	o.html('<img onerror="javascript:faceError(this);" src="'+this[2]+'"><span>'+this[0]+'</span>');
	  }
	  
	  //ѡ����ʽ
	  o.mouseover(
        function(event){
          jsgst_auto.itemList().find('li').removeClass('active');
          o.addClass('active');
        }
      ).click(function(event){
          jsgst_auto._selectCallback(event);
      });
	  
      if (jsgst_auto.key === 0){
          o.addClass('active');
      }
      list.append(o);
      jsgst_auto.key ++;
    });
  };

  //��갴���¼�����
   jsgst_auto.keydownListener = function(event) {
    if (jsgst_auto.itemList() && jsgst_auto.key) {
      switch (event.keyCode) {
        case 27:
        case 32:
            jsgst_auto.hideItemList();
            break;
        case 38:			//����up��
            if (jsgst_auto.itemList().is(":visible")) {
              event.preventDefault();
            }
            jsgst_auto.moveSelectedItem(-1);
            break;
        case 40:			//����down��
            if (jsgst_auto.itemList().is(":visible")) {
              event.preventDefault();
            }
            jsgst_auto.moveSelectedItem(1);
            break;
        case 13:			//���»س���
            if (jsgst_auto.itemList().is(":visible")) {
              event.preventDefault();
              jsgst_auto._selectCallback(event);
            }
            break;
      }
    }
  };

  jsgst_auto.setSelectCallback = function(el_name, func) {
    jsgst_auto.selectCallback[el_name] = func;
  };

   jsgst_auto.showItemList = function() {
    clearTimeout(jsgst_auto.hideItemListTimer);
    jsgst_auto.itemList().show();
  };
  
  //���ز�ѯ�б�
 jsgst_auto.hideItemList = function() {
    jsgst_auto.hideItemListTimer = setTimeout(function(){jsgst_auto.itemList().hide();},300);
  };
  return jsgst_auto;
 }



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
	itemListTips:"<div class='list_tips'>ѡ���ֱ�������ǳ�</div>",
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
//		  .blur(function(event){
//                var lastEditIndex = self.statusContentTextBox.data('atLastEditIndex');
//                if (lastEditIndex != null) {
//                    self.selectFirstAtFromSearchResultList(self.statusContentTextBox,true);
//                }
//		  });
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
		//�ų�shift����ʱ����keyup�¼�
		if(event.which == 16) {
			return ;
		}
		if (event.type == 'keyup' && ('undefined'==typeof(event.keyCode) || event.keyCode == 50) && contentTextBox.val().substr(startIndex-1, 1) === '@') {
			this.atAutocompleter.searchItems("", this.getAtCaretPos(contentTextBox, contentTextBox.val()), contentTextBox.attr("id"));
			var self = this;
			this.atAutocompleter.setSelectCallback(contentTextBox.attr("id"),function(atuser){
				self.insertAt(atuser, startIndex, contentTextBox);
				//contentTextBox.data('atLastEditIndex', null);
			});
			contentTextBox.data('atLastEditIndex',startIndex);
			return ;
		}
		
		if(contentTextBox.val().substr(startIndex-1, 1) === ' '){
			this.atAutocompleter.hideItemList();
			return ;
		}
		
		if (contentTextBox.data('atLastEditIndex')) {
			var lastEditIndex = contentTextBox.data('atLastEditIndex');
			var content = contentTextBox.val().toString(); 
			if(content.substr(lastEditIndex-1, 1) != '@'){
				this.atAutocompleter.hideItemList();
				return ;
			}
			//Modify the prompt  Edit by Ma 
			if(content.substr(lastEditIndex,startIndex - lastEditIndex).indexOf(' ')>0){
				this.atAutocompleter.hideItemList();
				return ;
			}
			
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
		if ($("#caret").length === 0) {
			caret = $("<span></span>").attr("id", 'caret').css({
			position: 'absolute',
			left: -9999,
			"font-size": "12px",
			"font-family": 'Arial ,"����"',
			width: textbox.width() + 'px',
			border: '1px',
			"word-wrap": "break-word",
			"word-break": "normal",
			"word-break": "break-all"
		  });
		  caret.appendTo("body");
		}
		var startIndex = textbox.getSelectionStart();//content.length-1
		caret.html(content.substr(0, startIndex)).append(em);
		cursorPos = em.position();
//		if(cursorPos.left > textbox.width()){
//			var careLeft = cursorPos.left % (textbox.width()-10);
//		} else {
//			var careLeft = cursorPos.left;
//		}
//		var res =  {
//		  left: careLeft + boxPos.left,
//		  top: textbox.height() + boxPos.top
//		};

		var res =  {
		  left: cursorPos.left + boxPos.left,
		  top: cursorPos.top + boxPos.top + 17
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
			caret = $("<span></span>").attr("id", 'caret').css({
			position: 'absolute',
			left: -9999,
			"font-size": "12px",
			"font-family": 'Arial ,"����"',
			width: textbox.width() + 'px',
			border: '1px',
			"word-wrap": "break-word",
			"word-break": "normal",
			"word-break": "break-all"
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