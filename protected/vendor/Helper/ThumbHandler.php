<?php
/**
 *  基本图片处理，用于完成图片缩入，水印添加
 *  当水印图超过目标图片尺寸时，水印图能自动适应目标图片而缩小
 *  水印图可以设置跟背景的合并度
 *
 *  Copyright(c) 2005 by ustb99. All rights reserved
 *
 *  To contact the author write to {@link mailto:ustb80@163.com @author @version $Id: thumb.class.php,v 1.9 2006/09/30 09:31:56 zengjian Exp $
 * @package

@access

/*
 使用方法:
    自动裁切:
    程序会按照图片的尺寸从中部裁切最大的正方形，并按目标尺寸进行缩略

    $t->setSrcImg("img/test.jpg");
    $t->setCutType(1);//这一句就OK了
    $t->setDstImg("tmp/new_test.jpg");
    $t->createImg(60,60);

    手工裁切:
    程序会按照指定的位置从源图上取图

    $t->setSrcImg("img/test.jpg");
    $t->setCutType(2);//指明为手工裁切
    $t->setSrcCutPosition(100, 100);// 源图起点坐标
    $t->setRectangleCut(300, 200);// 裁切尺寸
    $t->setDstImg("tmp/new_test.jpg");
    $t->createImg(300,200);
*/
class ThumbHandler
{
    private $dst_img;// 目标文件
    private $h_src; // 图片资源句柄
    private $h_dst;// 新图句柄
    private $h_mask;// 水印句柄
    private $img_create_quality = 100;// 图片生成质量
    private $img_display_quality = 80;// 图片显示质量,默认为75
    private $img_scale = 0;// 图片缩放比例
    private $src_w = 0;// 原图宽度
    private $src_h = 0;// 原图高度
    private $dst_w = 0;// 新图总宽度
    private $dst_h = 0;// 新图总高度
    private $fill_w;// 填充图形宽
    private $fill_h;// 填充图形高
    private $copy_w;// 拷贝图形宽
    private $copy_h;// 拷贝图形高
    private $src_x = 0;// 原图绘制起始横坐标
    private $src_y = 0;// 原图绘制起始纵坐标
    private $start_x;// 新图绘制起始横坐标
    private $start_y;// 新图绘制起始纵坐标
    private $mask_word;// 水印文字
    private $mask_img;// 水印图片
    private $mask_pos_x = 0;// 水印横坐标
    private $mask_pos_y = 0;// 水印纵坐标
    private $mask_offset_x = 5;// 水印横向偏移
    private $mask_offset_y = 5;// 水印纵向偏移
    private $font_w;// 水印字体宽
    private $font_h;// 水印字体高
    private $mask_w;// 水印宽
    private $mask_h;// 水印高
    private $mask_font_color = "#ffffff";// 水印文字颜色
    private $mask_font = 2;// 水印字体
    private $font_size;// 尺寸
    private $mask_position = 0;// 水印位置
    private $mask_img_pct = 50;// 图片合并程度,值越大，合并程序越低
    private $mask_txt_pct = 50;// 文字合并程度,值越小，合并程序越低
    private $img_border_size = 0;// 图片边框尺寸
    private $img_border_color;// 图片边框颜色
    private $_flip_x=0;// 水平翻转次数
    private $_flip_y=0;// 垂直翻转次数
    private $cut_type=0;// 剪切类型
    private $img_type;// 文件类型
    // 文件类型定义,并指出了输出图片的函数
    private $all_type = array(
        "jpg"  => array("output"=>"imagejpeg"),
        "gif"  => array("output"=>"imagegif"),
        "png"  => array("output"=>"imagepng"),
        "wbmp" => array("output"=>"image2wbmp"),
        "jpeg" => array("output"=>"imagejpeg")
    );
    
    function __construct()
    {
        $this->mask_font_color = "#ffffff";
        $this->font = 2;
        $this->font_size = 12;
   	}
    
   	function getImgWidth($src)
    {
        return imagesx($src);
    }
    
