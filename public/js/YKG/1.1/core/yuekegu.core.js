/**
 *@author  冷月十三
 *@email	zclandxy@gmail.com
 *@base jQuery Libaray
 *@see 此文件的为各模块的总调度
 */
function YKG(){}

/**
 *静态方法
 *@use 静态实例化各个模块
 *@example YKG.app('form').alert("KK");
 *这样就可以调form模块下的alert()的函数组件
 */
YKG.app = function(name){

	if(name == undefined){
		return new YKG();
	}else{
		var ykg = new YKG();
	    var model = 'new ykg.' + name +'()';    
	    eval('app ='+model);    
	    return app;		
	}

};