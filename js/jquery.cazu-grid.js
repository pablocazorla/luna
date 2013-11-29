/* CazuGrid Plugin
 * @author: Pablo Cazorla
 * @e-mail: pablo.cazorla@huddle.com.ar
 * @date: 11/28/2013
 */

var cazuGrid = function(selection){
	var
	
	// Store
	$g = $(selection),
	$fig = $g.find('figure'),	
	
	// Variables
	marginX = marginY = 24,
	length = $fig.length,
	width_$fig = $fig.width() + marginX,	
	
	// Functions
	draw = function(){
		var col = 0,
			numColumns = Math.ceil($g.width()/width_$fig) - 1,
			prevYarray = [],
			firstRow = true,
			posX = 0,
			posY = 0
			maxHeight = 0;
		for(var i = 0; i < length; i++){
			var $f = $fig.eq(i),
				h = $f.height() + marginY;
							
			posX = col * width_$fig;			
			if(firstRow){
				prevYarray.push(h);
			}else{
				posY = prevYarray[col];
				prevYarray[col] = posY + h;
			}			
			
			$f.css({
				'left' : posX + 'px',
				'top' : posY + 'px'
			});			
			
			if(prevYarray[col] > maxHeight){maxHeight = prevYarray[col];}
			
			++col;
			if(col >= numColumns){
				col = 0;
				firstRow = false;
			}
		}
		$g.css('height',maxHeight +'px');
	}	
	
	$fig.css('position','absolute');	
	draw();
	$(window).resize(draw);	
}
