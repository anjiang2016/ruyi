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
    if (code === '') {
      return;
    }
	
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
        this[0] = this[0].replace('��','(').replace('��',')');
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
		  if (this[1].substr(0, len).toUpperCase() == code.toUpperCase() || $.trim(this[0]).substr(0,len) == code || $.trim(this[2]).substr(0,len).toUpperCase() == code.toUpperCase() || $.trim(this[3]).substr(0,len) == code) {
			ret.push(this);
		  } 
								
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
	  	o.html('<span>'+this[0]+'</span>');
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