    function getImgHeight($src)
    {
       return imagesy($src);
    }
    /**
     * 设置图片生成路径
     *
     * @param
     */
    function setSrcImg($src_img, $img_type=null)
    {
        if(!file_exists($src_img))
        {
            die("图片不存在");
        }
        if(!empty($img_type))
        {
            $this->img_type = $img_type;
        }
        else
        {
            $this->img_type = $this->_getImgType($src_img);
        }
        
        $this->_checkValid($this->img_type); // file_get_contents函数要求php版本>4.3.0
        
        $src = '';
        
        if(function_exists("file_get_contents"))
        {
        	
            $src = file_get_contents($src_img);
        }
        else
        {
            $handle = fopen ($src_img, "r");  
            while (!feof ($handle))
            {
                $src .= fgets($fd, 4096);
            }
            fclose ($handle);
       	}
        if(empty($src))
        {
            die("图片源为空");
        }
        $this->h_src = @ImageCreateFromString($src);
        $this->src_w = $this->getImgWidth($this->h_src);
        $this->src_h = $this->getImgHeight($this->h_src);

   	}
   	function getSrcImgWidth()
   	{
   		return $this->getImgWidth($this->h_src);
   	}
   	function getSrcImgHeight()
   	{
   		return $this->getImgHeight($this->h_src);
   	}
    /**
     * 设置图片生成路径
     *
     * @param
     */
    function setDstImg($dst_img)
    {
        $arr  = explode('/',$dst_img);
        $last = array_pop($arr);
        $path = implode('/',$arr);
        $this->_mkdirs($path);
        $this->dst_img = $dst_img;
    }
    /**
     * 设置图片的显示质量
     *
     * @param
     */
    function setImgDisplayQuality($n)
    {
     	
       	$this->img_display_quality = (int)$n;
       	
    	if($this->img_type == 'png')
    	{
    		str_replace('.', '', (string)phpversion()) >= 512 && $this->img_display_quality = $n/10;
     		$this->img_display_quality = (int)$n/10;
    	}           
    }
    
    /**
     * 设置图片的生成质量
     *
     * @param
     */
    function setImgCreateQuality($n)
    {
        $this->img_create_quality = (int)$n;
    } 
    function setMaskWord($word)
    {
        $this->mask_word .= $word;
    }
    
    function setMaskFontColor($color="#ffffff")
    {
        $this->mask_font_color = $color;
    } 
    
    function setMaskFont($font=2)
    {
        if(!is_numeric($font) && !file_exists($font))
        {
            die("字体文件不存在");
        }
        $this->font = $font;
    }
    
    function setMaskFontSize($size = "12")
    {
        $this->font_size = $size;
    }

    function setMaskImg($img)
    {
        $this->mask_img = $img;
    }
    /**
     * 设置水印横向偏移
     *
     * @param
     */
    function setMaskOffsetX($x)
    {
        $this->mask_offset_x = (int)$x;
    }
        
    /**
     * 设置水印纵向偏移
     *
     * @param
     */
    function setMaskOffsetY($y)
    {
        $this->mask_offset_y = (int)$y;
    } 
        
     /*
      * @param  integer $position    位置,1:左上,2:左下,3:右上,0/4:右下
      */
    function setMaskPosition($position=0)
    {
        $this->mask_position = (int)$position;
    }
    /**
     * 设置图片合并程度
     *
     * @param
     */
    function setMaskImgPct($n)
    {
        $this->mask_img_pct = (int)$n;
    }
    
    /**
     * 设置文字合并程度
     *
     * @param
     */
    function setMaskTxtPct($n)
    {
        $this->mask_txt_pct = (int)$n;
    }
    
    /** 
     *@param    (类型)     (参数名)    (描述)
     */
    function setDstImgBorder($size=1, $color="#000000")
    {
        $this->img_border_size  = (int)$size;
        $this->img_border_color = $color;
    }
    
    function flipH()
    {
        $this->_flip_x;
    }
    
    function flipV()
    {
        $this->_flip_y;
    }
    
    function setCutType($type)
    {
        $this->cut_type = (int)$type;
    }
    
    function setRectangleCut($width, $height)
    {
        $this->fill_w = (int) $width;
        $this->fill_h = (int)$height;
    }
    /**
     * 设置源图剪切起始坐标点
     *
     * @param    (类型)     (参数名)    (描述)
     */
    function setSrcCutPosition($x, $y)
    {
        $this->src_x  = (int)$x;
        $this->src_y  = (int)$y;
    }
    /*
     *  @param integer  $a  当缺少第二个参数时，此参数将用作百分比， 否则作为宽度值
	 */
    
