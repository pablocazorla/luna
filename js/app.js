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
			}		
			
		// exec
		toggleUp();
		$window.scroll(function(){			
			toggleUp();
		});		
		setTimeout(function(){
			$header.addClass('animated');
		},400);
	},
	
	menuResponsive = function(){
		var openMenu = false,
		close = function(){
			$header.removeClass('open-menu');
			openMenu = false;
		};
		$('.responsive-menu-trigger').click(function(){
			if(!openMenu){
				$header.addClass('open-menu');
				openMenu = true;
			}else{
				close();
			}
		});
		$window.scroll(close);	
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
							window.location.href = urlPost;						
						},
						complete : function(){
							// Like blog-post
							pre_Paint();
							wpCaptionCorrection();
							validateForm();
	
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
	},
	
	// Blog Post
	wpCaptionCorrection = function(){
		$('.wp-caption').each(function(){
			var $this = $(this),
				w = $this.width();			
			$this.css({
				'max-width': w +'px',
				'width':'auto'
			});
		});		
		$('img.size-thumbnail').parent('.wp-caption').addClass('thumbnail');
	},
	pre_Paint = function(){
		var $pre = $('pre').not('.no-print').addClass('prettyprint');
		$('pre.html').each(function(){
			$(this).text($(this).html());
		});
		
		if($pre.length > 0){
			$.getScript('//google-code-prettify.googlecode.com/svn/loader/run_prettify.js');
		}
	},
	
	sidebarScroll = function(){
		var $sidebar = $('.sidebar'),
			$sidebarContent = $('#sidebar-content'),
			dY = 10,
			minTop = parseInt($sidebar.css('top')),
			offTop = $sidebar.offset().top,			
			current = 0,
			prev = 0,
			posY = 0,
			moveSidebar = function(){				
				current = $window.scrollTop();				
				if(current != prev){
					if(current < prev){$sidebarContent.css('top','60px');}else{$sidebarContent.css('top','0');}
					posY = current - offTop + minTop + dY;
					if(current < offTop){posY = minTop;$sidebarContent.css('top','0');}
					$sidebar.css({'top':  posY+ 'px'});
				}
				prev = current;
			}
			
		moveSidebar();
		$window.scroll(moveSidebar);	
	},
	
	validateForm = function(){
		var $f = $('fieldset.validate'),
			valid = true,
			validate = function(){
				valid = true;
				$f.each(function(){
					var $this = $(this),
						$input = $this.find('input,textarea'),
						min = parseInt($this.attr('min')) || 0,
						val = $input.val(),
						emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i,
						isEmail = false;
					if($this.hasClass('email')){
						isEmail = true;
					}	
					
					if(val.length < min){
						valid = false;
						$this.addClass('error');
						$input.focus();
					}else{					
						$this.removeClass('error');
					}
					if(isEmail){
						if(val.search(emailRegEx) == -1){
							valid = false;
							$this.addClass('error');
							$input.focus();
						}else{
							$this.removeClass('error');
						}				
					}			
				});
			},
			clearFiels = function(){				
				$f.removeClass('error').find('input,textarea').val('');
				$f.eq(0).find('input').focus();				
			};
			
		$('#submit').click(function(e){
			validate();
			if(!valid){e.preventDefault();} 
		});
		$('#clearFields').click(function(e){
			e.preventDefault();
			clearFiels();
		});
	},
	wipSlide = function(){
		if($('.wipSlider').length > 0){
			$.getScript(templateURL+'/js/jquery.wipSlider.min.js',function(){$('.wipSlider').wipSlider();});
		}
	};
	
	
		
	/* Execution *********************************************/
	// Commons
	$.ajaxSetup({cache:false});
	header();
	menuResponsive();
	
	// Home home
	
	if(pageID == 'home'){
		portfolioWork();		
	}
	// Portfolio List
	if(pageID == 'portfolio-list'){
		portfolio();
		portfolioWork();		
	}
	// Blog
	if(pageID == 'blog-list' || pageID == 'blog-post' || pageID == 'search-list'){
		var $sForm = $('#searchform');
		$('#s').val('').attr('placeholder','Search').focus(function(){
			$sForm.addClass('focus');
		}).blur(function(){
			$sForm.removeClass('focus');
		});
		sidebarScroll();
	}
	if(pageID == 'blog-post' || pageID == 'work-post'){
		pre_Paint();
		wpCaptionCorrection();				
		validateForm();
		wipSlide();
	}
	
	
	
	$(document).on("contextmenu", "img", function(e){
	    e.preventDefault();
	    //code
	    alert('No No');
	    return false;
	}); 
}


$('document').ready(function(){cazu()});


