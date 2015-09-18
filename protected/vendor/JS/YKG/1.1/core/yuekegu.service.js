/**************************************
 *添加分类
 *@string parentid 分类的父ID
 *@int type 分类的类别编号
 ****************************************/
YKG.prototype.category = function(){
	

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
        
        $("#comment-form").submit(function(e){
        	
        	        	
        	alert("KDLSD");
            
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
                    $(".errorSummary").show().html(result.message);
                }
                
                $(".errorSummary").fadeOut(5000);
                
            },'json');
            
            console.log(data); 
            
            e.preventDefault();
            
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