    function createImg($a, $b=null)
    {
        $num = func_num_args();
        if(1 == $num)
        {
            $r = (int)$a;
            if($r < 1)
            {
                die("图片缩放比例不得小于1");
            }
            $this->img_scale = $r;
            $this->_setNewImgSize($r);
        }
        if(2 == $num)
        {
            $w = (int)$a;
            $h = (int)$b;
            if(0 == $w)
            {
                die("目标宽度不能为0");
            }
            if(0 == $h)
            {
                die("目标高度不能为0");
            }
            $this->_setNewImgSize($w, $h);
        }
        if($this->_flip_x%2!=0)
        {
            $this->_flipH($this->h_src);
        }
        if($this->_flip_y%2!=0)
        {
            $this->_flipV($this->h_src);
        }
        $this->_createMask();
        $this->_output();// 释放
        if(imagedestroy($this->h_src) && imagedestroy($this->h_dst))
        {
            Return true;
        }
        else
        {
            Return false;
        }
    }
    /**
     * 生成水印,调用了生成水印文字和水印图片两个方法
     */
    function _createMask()
    {
        if($this->mask_word)
        {
            // 获取字体信息
            $this->_setFontInfo();
            if($this->_isFull())
            {
                die("水印文字过大");
            }
            else
            {
                $this->h_dst = imagecreatetruecolor($this->dst_w, $this->dst_h);
                $white = ImageColorAllocate($this->h_dst,255,255,255);
                imagefilledrectangle($this->h_dst,0,0,$this->dst_w,$this->dst_h,$white);// 填充背景色
                $this->_drawBorder();
                imagecopyresampled( $this->h_dst, $this->h_src,
                                    $this->start_x, $this->start_y,
                                    $this->src_x, $this->src_y,
                                    $this->fill_w, $this->fill_h,
                                    $this->copy_w, $this->copy_h);
              	$this->_createMaskWord($this->h_dst);
            }
        }
        if($this->mask_img)
        {
            $this->_loadMaskImg();//加载时，取得宽高
            if($this->_isFull())
            {
                // 将水印生成在原图上再拷
                $this->_createMaskImg($this->h_src);
                $this->h_dst = imagecreatetruecolor($this->dst_w, $this->dst_h);
                $white = ImageColorAllocate($this->h_dst,255,255,255);
                imagefilledrectangle($this->h_dst,0,0,$this->dst_w,$this->dst_h,$white);// 填充背景色
                $this->_drawBorder();
                imagecopyresampled( $this->h_dst, $this->h_src,
                                    $this->start_x, $this->start_y,
                                    $this->src_x, $this->src_y,
                                    $this->fill_w, $this->start_y,
                                    $this->copy_w, $this->copy_h);
            }
            else
            {
                // 创建新图并拷贝
                $this->h_dst = imagecreatetruecolor($this->dst_w, $this->dst_h);
                $white = ImageColorAllocate($this->h_dst,255,255,255);
                imagefilledrectangle($this->h_dst,0,0,$this->dst_w,$this->dst_h,$white);// 填充背景色
                $this->_drawBorder();
                imagecopyresampled( $this->h_dst, $this->h_src,
                                    $this->start_x, $this->start_y,
                                    $this->src_x, $this->src_y,
                                    $this->fill_w, $this->fill_h,
                                    $this->copy_w, $this->copy_h);
                $this->_createMaskImg($this->h_dst);
            }
        }
        if(empty($this->mask_word) && empty($this->mask_img))
        {
            $this->h_dst = imagecreatetruecolor($this->dst_w, $this->dst_h);
            $white = ImageColorAllocate($this->h_dst,255,255,255);
            imagefilledrectangle($this->h_dst,0,0,$this->dst_w,$this->dst_h,$white);// 填充背景色
            $this->_drawBorder();
            imagecopyresampled( $this->h_dst, $this->h_src,$this->start_x, $this->start_y,$this->src_x, $this->src_y,$this->fill_w, $this->fill_h,$this->copy_w, $this->copy_h);
        }
    }
    function _drawBorder()
    {
        if(!empty($this->img_border_size))
        {
            $c = $this->_parseColor($this->img_border_color);
            $color = ImageColorAllocate($this->h_src,$c[0], $c[1], $c[2]);
            imagefilledrectangle($this->h_dst,0,0,$this->dst_w,$this->dst_h,$color);// 填充背景色
        }
    }
    function _createMaskWord($src)
    {
        $this->_countMaskPos();
        $this->_checkMaskValid();
        $c = $this->_parseColor($this->mask_font_color);
        $color = imagecolorallocatealpha($src, $c[0], $c[1], $c[2], $this->mask_txt_pct);
        if(is_numeric($this->font))
        {
            imagestring($src,$this->font,$this->mask_pos_x, $this->mask_pos_y,$this->mask_word,$color);
        }
        else
        {
            imagettftext($src,$this->font_size, 0,$this->mask_pos_x, $this->mask_pos_y,$color,$this->font,$this->mask_word);
        }
    }
    function _createMaskImg($src)
    {
        $this->_countMaskPos();
        $this->_checkMaskValid();
        imagecopymerge($src,$this->h_mask,$this->mask_pos_x ,$this->mask_pos_y,0, 0,$this->mask_w, $this->mask_h,$this->mask_img_pct);
        imagedestroy($this->h_mask);
    }
    function _loadMaskImg()
    {
        $mask_type = $this->_getImgType($this->mask_img);
        $this->_checkValid($mask_type);// file_get_contents函数要求php版本>4.3.0
        $src = '';
        if(function_exists("file_get_contents"))
        {
            $src = file_get_contents($this->mask_img);
        }
        else
        {
            $handle = fopen ($this->mask_img, "r");
            while (!feof ($handle))
            {
                $src .= fgets($fd, 4096);
            }
            fclose ($handle);
        }
        if(empty($this->mask_img))
        {
            die("水印图片为空");
         }
        $this->h_mask = ImageCreateFromString($src);
        $this->mask_w = $this->getImgWidth($this->h_mask);
        $this->mask_h = $this->getImgHeight($this->h_mask);
    }

