<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php 
	$this->widget('ext.slider.BannerWidget');
?>
<hr />
<div class="container marketing">
	<div class="row">
        <div class="col-lg-4">
        	<div  style="width:128px;height:128px;background-image:url('/public/image/books/icos.png');background-attachement:fixed;background-repeat:no-repeat;background-position:2px 0;"></div>
	        <p>让需要书的人方便读书</p>	        
          	<p><a class="btn btn-default" href="#" role="button">View details »</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <div  style="width:128px;height:128px;background-image:url('/public/image/books/icos.png');background-attachement:fixed;background-repeat:no-repeat;background-position:-127px 0;"></div>
          <p>让孩子有更多发展空间.</p>
          <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
           <div  style="width:128px;height:128px;background-image:url('/public/image/books/icos.png');background-attachement:fixed;background-repeat:no-repeat;background-position:-254px 0;"></div>
          <p>让生活从此不再糜烂.</p>
          <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
        </div><!-- /.col-lg-4 -->
      </div>
</div>
<div class="jumbotron">

      <div class="container">
        <h1>Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>
      </div>
</div>
    
    dddd
<?php 

$register = new RegisterForm();
$register->email = 'dajjwwx@gmail.com';

echo explode('@', $register->email)[0];

?>
