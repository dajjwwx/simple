<?php

/** 
 * @author Administrator
 * 
 */
class CommentModel {
	///com_id, com_aid, com_pid, com_mid, com_rid, com_auid,  com_gid, com_vid, com_fid, com_proid, com_solid, com_status, com_author, com_email, com_website, com_ip, com_contents, com_create
	

	private $id;	//主键
	
	private $pid;	//评论对象ID
	private $rid;	//回复对象ID，即$pid
	
	private $ip;	//回复人IP地址
	private $created;	//回复时间
	
	private $status;	//评论状态
	private $author;	//回复人姓名
	private $email;	//回复人邮箱
	private $website;	//回复人个人网址
	private $content;	//回复内容
	
	
	
	
	
}

?>