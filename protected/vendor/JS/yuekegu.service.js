/**************************************
 *添加分类
 *@string parentid 分类的父ID
 *@int type 分类的类别编号
 ****************************************/
YKG.prototype.channel = function(){
	
	this.generateChannelDropdownListByType = function(type, parentName, showzero){
		
		$.get('/channel/channelsbytype.html',{'type':type, 'showZero':showzero == undefined?1:0},function(data){

			if(data){
				
				YKG.app('form').selectLoader(parentName, data);
				
			}
		},'json');
	};
	
	this.addCategory = function(parentid, type){

		$.post("/category/create.html",{Category:{
			'cate_pid':$("#"+parentid).val(),
			'cate_name':$("#categoryName").val(),
			'cate_type':type,
			'cate_contype':1,
			'cate_recommend':0,
			'cate_des':'无',
			'cate_order':Math.floor(Math.random() * 100)
			
		}},function(data){
//			alert(msg);
//			$(".category").append(msg);

//			console.log(data);
            


			if(data.state == 'success'){

				$("#categoryList").html("loading.......");
                

				$.get("/category/list.html",{'id':type},function(msg){
					console.log(msg);
					$("#categoryList").html($(msg).html());
				});	
                
               // console.log("外："+ parentid);
                
	

				$.getJSON("/category/dropdownlist.html",{'id':type},function(msg){
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
};

/***
 *获取内容标签
 *@string name 百度Ueditor的编辑器ID
 *@string target 返回内容自动写入的文本框ID
 */
YKG.prototype.getTags = function(name, target){
    var content = UE.getEditor(name).getContent();
	  
    $.post('/service/gettags.html',{'content':content},function(msg){
        $("#"+target).val(msg);
    });
};

YKG.prototype.gallary = function(){
    
    //设置封面
    this.folder = function(id, fid){
        $.get('/work/setfolder.html',{'id':id,'fid':fid},function(data){
            
            console.log(data);
            
            if(data.state == 'success'){
                var img = new Image();
                img.src = data.thumb;
                var width = img.width;
                var height = img.height;
                
                $("#media_folder").attr({
                    'src':data.thumb,
                    'width':width,
                    'height':height
                    
                });
                
                artDialog.tips("正在进行...", 2);
                
                artDialog.tips("封面修改成功...");


                
            }
            
        },'json');
    };
    
};

/**
 *配合CommentListWidget实现评论的显示
 */
YKG.prototype.comment = function(){
    
    
    
    this.reply = function(){
        alert("KKKKKKK");  
    };
    
    this.submit = function(){        
        
        $("#comment-form").submit(function(){
            
            if($("#Comment_com_author").val() == $("#Comment_com_author").attr("title")){
                $("#Comment_com_author").val('');
            }
            
            if($("#Comment_com_contents").val() == $("#Comment_com_contents").attr("title")){
                $("#Comment_com_contents").val('');
            }
            
            var data = $("#comment-form").serializeArray();
            
            data.ajax = 'comment-form';
            
            $.post('/comment/create.html',data,function(result){
                
                console.log(result);
                
                if(result.state == 'success'){
                    
                    $(".errorSummary").siblings().hide();
                    $(".errorSummary").show().html(result.message);
                    
                    
                }else{
                    $(".errorSummary").show().html($(result.message).html());
                }
                
                //$(".errorSummary").fadeOut(2000);
                
            },'json');
            
            console.log(data); 
            
            return false;           
        });   
    };
  
    /**
     *配合CommentListWidget实现评论的显示
     */
    
    this.scrollLoadCommentChildren = function(){
        //检测是否含有有回复的评论
        $(".comment:has(.children)").each(function(){
    
            //获取评论id
    		var id = $(this).attr("id");
            
            var comment = $(this);      
            //获取要填充的节点  
            var nochild = comment.find(".children");
            //获取填充节点的子节点长度，以检验回复评论是否已经加载，若length=0，则加载，否则不再加载
            var length = nochild.children().size();
            
    //        console.log(length);
            
            if(length == 0){ 
                
    //            console.log("KKK");
                
                $.get('/comment/list/'+id + '.html',function(data){                
                    
                    nochild.html(data);
                    
    //                console.log(id);
    //                console.log(data);
                }) ;           
            }
            
    
            
    	});        
    };

};
