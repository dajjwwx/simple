<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Bootstrap -->
    <link href="/public/css/bootstrap.min.css" rel="stylesheet">


  </head>
  <body>
    <?php echo $content;?>

    <?php Yii::app()->clientScript->registerCoreScript('jquery');?>
    <?php Yii::app()->getClientScript()->registerScriptFile('/public/js/bootstrap.min.js');?>
    <?php $this->registerScripts();?>
  </body>
</html>