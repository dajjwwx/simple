$(function(){
	/**
     *Jquery.lazyload.js
     */
    $("img").lazyload({ 
        threshold : 50 ,
        effect:'fadeIn',
        
    });

	/**
	 *实现自动填充文本框内容
     *@from YKG.form.autoTips();
     */
     
     YKG.app('form').autoTips();
     
     /**
      *实现评论提交
      */     
    YKG.app('comment').submit();
    
});

/*-------------------------------------------------------------------------
 * windswaterflow
 * -------------------------------------------------------------------------*/

function windsWaterFlow(url, boxtemplate, columnwidth)
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
        init: true,
        initBoxNumber: 10,
        scroll: true,
        scrollBoxNumber:10 ,
        callback: function() {          
            $(".pin").mouseover(function() {
                $(this).find(".btn").show();
                id = $(this).attr("id");
                href = $(this).children('a[rel=colorbox]').attr('href');
                
//                var image = new Image(100,50);
//                image.src = href;
//                
//                console.log(href);
                
            }).mouseout(function() {
                $(this).find('.btn').hide();
            });

        }
    });
}


/***
 * artDialog
 */
// 2011-07-17 更新
artDialog.fn.shake = function (){
    var style = this.DOM.wrap[0].style,
        p = [4, 8, 4, 0, -4, -8, -4, 0],
        fx = function () {
            style.marginLeft = p.shift() + 'px';
            if (p.length <= 0) {
                style.marginLeft = 0;
                clearInterval(timerId);
            };
        };
    p = p.concat(p.concat(p));
    timerId = setInterval(fx, 13);
    return this;
};


/***
 * 定义键盘事件，
 */

$(document).keydown(function(event){
	
	var e = event||window.event;
	
	var k = e.KeyCode||e.which;
	
	if ( e.ctrlKey && e.which == 77){
		console.log("yes");
		
		var dialog = art.dialog({
		    fixed: true,
		    lock:true,
		    id: 'Fm7',
		    title:'登录'
		});			
		
		$.ajax({
			url:'/site/loginajax.html',
			success:function(data){
				dialog.content(data);
				
				$("#LoginForm_password").focus(function(){
					$(this).css({
						'type':'password'
					});
				});
				
			}
		});
		
		 dialog.shake && dialog.shake();// 调用抖动接口
	}
	
	console.log(k);
	
});

/**
 *使用scroll方法激活ajax加载的内容相关的效果
 */
$(document).scroll(function(e){    
    YKG.app('comment').scrollLoadCommentChildren();
});




function ajaxLink()
{
    
}