    function _output()
    {
        $img_type  = $this->img_type;
        $func_name = $this->all_type[$img_type]['output'];
        if(function_exists($func_name))
        {
            // 判断浏览器,若是IE就不发送头
            if(isset($_SERVER['HTTP_USER_AGENT']))
            {
                $ua = strtoupper($_SERVER['HTTP_USER_AGENT']);
                if(!preg_match('/^.*MSIE.*\)$/i',$ua))
                {
                    header("Content-type:$img_type");
                }
            }
            
//             echo phpversion();
            
//             str_replace('.', '', (string)phpversion()) >= 512 && $this->img_display_quality = 80/10;
            
//             echo $this->img_display_quality;
            
//             UtilTools::dump($this);
//             echo $func_name;
//             UtilTools::dump($this->h_dst);
//             echo $this->dst_img;
//             echo $this->img_display_quality;
//             die();
// 			$this->img_display_quality = 8;
            
            $func_name($this->h_dst, $this->dst_img, $this->img_display_quality);
        }
        else
        {
            Return false;
        }
    } 
    
    function _parseColor($color)
    {
        $arr = array();
        for($ii=1; $ii<strlen ($color); $ii++)
        {
            $arr[] = hexdec(substr($color,$ii,2));
            $ii;
        }
        Return $arr;
    }
    function _countMaskPos()
    {
        if($this->_isFull())
        {
            switch($this->mask_position)
            {
                case 1:	// 左上
                    $this->mask_pos_x = $this->mask_offset_x + $this->img_border_size;
                    $this->mask_pos_y = $this->mask_offset_y + $this->img_border_size;
                   	break;
                case 2: // 左下
                    $this->mask_pos_x = $this->mask_offset_x + $this->img_border_size;
                    $this->mask_pos_y = $this->src_h - $this->mask_h - $this->mask_offset_y;
               		break;
                case 3:// 右上
                    $this->mask_pos_x = $this->src_w - $this->mask_w - $this->mask_offset_x;
                    $this->mask_pos_y = $this->mask_offset_y + $this->img_border_sizebreak;
                case 4:// 右下
                    $this->mask_pos_x = $this->src_w - $this->mask_w - $this->mask_offset_x;
                    $this->mask_pos_y = $this->src_h - $this->mask_h - $this->mask_offset_y;
                	break;
               	default:// 默认将水印放到右下,偏移指定像素
                    $this->mask_pos_x = $this->src_w - $this->mask_w - $this->mask_offset_x;
                    $this->mask_pos_y = $this->src_h - $this->mask_h - $this->mask_offset_y;
                    break;
            }
        }
        else
        {
            switch($this->mask_position)
            {
                case 1:// 左上
                    $this->mask_pos_x = $this->mask_offset_x + $this->img_border_size;
                    $this->mask_pos_y = $this->mask_offset_y + $this->img_border_size;
                    break;
                case 2:// 左下
                    $this->mask_pos_x = $this->mask_offset_x + $this->img_border_size;
                    $this->mask_pos_y = $this->dst_h - $this->mask_h - $this->mask_offset_y - $this->img_border_size;
                    break;
                case 3:// 右上
                    $this->mask_pos_x = $this->dst_w - $this->mask_w - $this->mask_offset_x - $this->img_border_size;
                    $this->mask_pos_y = $this->mask_offset_y + $this->img_border_size;
                 	break;
               	case 4:// 右下
                    $this->mask_pos_x = $this->dst_w - $this->mask_w - $this->mask_offset_x - $this->img_border_size;
                    $this->mask_pos_y = $this->dst_h - $this->mask_h - $this->mask_offset_y - $this->img_border_size;
                    break;
                default:// 默认将水印放到右下,偏移指定像素
                    $this->mask_pos_x = $this->dst_w - $this->mask_w - $this->mask_offset_x - $this->img_border_size;
                    $this->mask_pos_y = $this->dst_h - $this->mask_h - $this->mask_offset_y - $this->img_border_size;
                    break;
            }
        }
    }
    
