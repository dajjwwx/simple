YKG.prototype.ui = function(){
	
	this.colorPicker = function(i){

			
			$('.jquery-colour-picker select').colourPicker({'ico':'/assets/c6733f28/jquery.colourPicker.gif','title':false,'callback':'new setBackgroundActiveData().setBackground();','inputTitle':'背景颜色','name':'background[color]'});

//			$('#background_border_color_picker select').colourPicker({'ico':'/assets/c6733f28/jquery.colourPicker.gif','title':false,'callback':'new setBackgroundActiveData().setBackground();','inputTitle':'边框颜色','name':'background[border_color]'});
//
//			
//		}
//		else
//		{
//			$('#InputControl'+i+'_color_picker select').colourPicker({'ico':'/assets/c6733f28/jquery.colourPicker.gif','title':false,'callback':'alert('+i+');','inputTitle':'边框颜色','name':'InputControl'+i+'[color]'});
//			
//		}	
		
		

	};




	return this;
}