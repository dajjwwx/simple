YKG.prototype.video = function(){

    this.title = function(title){
        return $("<span>"+title+"</span>");
    };
    
    this.image = function(src){
        var img = new Image();
        img.src = '/public/images/ajax-loader.gif';
        img.id = 'video-preview-img'
        img.width = 64;
        
        return img;
    };   
    
    /**
     * 解析视频网址
     */
   this.parse = function(url){
        
        uu.loading($("#pre-video"));
                    
        $.get('/space/videoinfo.html',{
            rn:Math.random(),
            url:$("#me-video").val()
            },function(data){
                uu.video.preview(data);
                
        },'json');
    };
    
    this.videoinfo = function(data) {       
        
        var shorturl;
        var imageurl;
        var videoimg;
        
        $.ajaxSetup({  
            async : false  
        });
        
        
        if(data){
             $.get('/space/shorturl.html',{url:data.source},function(msg){
                shorturl = msg.short;
            },'json');   
        }else{
            $.get('/space/shorturl.html',{url:$("#me-video").val()},function(msg){
                var content = msg.short;
                uu.editor.insert(content);
            },'json');
        }            
        
        $.post('/space/cardvideo.html',{Video:data},function(msg){            
            $("#h-video").attr('name',msg.id);            
            videoimg = msg.videoimg;            
            console.log(msg);            
        },'json');
        
        $("#video-preview-img").attr({'src':videoimg,'width':128});
        
        var formatVideo = '[V source=' + data.source + ' id=' + data.flashvar + ' host=' + data.host + ' image=' + data.flashimg + ' shorturl=' + shorturl + ' videoimg=' + videoimg + ']' + data.title + '[/V]';
        
        $("#h-video").val(formatVideo);
        
        //设置Video　cookies值
        data.videoimg = videoimg;
        
        if($.cookies.get('cardvideo')){
            $.get('/space/replacevideo.html',{'flashvar':data.flashvar, 'host':data.host},function (data){
                console.log(data);   
            });
        }else{
            $.cookies.set('cardvideo', data);
        }          
    };
    
    this.preview = function(data){
        
        var button = $("<span>插入视频</span>")
                    .addClass('button right');
        var data  = data; 
        
        //console.log(data);  
        
        $("#pre-video").html('')
        .append(uu.video.title(data.title))
        .append('<br />')
        .append(uu.video.image())
        .append('<hr class="space" />')
        //.append(button)
        //.append('<hr class="space" />');  
        uu.video.videoinfo(data); 
        
        uu.editor.insertVideo(data);

             
    };
    
    this.videoPlayer = function(_object, host, flashvar, link){
        var player = uu.video.showFlash(host, flashvar);        
        var container = '<div class="videoHolder"><br /><a href="'+link+'" target="_blank">弹出</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="$(this).parent().prev().show();$(this).parent().remove();">收缩<a><br />' +  player + '</div>';
        _object.after(container);
        _object.hide();           
    },
    
    this.showFlash = function(host, flashvar) {
        var flashAddr = {'youku.com' : 'http://player.youku.com/player.php/sid/FLASHVAR/v.swf',
            'ku6.com' : 'http://player.ku6.com/refer/FLASHVAR/v.swf',
    		'56.com' : 'http://player.56.com/v_FLASHVAR.swf',
            'tudou.com' : 'http://www.tudou.com/v/FLASHVAR/v.swf',
            'sohu.com' : 'http://v.blog.sohu.com/fo/v4/FLASHVAR',
            'mofile.com' : 'http://tv.mofile.com/cn/xplayer.swf?v=FLASHVAR',
            'sina.com.cn' : 'http://vhead.blog.sina.com.cn/player/outer_player.swf?vid=FLASHVAR',
            'youtube.com' : 'http://www.youtube.com/embed/FLASHVAR',
            'yinyuetai.com' : 'http://player.yinyuetai.com/video/player/FLASHVAR/v_0.swf',
    		'flash':'FLASHVAR',
        };
        var videoFlash = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="480" height="407"><param name="movie" value="FLASHADDR" /><param name="quality" value="high" /><param name="bgcolor" value="#FFFFFF" /><embed width="480" height="407" menu="false" quality="high" src="FLASHADDR" type="application/x-shockwave-flash" /></object>';
    	
    	var flashHtml = videoFlash;
        if(flashvar=='') {return false;}

        if(flashAddr[host]) {
            var flash = flashAddr[host].replace('FLASHVAR', flashvar);
            flashHtml = flashHtml.replace(/FLASHADDR/g, flash);

        }
        
        return flashHtml;
    };
    
	
};