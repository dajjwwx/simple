/**
 *@author  冷月十三
 *@email	zclandxy@gmail.com
 *@base jQuery Libaray
 *@see 有关表单操作的相关方法
 */

YKG.prototype.form = function(){
	
    /*****************************************************
     * 注：此方法依赖于poshytip插件
     * **********************************************
     * 
     *根据文本框的Title自动提示文本框标题
     */
    this.autoTips = function(){
      	$(":input").val(function(){
      	 
            //如果文本框有默认的内容，则显示默认内容，不然就显示title内容         
      	     if($(this).val() != '' && $(this).val() != $(this).attr("title")){
      	        return $(this).val();
      	     }else{
      	         return $(this).attr("title"); 
      	     }
      		
      	}).focus(function(){
      		if($(this).val() == $(this).attr("title")){
      			$(this).val('');
      		}
      	}).blur(function(){
      		if($(this).val() == ''){
      			$(this).val($(this).attr("title"));
      		}
      	});    
      	
      	$(':input ').poshytip({"className":"tip-yellowsimple","showOn":"focus","alignTo":"target","alignX":"left","alignY":"center","offsetX":5});
    }; 
    
	
	/**
	 * 
	 * @param parentid
	 * @param data
	 * @returns
	 */
	this.selectLoader = function(parentName, data){
        var pid = document.getElementById(parentName);
        
//      console.log(pid);

      //清除所有已有选项
      while(pid.childNodes.length>0){
      	pid.removeChild(pid.childNodes[0]);
     }
     $.each(data,function(k,v){
//			dd += (k+v);

      					
      	var option = new Option(k,v);
      	pid.options.add(option);
      });
	}
	
};