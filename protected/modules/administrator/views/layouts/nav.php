    <div class="navbar navbar-inverse " role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo Yii::app()->homeUrl;?>"><?php echo CHtml::encode(Yii::app()->name);?></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?php echo ($this->id=='site'&&$this->action->id=='index')?'class="active"':'';?>><a href="<?php echo $this->createUrl('default/index');?>"><?php echo Yii::t("basic","Home");?></a></li>
            <li <?php echo ($this->id=='space'?'class="active"':''); ?>><a href="<?php echo $this->createUrl('/space/index');?>"><?php echo Yii::t('basic','Courses')?></a>
            <li <?php echo ($this->id=='site'&&$this->action->id=='page')?'class="active"':'';?>><a href="<?php echo $this->createUrl('/site/page',array('view'=>'about'));?>"><?php echo Yii::t("basic","About");?></a></li>
            <li <?php echo ($this->id=='site'&&$this->action->id=='contact')?'class="active"':'';?>><a href="<?php echo $this->createUrl('/site/contact');?>"><?php echo Yii::t("basic","Contact");?></a></li>
          </ul>
          <ul class="nav navbar-nav pull-right">
            <li class="dropdown">         
			  <a data-toggle="dropdown" href="#">Dropdown trigger<span class="caret"></span></a>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
			    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
			    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
			    <li role="presentation" class="divider"></li>
			    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
			  </ul>
			</li>

          	<?php if(Yii::app()->user->isGuest): ?>
          	<li><a href="<?php echo $this->createUrl('/site/login');?>"><?php echo Yii::t('basic','Login');?></a></li>
          	<?php else : ?>
          	<li><a href="<?php echo $this->createUrl('/site/logout');?>"><?php echo Yii::t('basic','Logout');?></a></li>
          	<?php endif;?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>