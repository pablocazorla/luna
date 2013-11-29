//App Cazu
var cazu = function(){	
	
	var 
	/* Stores *********************************************/
	$window = $(window),
	$body = $('body'),
	$header = $('header.main'),
		
	/* Functions *********************************************/
	// Header
	header = function(){
		// variables
		var current = 0,
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
				current = $window.scrollTop();
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
			
		// exec
		toggleUp();
		$window.scroll(function(){			
			toggleUp();
		});		
		setTimeout(function(){
			$header.addClass('animated');
		},400);
	},
	// Portfolio
	portfolio = function(){
		try{cazuGrid('#gallery');}catch(e){}
		
	},
	// Portfolio Work
	portfolioWork = function(){
		var $modal = $('#modal-portfolio'),
			$modalContent = $('#modal-portfolio-content').css('min-height',$window.height()-140),
			$work = $('#work'),
			$dimmer = $modal.find('.dimmer').css('bottom','auto'),
			$close = $modal.find('.close'),
			$closebutton = $modal.find('.closebutton'),
			$loading = $modal.find('.loading'),
			
			adjustDimmerTimer = null,
			adjustDimmer = function(){
				$dimmer.height($modalContent.outerHeight());
			},			
			showWork = function(pid,urlPost){
				$body.addClass('pin');				
				$modalContent.css('min-height',$window.height()-140)
				$modal.fadeIn(400,function(){
					$.ajax({
						url : 'http://'+server+'/singleportfolio/',
						data : {id:pid,urlpost:urlPost},
						type : 'POST',
						success : function(html){
							$loading.hide();
							$work.html(html).fadeIn(200,function(){$closebutton.show();});
							$modal.scrollTop(0);							
						},
						error : function(){
							// On error, redirect to urlPost
							//window.location.href = urlPost;						
						},
						complete : function(){
							//self.preHighlight().validateForm();
	
							$.getScript('//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4d9270a3495656e9',function(){
								addthis.toolbox(".addthis_toolbox");
							});
						}				
					});
				}).scrollTop(0);				
				
				
				adjustDimmer();
				adjustDimmerTimer = setInterval(adjustDimmer,500);
			},
			hideWork = function(){
				clearInterval(adjustDimmerTimer);
				
				$modal.fadeOut(300,function(){
					$work.hide().html('');
					$closebutton.hide();
					$loading.show();
					$body.removeClass('pin');
				});	
			};
			
			
			// Events		 
	    $('.open-work').click(function(event){    	
	    	var ev = event || window.event;
	    	ev.preventDefault();        
	        showWork($(this).attr('rel'),$(this).attr('href'));        
	        return false;
	    });
	    $close.click(function(event){    	
	    	var ev = event || window.event;
	    	ev.preventDefault();        
	        hideWork();     
	        return false;
	    });
	}
	
	
		
	/* Execution *********************************************/
	// Commons
	$.ajaxSetup({cache:false});
	header();
	
	// Portfolio List
	if(pageID == 'portfolio-list'){
		portfolio();
		portfolioWork();		
	}
	// Blog
	if(pageID == 'blog-list' || pageID == 'blog-post' || pageID == 'search-list'){
		$('#s').val('').attr('placeholder','Search');
	}
	
	
	
	$(document).on("contextmenu", "img", function(e){
	    e.preventDefault();
	    //code
	    alert('No No');
	    return false;
	}); 
}


$('document').ready(function(){cazu()});


