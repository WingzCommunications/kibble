(function($) {

	$.fn.nicheup = function(options) {

		var options = $.extend({}, $.fn.nicheup.defaults, options);

		this.each(function() {

			var o = $.metadata ? $.extend({}, options, $(this).metadata()) : options;
			var $box = $(this);
			var $content = $box.children(':first');
			var $caption = $box.children(':last');

			if ($box.css('position') == 'static') {
				$box.css('position', 'relative');
			}

			$box.css('overflow', 'hidden');

			if ($content.css('display') == 'inline') {
				$content.css('display', 'block');
			}

			$caption.css({
				position: 'absolute',
				left: 0,
				right: 0,
				margin: 0
			});

			var captionHeight = $caption.outerHeight();

			$caption.css(o.position, -captionHeight);

			if (o.fade) {
				$caption.css('opacity', 0);
			}

			$box.css('height', $box.height());

			var captionIn = {};
			captionIn[o.position] = 0;
			captionIn.opacity = 1;

			var contentIn = {};
			contentIn.marginTop = (o.shiftContent == 'push') ? captionHeight : Number(o.shiftContent);
			if (o.position == 'bottom') {
				contentIn.marginTop = -contentIn.marginTop;
			}

			var animateIn = function() {
				$caption.stop(true).animate(captionIn, o.speedIn, o.easingIn);

				if (o.shiftContent) {
					$content.stop(true).animate(contentIn, o.speedIn, o.easingIn);
				}
			};

			var captionOut = {};
			captionOut[o.position] = -captionHeight;
			captionOut.opacity = Number( ! o.fade);

			var contentOut = { marginTop: 0 };

			var animateOut = function() {
				$caption.stop(true).animate(captionOut, o.speedOut, o.easingOut);

				if (o.shiftContent) {
					$content.stop(true).animate(contentOut, o.speedOut, o.easingOut);
				}
			};

			if (o.reverse) {
				$caption.css(captionIn);
				$content.css(contentIn);
				$box.hover(animateOut, animateIn);
			} else {
				$box.hover(animateIn, animateOut);
			}
		});

		return this;
	};

	$.fn.nicheup.defaults = {
		easingIn:     'swing',
		easingOut:    'swing',
		fade:         true,
		position:     'bottom', 
		reverse:      false,
		shiftContent: false, 
		speedIn:      'fast',
		speedOut:     'normal'
	};

})(jQuery);

jQuery(document).ready(function($) {
	$('.spot').nicheup();
});
