/*ͼƬ�ȱ����Ų��*/

(function ($) {
		// ����Ƿ�֧��css2.1 max-width����
	var isMaxWidth = 'maxWidth' in document.documentElement.style,
		// ����Ƿ�IE7�����
		isIE7 = !-[1,] && !('prototype' in Image) && isMaxWidth;
	
	$.fn.imgAuto = function () {
		var maxWidth = this.width();
		
		return this.find('img').each(function (i, img) {
			// ���֧��max-width������ʹ�ôˣ�����ʹ�����淽ʽ
			if (isMaxWidth) return img.style.maxWidth = maxWidth + 'px';
			var src = img.src;
			
			// ����ԭͼ
			img.style.display = 'none';
			img.removeAttribute('src');
			
			// ��ȡͼƬͷ�ߴ����ݺ���������ͼƬ
			imgReady(src, function (width, height) {
				// �ȱ�����С
				if (width > maxWidth) {
					height = maxWidth / width * height,
					width = maxWidth;
					img.style.width = width + 'px';
					img.style.height = height + 'px';
				};
				// ��ʾԭͼ
				img.style.display = '';
				img.setAttribute('src', src);
			});
			
		});
	};
	
	// IE7����ͼƬ��ʧ�棬����˽������ͨ�����β�ֵ���
	isIE7 && (function (c,d,s) {s=d.createElement('style');d.getElementsByTagName('head')[0].appendChild(s);s.styleSheet&&(s.styleSheet.cssText+=c)||s.appendChild(d.createTextNode(c))})('img {-ms-interpolation-mode:bicubic}',document);

	/**
	 * ͼƬͷ���ݼ��ؾ����¼�
	 * @param	{String}	ͼƬ·��
	 * @param	{Function}	�ߴ���� (����1����width; ����2����height)
	 * @param	{Function}	������� (��ѡ. ����1����width; ����2����height)
	 * @param	{Function}	���ش��� (��ѡ)
	 */
	var imgReady = (function () {
		var list = [], intervalId = null,

		// ����ִ�ж���
		tick = function () {
			var i = 0;
			for (; i < list.length; i++) {
				list[i].end ? list.splice(i--, 1) : list[i]();
			};
			!list.length && stop();
		},

		// ֹͣ���ж�ʱ������
		stop = function () {
			clearInterval(intervalId);
			intervalId = null;
		};

		return function (url, ready, load, error) {
			var check, width, height, newWidth, newHeight,
				img = new Image();
			
			img.src = url;

			// ���ͼƬ�����棬��ֱ�ӷ��ػ�������
			if (img.complete) {
				ready(img.width, img.height);
				load && load(img.width, img.height);
				return;
			};
			
			// ���ͼƬ��С�ĸı�
			width = img.width;
			height = img.height;
			check = function () {
				newWidth = img.width;
				newHeight = img.height;
				if (newWidth !== width || newHeight !== height ||
					// ���ͼƬ�Ѿ��������ط����ؿ�ʹ��������
					newWidth * newHeight > 1024
				) {
					ready(newWidth, newHeight);
					check.end = true;
				};
			};
			check();
			
			// ���ش������¼�
			img.onerror = function () {
				error && error();
				check.end = true;
				img = img.onload = img.onerror = null;
			};
			
			// ��ȫ������ϵ��¼�
			img.onload = function () {
				load && load(img.width, img.height);
				!check.end && check();
				// IE gif������ѭ��ִ��onload���ÿ�onload����
				img = img.onload = img.onerror = null;
			};

			// ��������ж���ִ��
			if (!check.end) {
				list.push(check);
				// ���ۺ�ʱֻ�������һ����ʱ��������������������
				if (intervalId === null) intervalId = setInterval(tick, 40);
			};
		};
	})();

})(jQuery);