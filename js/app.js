//App Cazu
var cazu = {
	init : function(){
		// Stores
		this.$window = $(window);
		this.header()
		
	},
	header : function(){
		var self = this,
			$header = $('header.main'),
			current = 0,
			prev = 0,
			up = false,
			floating = false,
			toggleFloating = function(){
				if(current > 50 && !floating){
					$header.addClass('floating');
					floating = true;
				}else if(current <= 50 && floating){
					$header.removeClass('floating');
					floating = false;
				}
			},
			toggleUp = function(){
				current = self.$window.scrollTop();
				if(!up && current > prev){
					$header.addClass('up');
					up = true;
				}else if(up && current < prev){
					$header.removeClass('up');
					up = false;
				}
				toggleFloating();
				prev = current;
			};		
		toggleUp();
		self.$window.scroll(function(){			
			toggleUp();
			console.log(current);
		});
		
		setTimeout(function(){
			$header.addClass('animated');
		},400);
		return this;
	}
	
}
$('document').ready(function(){cazu.init()});
