YKLIBS
======

Yuekegu's Common Libaray
-------------------------------------------------------------

Common文件夹说明：
    在这个文件夹下包含常用的模型类库、工具类以及常用类库

类名规范：
  以目录名加下划线的方式命名如：Test_C_TEST的实际文件路径为Util,API,Models,Helper中任何一个目录的下级子目录Test/C/Test.php

<?php
class Test_C_Test
{
	public function say()
	{
		echo "Yes";
	}
}
?>

文件夹结构：

    Common:
    ----Util:自定义的工具类
    ----API：获取网络资源类
    ----Models：自定义的模型类
    ----Helper：别人写的工具类