    function _setFontInfo()
    {
        if(is_numeric($this->font))
        {
            $this->font_w  = imagefontwidth($this->font);
            $this->font_h  = imagefontheight($this->font);// 计算水印字体所占宽高
            $word_length   = strlen($this->mask_word);
            $this->mask_w  = $this->font_w*$word_length;
            $this->mask_h  = $this->font_h;
        }
        else
        {
            $arr = imagettfbbox ($this->font_size,0, $this->font,$this->mask_word);
            $this->mask_w  = abs($arr[0] - $arr[2]);
            $this->mask_h  = abs($arr[7] - $arr[1]);
        }
    }
    
    function _setNewImgSize($img_w, $img_h=null)
    {
        $num = func_num_args();
        if(1 == $num)
        {
            $this->img_scale = $img_w;// 宽度作为比例
            $this->fill_w = round($this->src_w * $this->img_scale / 100) - $this->img_border_size*2;
            $this->fill_h = round($this->src_h * $this->img_scale / 100) - $this->img_border_size*2;// 源文件起始坐标
            $this->src_x  = 0;
            $this->src_y  = 0;
            $this->copy_w = $this->src_w;
            $this->copy_h = $this->src_h;// 目标尺寸
            $this->dst_w   = $this->fill_w + $this->img_border_size*2;
            $this->dst_h   = $this->fill_h + $this->img_border_size*2;
        }
        if(2 == $num)
        {
            $fill_w   = (int)$img_w - $this->img_border_size*2;
            $fill_h   = (int)$img_h - $this->img_border_size*2;
            if($fill_w < 0 || $fill_h < 0)
            {
                die("图片边框过大，已超过了图片的宽度");
            }
            $rate_w = $this->src_w/$fill_w;
            $rate_h = $this->src_h/$fill_h;
            switch($this->cut_type)
            {
                case 0:// 如果原图大于缩略图，产生缩小，否则不缩小
                    if($rate_w < 1 && $rate_h < 1)
                    {
                        $this->fill_w = (int)$this->src_w;
                        $this->fill_h = (int)$this->src_h;
                    }
                    else
                    {
                        if($rate_w >= $rate_h)
                        {
                            $this->fill_w = (int)$fill_w;
                            $this->fill_h = round($this->src_h/$rate_w);
                        }
                        else
                        {
                            $this->fill_w = round($this->src_w/$rate_h);
                            $this->fill_h = (int)$fill_h;
                        }
                    }
                    $this->src_x  = 0;
                    $this->src_y  = 0;
                    $this->copy_w = $this->src_w;
                    $this->copy_h = $this->src_h;// 目标尺寸
                    $this->dst_w   = $this->fill_w + $this->img_border_size*2;
                    $this->dst_h   = $this->fill_h + $this->img_border_size*2;
                    break;// 自动裁切
                case 1:// 如果图片是缩小剪切才进行操作
                    if($rate_w >= 1 && $rate_h >=1)
                    {
                        if($this->src_w > $this->src_h)
                        {
                            $src_x = round($this->src_w-$this->src_h)/2;
                            $this->setSrcCutPosition($src_x, 0);
                            $this->setRectangleCut($fill_h, $fill_h);

                            $this->copy_w = $this->src_h;
                            $this->copy_h = $this->src_h;
                            
                        }
                        elseif($this->src_w < $this->src_h)
                        {
                            $src_y = round($this->src_h-$this->src_w)/2;
                            $this->setSrcCutPosition(0, $src_y);
                            $this->setRectangleCut($fill_w, $fill_h);

                            $this->copy_w = $this->src_w;
                            $this->copy_h = $this->src_w;
                        }
                        else
                        {
                            $this->setSrcCutPosition(0, 0);
                            $this->copy_w = $this->src_w;
                            $this->copy_h = $this->src_w;
                            $this->setRectangleCut($fill_w, $fill_h);
                        }
                    }
                    else
                    {
                        $this->setSrcCutPosition(0, 0);
                        $this->setRectangleCut($this->src_w, $this->src_h);
                        $this->copy_w = $this->src_w;
                        $this->copy_h = $this->src_h;
                    }
                    // 目标尺寸
                    $this->dst_w   = $this->fill_w + $this->img_border_size*2;
                    $this->dst_h   = $this->fill_h + $this->img_border_size*2;
                    
                    break;
                    // 手工裁切
                case 2:
                	$this->copy_w = $this->fill_w; // $img_w;	//$this->fill_w;
                	$this->copy_h = $this->fill_h; // $img_h; //$this->fill_h;
                	// 目标尺寸
                    $this->dst_w   = $this->fill_w + $this->img_border_size*2;
                    $this->dst_h   = $this->fill_h + $this->img_border_size*2;               
                    
                    break;
               default:
                    break;
            }
        }
	    // 目标文件起始坐标
		$this->start_x = $this->img_border_size;
		$this->start_y = $this->img_border_size;
    }
    
