

YKG.prototype.util = function(){
	
	/**
	 * 验证是否为URL
	 * @param url
	 * @returns
	 */
	this.isURL = function (url) {
	    var strRegex = '^((https|http|ftp|rtsp|mms)?://)'
	            + '?(([0-9a-z_!~*\'().&=+$%-]+: )?[0-9a-z_!~*\'().&=+$%-]+@)?' //ftp的user@
	            + '(([0-9]{1,3}.){3}[0-9]{1,3}' // IP形式的URL- 199.194.52.184
	            + '|' // 允许IP和DOMAIN（域名）
	            + '([0-9a-z_!~*\'()-]+.)*' // 域名- www.
	            + '([0-9a-z][0-9a-z-]{0,61})?[0-9a-z].' // 二级域名
	            + '[a-z]{2,6})' // first level domain- .com or .museum
	            + '(:[0-9]{1,4})?' // 端口- :80
	            + '((/?)|' // a slash isn't required if there is no file name
	            + '(/[0-9a-z_!~*\'().;?:@&=+$,%#-]+)+/?)$';
	    var re=new RegExp(strRegex);
	//re.test()
	    if  (re.test(url)) {
	        return (true);
	    } else {
	        return (false);
	    }
	};
	
	/**
	 * 检验是否为Email	 * 
	 * @param email
	 * @returns
	 */
	this.isEmail = function(email){
		var re = /^([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+.[a-zA-Z]{2,3}$/ig;
		if(!re.test(email)){
			return false;
		}
		return true;
	};
	
}