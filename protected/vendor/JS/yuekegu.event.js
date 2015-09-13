
function YKG(){}



/**
 *静态方法
 *@use 静态实例化各个模块
 *@example YKG.app('form').alert("KK");
 *这样就可以调form模块下的alert()的函数组件
 */
YKG.app = function(name){
	var ykg = new YKG();
    var model = 'new ykg.' + name +'()';    
    eval('app ='+model);    
    return app;
};



YKG.prototype.dom = function(){
    
	/*-------------------------------------------------------------------------
	 * windswaterflow
	 * 注：使用此方法需要加载windswaterflow插件
	 * -------------------------------------------------------------------------*/

	this.windsWaterFlow = function(url, boxtemplate, columnwidth)
	{
		var boxtemplate = boxtemplate?boxtemplate:'<div class="pin hide"><a href="#"><div class="img"><img src="{img}" style="" alt="" /></div></a><div class="title">{title}</div><div class="like btn">喜欢</div><div class="comments btn">评论</div></div>';
		var columnwidth = columnwidth?columnwidth:210;
		
		$(".containerBox").windswaterflow({
	        itemSelector: '.pin',
	        loadSelector: '#loading',
	        noSelector: '#noshow', 
	        boxTemplate: boxtemplate,
	        columnWidth: columnwidth,
	        marginWidth: 14,
	        marginHeight: 16,
	        ajaxServer: url,
	        boxParam: 'num',
	        pageParam: 'page',
	        maxPage: 0,
	        minCols: 1,
	        init: false,
	        initBoxNumber: 10,
	        scroll: true,
	        scrollBoxNumber:10 ,
	        callback: function() {          
	            $(".pin").mouseover(function() {
	                $(this).find(".btn").show();
	            }).mouseout(function() {
	                $(this).find('.btn').hide();
	            });

	        }
	    });
	};	
	
	/**
	 * 浮动显示
	 * @param sidebar
	 * @returns
	 */
    this.float = function(sidebar){
        
        var html = $('<ul></ul>').css({
            
            'id':'float-nav',
            'border':'1px solid gray',
            'position':'fixed',
            'top':$(window).height()/2,
            'right':10,
            'text-align':'right',
            'padding':5
            
            
        });
        
        var items = new Array();
        
        sidebar.find('.widget').hide().find('h5').each(function(){
            items.push($(this).text());
            
            $('<li>' + $(this).text() + '</li>').appendTo(html);
            
        });
        
        console.log(html);
        
        html.appendTo($("body"));
        
        
        
        html.children().toggle(function(){
            $(this).css({'border-bottom':'2px dashed gray','padding':5});
            sidebar.find('.widget:eq('+$(this).index()+')').fadeIn();
        },function(){
            $(this).css({'border-bottom':'1px dashed gray','padding':5});
            sidebar.find('.widget:eq('+$(this).index()+')').fadeOut();
        });
        
        
        
        
        
        console.log(items);
        
        
    };
    
    //显示/隐藏文本内容
    this.showNext = function(object) {
    	
    	if(object.attr("alt") != '隐藏') {
    		object.attr("alt", "隐藏");
    		object.attr("title", object.text());
    		object.text(object.attr("alt"));
    	}else{
    		object.text(object.attr("title"));	
    		object.attr("title",object.attr("alt"));
    		object.attr("alt", object.text());
    			
    	}	
    	console.log(object.text());
    	object.next().slideToggle("slow");
    	
    	return false;
    	
    };
    
}

$(function(){
   //YKG.app('widget').float($("#sidebar")); 
});





