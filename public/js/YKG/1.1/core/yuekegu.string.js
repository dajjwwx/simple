YKG.prototype.string = function()
{

	/**
	 * 去除字符串前后的空格
	 * @param  {[type]} str [description]
	 * @return {[type]}     [description]
	 */
	this.trim = function(str){
		return str.replace(/(^\s*)|(\s*$)/g, ""); 
	};

	return this;
}