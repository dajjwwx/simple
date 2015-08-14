<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Bootstrap -->
    <link href="/public/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/public/css/style.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="background-color:#f6f4f7;">
    <?php echo $content;?>
    <?php Yii::app()->clientScript->registerCoreScript('jquery');?>
    <?php  Yii::app()->getClientScript()->registerScriptFile('/public/js/bootstrap.min.js');?>
     <?php  Yii::app()->getClientScript()->registerScriptFile('/public/js/browser.js');?>
    <?php 	
    	$this->registerScripts();
    ?>
  </body>
</html>