    /**
     * 检查水印图是否大于生成后的图片宽高
     */
     
    function _isFull()
    {
        Return ($this->mask_w + $this->mask_offset_x > $this->fill_w || $this->mask_h + $this->mask_offset_y > $this->fill_h)?true:false;
    }
    
    function _checkMaskValid()
    {
        if( $this->mask_w + $this->mask_offset_x > $this->src_w || $this->mask_h + $this->mask_offset_y > $this->src_h)
        {
            die("水印图片尺寸大于原图，请缩小水印图");
        }
    } 

    function _getImgType($file_path)
    {
        $type_list = array("1"=>"gif","2"=>"jpg","3"=>"png","4"=>"swf","5" => "psd","6"=>"bmp","15"=>"wbmp");
        if(file_exists($file_path))
        {
            $img_info = @getimagesize ($file_path);
            if(isset($type_list[$img_info[2]]))
            {
                Return $type_list[$img_info[2]];
            }
        }
        else
        {
            die("文件不存在,不能取得文件类型!");
        }
    }
    
    /**
     * 检查图片类型是否合法,调用了array_key_exists函数，此函数要求
     * php版本大于4.1.0
	 */
    function _checkValid($img_type)
    {
        if(!array_key_exists($img_type, $this->all_type))
        {
            Return false;
        }
    }
    
    /**
     * 按指定路径生成目录
     *
     */
    function _mkdirs($path)
    {
        $adir = explode('/',$path);
        $dirlist = '';
        $rootdir = array_shift($adir);
        if(($rootdir!='.'||$rootdir!='..')&&!file_exists($rootdir))
        {
            @mkdir($rootdir);
        }
        foreach($adir as $key=>$val)
        {
            if($val!='.'&&$val!='..')
            {
                $dirlist .= "/".$val;
                $dirpath = $rootdir.$dirlist;
                if(!file_exists($dirpath))
                {
                    @mkdir($dirpath);
                    chmod($dirpath,0777);
                }
            }
        }
    }

    function _flipV($src)
    {
        $src_x = $this->getImgWidth($src);
        $src_y = $this->getImgHeight($src);
        $new_im = imagecreatetruecolor($src_x, $src_y);
        for ($y = 0; $y < $src_y; $y++)
        {
            imagecopy($new_im, $src, 0, $src_y - $y - 1, 0, $y, $src_x, 1);
        }
        $this->h_src = $new_im;
    }

    function _flipH($src)
    {
        $src_x = $this->getImgWidth($src);
        $src_y = $this->getImgHeight($src);
        $new_im = imagecreatetruecolor($src_x, $src_y);
        for ($x = 0; $x < $src_x; $x++)
        {
            imagecopy($new_im, $src, $src_x - $x - 1, 0, $x, 0, 1, $src_y);
        }
        $this->h_src = $new_im;
    }

}

?>