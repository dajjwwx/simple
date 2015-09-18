<?php 
return array(
			
		//七牛参数设置
		'QiNiu'=>array(
				'gaokao'=>array(
					'bucket'=>'gaokao',
					'domain'=>'http://7xl7l8.com1.z0.glb.clouddn.com',
					'accessKey'=>'h7QjbfBapyJ5IaA4SxuBKzKr1ozpTJU6mkBU8dNn',
					'secretKey'=>'2hPx9p0upxgI_vNg5ZyqAJaGGa2Kqj6LTjtc3Z7_'
				),						
		),
		'fileServer'=>'qiniu',
		'qq'=>array(
				// 应用基本信息
				'appid' => 100657839,
				'appkey' => 'b96b85196a04ff2ef08707f43979db15',
					
				// OpenAPI的服务器IP
				// 最新的API服务器地址请参考wiki文档: http://wiki.open.qq.com/wiki/API3.0%E6%96%87%E6%A1%A3
				'server_name' => '119.147.19.43',					
					
				// 用户的OpenID/OpenKey
				'openid' => 'E098C1E975A2459E534B48FB3224CFB6',
				'openkey' => '05219DB6D7C04CA0B3F01A51D32635E3',
					
				// 所要访问的平台, pf的其他取值参考wiki文档: http://wiki.open.qq.com/wiki/API3.0%E6%96%87%E6%A1%A3
				'pf' => 'qzone',
		),
		'sina'=>array(
					
					
		),
			
		'config'=>array(
		),
		//Upload path setting
		'uploadBlogPath'		=>  '/public/upload/Blog/',
		'uploadFilePath'		=>	'/public/upload/File/',
		'uploadImagePath'		=>  '/public/upload/Image/',
		'uploadGalleryPath'		=>  '/public/upload/Gallery/',
		'uploadAudioPath'		=> 	'/public/upload/Audio/',
		'uploadVideoPath'		=>	'/public/upload/Video/',
		'uploadCategoryPath'	=> 	'/public/upload/Category/',
		'uploadAvatarPath'	=>	'/public/upload/Avatar/',
		'uploadEditorPath'		=>  '/public/upload/Editor/',	//从编辑器中上传的文件	
		
		/****************Books自定义********************/		
		'uploadBooksPath'		=>	'/public/upload/Books/',
		//GaoKao文件上传路径
		'uploadGaoKaoPath'		=>	'/public/upload/GaoKao/',
		//Preparation文件上传路径
		'uploadPreparationPath'		=>  '/public/upload/Preparation/',
		
		/*********************************/

		//数据库备份路径
		'dbBackupPath'			=> '/protected/data/backup/',

		//文章自动保存路径
		'autoSavePath'			=>  '/public/autosave/',
		'autoSaveFileExtension' =>  '.asv',

		'indexPath'				=>	'public/data/index',//搜索索引目录
		'defaultAvatarPath' => '/public/image/avatar/avatar.png',
		//设置图集没有设置封面的默认封面路径
		'missingFolderPath' 	=> '/public/image/error/folder-missing.jpg',
		'missingFolderThumbPath'=> '/public/image/error/folder-missing-thumb.jpg',
		// this is used in contact page
		'email'=>'dajjwwx@163.com',
		//Site's copyright information
		'copyrightInfo'	=> 'Copyright &copy; 2010 by Blueidea',

		//Version
		'version' => '1.0 Beta',

		'keyword' => '创新教育,思维练习,实践创新',
		'description' => '悦珂谷专门从事创新教育研究，致力于激活孩子们的天赋与激情',
		'editor' => 'eclipse 3.7',
		'author' => '冷月十三',
);
?>