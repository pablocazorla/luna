//App Cazu
var cazu = {
	init : function(){
		//Common
		this.$window = $(window);
		this.$body = $('body');	
		this.$article = $('article').eq(0);	
		
		if(!window.pageID){window.pageID = this.getPage();}		
		
		//Common
		this.currentMenu().headerMov().disableButtons();
		
		//Per page
		switch(window.pageID){
			case 'home':
				this.portfolioGrid().portfolioItemAjax();
				break;
			case 'blog-list':
				this.searchForm();
				break;
			case 'blog-post':
				this.searchForm().wpCaptionOnFull().preHighlight().wipSlide().validateForm();
				break;
			case 'portfolio-list':
				this.portfolioGrid().portfolioItemAjax();
				break;
			case 'page':
				this.preHighlight().getBubble();
				break;
			default:
				//
		}
		return this;
	},
	getPage : function(){
		var pageID = this.$article.attr('id');
		if(pageID == undefined || pageID == ''){pageID = 'portfolio';}
		return pageID;
	},
	headerMov : function(){
		var self = this,
			$header = $('header.main'),
			prev = this.$window.scrollTop(),
			current = 0,
			fixed = true,
			
			$menuLauncher = $('#menu-launcher'),
			menuOpen = false,
			menuOpening = false,
			setMenu = function(overMenuLauncher){
				if(overMenuLauncher && !menuOpen){
					$header.addClass('opened-menu');
					setTimeout(function(){
						menuOpen = true;
					},500);					
				}
				if(menuOpen){					
					$header.removeClass('opened-menu');
					setTimeout(function(){
						menuOpen = false;
					},500);									
				}						
			},
			sideAct = false,
			setSideAct = function(){
				var w = self.$window.width();
				if(w <= 768 && !sideAct){
					$('#sidebar-content').appendTo('#side-act-content');
					sideAct = true;
					console.log('sadasd');
				}
				if(w > 768 && sideAct){
					$('#sidebar-content').appendTo('aside.sidebar');
					sideAct = false;
				}
			};
		this.$window.scroll(function(){
			current = self.$window.scrollTop();
			//console.log(current);
			if(!fixed && current < prev){
				$header.removeClass('hidden');
				fixed = true;
			}else if(fixed && current > prev){
				$header.addClass('hidden');
				fixed = false;
				setMenu();
			}
			prev = current;
		}).resize(function(){
			setSideAct();
		});
		
		$menuLauncher.click(function(ev){
			ev.preventDefault();
			setMenu(true);
		});
		
		setSideAct();
		//Set color links
		$('menu.main a').each(function(index){
			$(this).addClass('it-menu'+index);
		});
		
		return this;
	},
	currentMenu :function(){
		var c = this.$article.attr('currentmenu');
		$('menu.main a').each(function(){
			var $a = $(this);
			if($a.text().toLowerCase().indexOf(c) != -1){
				$a.addClass('current');
			}			
		});		
		return this;
	},
	wpCaptionOnFull : function(){
		var $img = $('img.size-full');
		$img.parent('.wp-caption').css('max-width',$img.width()+'px');
		return this;
	},
	disableButtons : function(){
		$('.button.disable').attr('title','').click(function(event){var ev = event || window.event;ev.preventDefault();return false;});
		return this;
	},
	portfolioGrid : function(){		
		var grid = new cazuGrid('#gallery');						
		return this;
	},
	portfolioItemAjax : function(){
		var self = this,
			$itemShow = $('.item-show'),
			$itemDimmer = $('#item-dimmer'),
			$itemContent = $("#item-content").css('min-height',self.$window.height()+'px'),
			originalContent = $itemContent.html(),
			loadPost = function(pid, urlPost){
				//Show Item
				self.$body.addClass('overflow-hidden');
				$itemShow.scrollTop(0).fadeIn(400,function(){/*self.$body.addClass('overflow-hidden');*/});
				$.ajax({
					url : 'http://'+server+'/singleportfolio/',
					data : {id:pid,urlpost:urlPost},
					type : 'POST',
					success : function(html){
						$itemContent.html(html);$itemShow.scrollTop(0);
						$itemDimmer.height($itemContent.height());	
					},
					error : function(){
						// On error, redirect to urlPost
						window.location.href = urlPost;						
					},
					complete : function(){
						self.preHighlight().validateForm();
						$.getScript('//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4d9270a3495656e9',function(){
							addthis.toolbox(".addthis_toolbox");
						});
					}				
				});				
			},
			unloadPost = function(){
				//Hide Item
				$itemShow.fadeOut(250,function(){					
					self.$body.removeClass('overflow-hidden');
					$itemContent.html(originalContent);
				});
			}
		
		$.ajaxSetup({cache:false});
		
		// Events		 
	    $('.open-work').click(function(event){    	
	    	var ev = event || window.event;
	    	ev.preventDefault();        
	        loadPost($(this).attr('rel'),$(this).attr('href'));        
	        return false;
	    });
	    
	    $('.close-work').click(function(){ 
	        unloadPost();        
	        return false;
	    });
		
		$itemShow.scroll(function(){
			$itemDimmer.height($itemContent.height());			
		});
		
		return this;
	},
	searchForm : function(){
		var $f = $('#searchform');		
		$f.find('#s').attr('placeholder','Search').val('').focus(function(){
			$f.addClass('focus');
		}).blur(function(){
			$f.removeClass('focus');
		});
			
		return this;
	},
	validateForm : function(){
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
		return this;
	},
	preHighlight : function(){
		var $pre = $('pre').not('.no-print').addClass('prettyprint').each(function(){
			$(this).text($(this).html());
		});
		if($pre.length > 0){
			$.getScript('//google-code-prettify.googlecode.com/svn/loader/run_prettify.js');
		}
		return this;	
	},
	wipSlide : function(){
		if($('.wipSlider').length > 0){
			$.getScript(templateURL+'/js/jquery.wipSlider.min.js',function(){$('.wipSlider').wipSlider();});
		}
		return this;	
	},
	getBubble : function(){
		$.getScript(templateURL+'/js/jquery.bubble.js',function(){$('.bubble').Bubble();});
		return this;
	}
}
$('document').ready(function(){cazu.init()});
