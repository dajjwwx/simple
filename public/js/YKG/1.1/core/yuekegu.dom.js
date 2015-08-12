/**
 *@author  冷月十三
 *@email	zclandxy@gmail.com
 *@base jQuery Libaray
 *@see 有关DOM操作的相关方法
 */
YKG.prototype.dom = function(){
    

	/**
	 *用于ajax加载内容之前填充数据
	 */
    this.preAjax = function(object)
    {
    	object.html('<img src="/public/image/loading.gif" />');
    }
	/**
	 * 
	 */
	this.generateCategoryDropdownListByType = function(type, parentName, showzero){

		$.get('/administrator/category/dropdownlist.html',{'type':type, 'showZero':showzero == undefined?1:0},function(data){

			if(data){
				
				YKG.app('form').selectLoader(parentName, data);
				
			}
		},'json');
	};
	
	/**
	 * @param parentNodeId	父类节点ID	
	 * @param type  分类类型
	 */
	this.addCategory = function(parentNodeId, type){

		$.post("<?php echo $this->createUrl('/administrator/category/createajax');?>",{Category:{
			'pid':$("#"+parentNodeId).val(),
			'name':$("#categoryName").val(),
			'type':type,
			'description':'无',
			'weight':Math.floor(Math.random() * 100)
			
		}},function(data){
//			alert(msg);
//			$(".category").append(msg);

//			console.log(data);   


			if(data.state == 'success'){

				$("#categoryList").html("loading.......");
                

				$.get("/administrator/category/list.html",{'id':type},function(msg){
					console.log(msg);
					$("#categoryList").html($(msg).html());
				});	
                
               // console.log("外："+ parentid);	

				$.getJSON("/administrator/category/dropdownlist.html",{'id':type},function(msg){
//			 	      alert(msg);
//
//                            console.log("内："+ parentid);
							
				            var pid = document.getElementById(parentid);
                            
//                            console.log(pid);

				            //清除所有已有选项
				            while(pid.childNodes.length>0){
				            	pid.removeChild(pid.childNodes[0]);
				           }
				           $.each(msg,function(k,v){
//								dd += (k+v);

				            					
				            	var option = new Option(v,k);
				            	pid.options.add(option);
				            });
//				            alert(dd);

					       	//checkbox onChange事件
					       	//checkboxChange();
				    	});		
	

			}else{

				
			}
		},'json');
	};
	
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
	 * ********************************************************************
	 * 浮动显示
	 * ********************************************************************
	 * 
	 * *********************************************************************
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
    
	/**
	 *Jquery.lazyload.js
	 */   
    this.lazyLoad = function(){

        $("img").lazyload({ 
            threshold : 50 ,
            effect:'fadeIn',
            
        });
    };
    
};