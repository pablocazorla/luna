/* Bubble Plugin
 * @author: Pablo Cazorla
 * @e-mail: contact@pcazorla.com
 * @date: 09/23/2013
 */
(function($){
  $.fn.Bubble = function(options){
		var setting = $.extend({
      		attr : 'rel',
      		offsetTop : 0,
      		distanceY : 10,
      		duration : 250
		}, options);	
		return this.each(function(){			
			var $this = $(this).css('position','relative').attr('title',''),				
				posYshow = $this.height() + setting.offsetTop,
				posYhide = posYshow + setting.distanceY,				
				$bubble = $('<div class="bubble-banner"><span></span></div>').css('bottom',posYhide+'px'),				
				showing = false,
				showed = false,
				hover = false,		
				showBubble = function(){
					hover = true;
					if(!showing && !showed){
						showing = true;
						$bubble.css('display','block').animate({
							'bottom' : posYshow + 'px',
							'opacity':'1'
						},setting.duration,function(){
							showing = false;
							showed = true;
							if(!hover){hideBubble();}
						});
					}
				},
				hideBubble = function(){
					hover = false;
					if(!showing && showed){
						showing = true;
						$bubble.animate({
							'bottom' : posYhide + 'px',
							'opacity':'0'
						},setting.duration,function(){
							$bubble.css('display','none');
							showing = false;
							showed = false;
						});
					}
				};
			$bubble.append($this.attr(setting.attr));
			$this.append($bubble).hover(showBubble,hideBubble);			
		});
	};
})(jQuery);