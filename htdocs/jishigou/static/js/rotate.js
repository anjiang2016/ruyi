//΢��ͼƬ�鿴���

(function($) {
	$.fn.artZoom = function() {
		$(this).live('click', function() {
			if ($(this).hasClass('artZoomAll')) {
				var aRevv = $(this).attr('rev');
				var parentId = 'image_area_' + aRevv;
				var tidv = (aRevv.substr(0, aRevv.indexOf('_')));

				// �������ۿ�
				if (($.trim(($('#reply_area_' + tidv).html()))).length < 1) {
					$('#topic_list_reply_' + tidv + '_aid').click();
				}

				// �Ŵ��ͼ
				if ($("#" + parentId + " a.artZoomAll").length > 1) {
					$("#" + parentId + " a.artZoomAll").each(function() {
						clickOne($(this), parentId);
					});
					return false;
				}
			}

			clickOne($(this));
			return false;
		});

		var clickOne = function(aObj, parentId) {
			var maxImg = $(aObj).attr('href'), viewImg = $(aObj).attr('rel').length === '0' ? $(
					this).attr('rel')
					: maxImg;

			if ($(aObj).find('.loading').length == 0) {
				$(aObj)
						.append(
								'<span class="loading" title="Loading..">Loading..</span>');
			}
			imgTool($(aObj), maxImg, viewImg, parentId);
		};

		var loadImg = function(url, fn) {
			var img = new Image();
			img.src = url;
			if (img.complete) {
				fn.call(img);
			} else {
				img.onload = function() {
					fn.call(img);
				};
			}
			;
		};

		var imgTool = function(on, maxImg, viewImg, parentId) {
			var width = 0, height = 0, tool = function() {
				on.find('.loading').remove();
				on.hide();

				var parentInnerWidth = on.parent().innerWidth();
				if (parentInnerWidth < 120) {
					parentInnerWidth = 460;
				}

				var maxWidth = parentInnerWidth - 12; // ��ȡ����Ԫ�ؿ��
				if (width > maxWidth) {
					height = maxWidth / width * height;
					width = maxWidth;
				}
				;

				// ��ʾҳ��ֹ�������С foxis
				if ($(on).hasClass('artZoom2')) {
					var html = '<div class="artZoomBox"><div class="tool"><a class="imgLeft" href="#" title="����ת">����ת</a><a class="imgRight" href="#" title="����ת">����ת</a><a class="viewImg" href="'
							+ viewImg
							+ '" title="�鿴ԭͼ">�鿴ԭͼ</a></div><a href="'
							+ viewImg
							+ '"> <img class="maxImg" width="'
							+ width
							+ '" height="'
							+ height
							+ '" src="'
							+ maxImg + '" /></a></div>';
				} else if ($(on).hasClass('artZoom3')) {
					var html = '<div class="artZoomBox"><div class="tool"><a class="imgLeft" href="#" title="����ת">����ת</a><a class="imgRight" href="#" title="����ת">����ת</a><a class="viewImg" href="'
							+ viewImg
							+ '" title="�鿴ԭͼ">�鿴ԭͼ</a></div><a rev="'
							+ aRevv
							+ '" href="'
							+ viewImg
							+ '" class="maxImgLink3"> <img class="maxImg" width="'
							+ width
							+ '" height="'
							+ height
							+ '" src="'
							+ maxImg + '" /></a></div>';
				} else if ($(on).hasClass('artZoomAll')) {
					var html = '<div class="artZoomBox"><div class="tool"><a class="imgLeft" href="#" title="����ת">����ת</a><a class="imgRight" href="#" title="����ת">����ת</a><a class="viewImg" href="'
							+ viewImg
							+ '" title="�鿴ԭͼ">�鿴ԭͼ</a></div><a href="'
							+ viewImg
							+ '" class="maxImgLinkAll"> <img class="maxImg" width="'
							+ width
							+ '" height="'
							+ height
							+ '" src="'
							+ maxImg + '" /></a></div>';
				} else {
					var html = '<div class="artZoomBox"><div class="tool"><a class="hideImg" href="#" title="����">����</a><a class="imgLeft" href="#" title="����ת">����ת</a><a class="imgRight" href="#" title="����ת">����ת</a><a class="viewImg" href="'
							+ viewImg
							+ '" title="�鿴ԭͼ">�鿴ԭͼ</a></div><a href="'
							+ viewImg
							+ '" class="maxImgLink"> <img class="maxImg" width="'
							+ width
							+ '" height="'
							+ height
							+ '" src="'
							+ maxImg + '" /></a></div>';
				}
				if (on.next('.artZoomBox').length < 1) {
					on.after(html);
				}

				var box = on.next('.artZoomBox');
				box.hover(function() {
					box.addClass('js_hover');
				}, function() {
					box.removeClass('js_hover');
				});

				box
						.find('a')
						.bind(
								'click',
								function() {
									// �����������
									if ($(this).hasClass('maxImgLink3')
											&& 'undefined' != typeof (aRevv)) {
										view_topic_content(aRevv, aSidv, aTPT_v);
									}
									;

									// ��������
									if ($(this).hasClass('maxImgLinkAll')) {
										if ($('#' + parentId + ' .artZoomBox').length > 1) {
											$('#' + parentId + ' .artZoomBox')
													.each(function() {
														$(this).hide();
														$(this).prev().show();
													});
											window.location.hash = parentId;
										} else {
											box.hide();
											box.prev().show();
										}
									}
									;

									// ����
									if ($(this).hasClass('hideImg')
											|| $(this).hasClass('maxImgLink')) {
										box.hide();
										box.prev().show();
									}
									;
									// ����ת
									if ($(this).hasClass('imgLeft')) {
										box.find('.maxImg').rotate('left');
									}
									;
									// ����ת
									if ($(this).hasClass('imgRight')) {
										box.find('.maxImg').rotate('right');
									}
									;
									// �´��ڴ�
									if ($(this).hasClass('viewImg'))
										window.open(viewImg);

									return false;
								});

				if (on.next('.artZoomBox').length != 0) {
					return on.next('.artZoomBox').show();
				}

			};

			loadImg(maxImg, function() {
				width = this.width;
				height = this.height;
				tool();
			});

			$.fn.rotate = function(p){

			    var img = $(this)[0],
			        n = img.getAttribute('step');
			    // ����ͼƬ��С����
			    if (!this.data('width') && !$(this).data('height')) {
			        this.data('width', img.width);
			        this.data('height', img.height);
			    };
			    var mw=img.getAttribute('maxWidth');
			    if(mw == null) mw = 0;
			    if(mw < 1) mw = img.width;
			    if(mw > 460) mw = 460;
			    this.data('maxWidth', mw);

			    if(n == null) n = 0;
			    if(p == 'left'){
			        (n == 0)? n = 3 : n--;
			    }else if(p == 'right'){
			        (n == 3) ? n = 0 : n++;
			    };
			    img.setAttribute('step', n);

			    // IE�����ʹ���˾���ת
			    if(document.all) {
			        if(this.data('height')>this.data('maxWidth') && (n==1 || n==3) ){
			            if(!this.data('zoomheight')){
			                this.data('zoomwidth',this.data('maxWidth'));
			                this.data('zoomheight',(this.data('maxWidth')/this.data('height'))*this.data('width'));
			            }
			            img.height = this.data('zoomwidth');
			            img.width  = this.data('zoomheight');			            
			        }else{
			            img.height = this.data('height');
			            img.width  = this.data('width');
			        }
			        
			        img.style.filter = 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ n +')';
			        // IE8�߶�����
			        if ($.browser.version == 8) {
			            switch(n){
			                case 0:
			                    this.parent().height('');
			                    //this.height(this.data('height'));
			                    break;
			                case 1:
			                    this.parent().height(this.data('width') + 10);
			                    //this.height(this.data('width'));
			                    break;
			                case 2:
			                    this.parent().height('');
			                    //this.height(this.data('height'));
			                    break;
			                case 3:
			                    this.parent().height(this.data('width') + 10);
			                    //this.height(this.data('width'));
			                    break;
			            };
			        };
			    // ���ִ������д��HTML5��Ԫ�ؽ�����ת�� canvas
			    }else{
			        var c = this.next('canvas')[0];
			        if(this.next('canvas').length == 0){
			            this.css({'visibility': 'hidden', 'position': 'absolute'});
			            c = document.createElement('canvas');
			            c.setAttribute('class', 'maxImg canvas');
			            img.parentNode.appendChild(c);
			        }
			        var canvasContext = c.getContext('2d');
			        switch(n) {
			            default :
			            case 0 :
			                img.setAttribute('height',this.data('height'));
			                img.setAttribute('width',this.data('width'));
			                c.setAttribute('width', img.width);
			                c.setAttribute('height', img.height);
			                canvasContext.rotate(0 * Math.PI / 180);
			                canvasContext.drawImage(img, 0, 0, img.width, img.height);
			                break;
			            case 1 :
			                if(img.height>this.data('maxWidth') ){
			                    h = this.data('maxWidth');
			                    w = (this.data('maxWidth')/img.height)*img.width;
			                }else{
			                    h = this.data('height');
			                    w = this.data('width');
			                }
			                c.setAttribute('width', h);
			                c.setAttribute('height', w);
			                canvasContext.rotate(90 * Math.PI / 180);
			                canvasContext.drawImage(img, 0, -h, w ,h );
			                break;
			            case 2 :
			                img.setAttribute('height',this.data('height'));
			                img.setAttribute('width',this.data('width'));
			                c.setAttribute('width', img.width);
			                c.setAttribute('height', img.height);
			                canvasContext.rotate(180 * Math.PI / 180);
			                canvasContext.drawImage(img, -img.width, -img.height, img.width, img.height);
			                break;
			            case 3 :
			                if(img.height>this.data('maxWidth') ){
			                    h = this.data('maxWidth');
			                    w = (this.data('maxWidth')/img.height)*img.width;
			                }else{
			                    h = this.data('height');
			                    w = this.data('width');
			                }
			                c.setAttribute('width', h);
			                c.setAttribute('height', w);
			                canvasContext.rotate(270 * Math.PI / 180);
			                canvasContext.drawImage(img, -w, 0,w,h);
			                break;
			        };
			    };
			};			
		};
	};

	// $('a.artZoom').artZoom();
	$('a.artZoom').live('click', function() {
		var relv = $(this).attr('rel');
		var revv = $(this).attr('rev');
		var TPT_v = $(this).attr('TPT_');

		view_topic_content(relv, revv, TPT_v);

		return false;
	});

	// artZoom2 ������ʾҳ���б�ҳ
	$('a.artZoom2').artZoom();

	$('a.artZoom3').artZoom();

	// ���ʱ��ͬʱ�Ŵ���С�����ڵĶ���ͼƬ
	$('a.artZoomAll').artZoom();

})(jQuery);