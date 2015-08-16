    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo CHtml::encode(Yii::app()->name);?></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?php echo ($this->id=='site'&&$this->action->id=='index')?'class="active"':'';?>><a href="<?php echo $this->createUrl('/site/index');?>"><?php echo Yii::t("basic","Home");?></a></li>
            <?php $navitems = Config::mergeConfig('nav');?>
            <?php if ($navitems):?>
			      <?php $module = isset($this->module)?$this->module->id:'';?>
            <?php foreach ($navitems as $item):?>
              <?php if(isset($item['items'])):?>
                <li class="dropdown <?php echo ($module==$item['module'])?'active':'';?>">
                  <a data-toggle="dropdown" href="#"><?php echo $item['name'];?><b class="caret"></b></a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <?php foreach($item['items'] as $data):?>
                    <li role="presentatioon"><a role="menuitem" tabindex="-1" href="<?php echo $this->createUrl($data['link']);?>"><?php echo $data['name'];?></a></li> 
                    <?php endforeach;?>
                  </ul>
                </li>
              <?php else: ?>
                <li <?php echo ($module==$item['module'])?'class="active"':'';?>><a href="<?php echo $this->createUrl($item['link']);?>"><?php echo $item['name'];?></a></li>
              <?php endif;?>
            <?php endforeach;?>
            <?php endif;?>
            <li <?php echo ($this->id=='site'&&$this->action->id=='page')?'class="active"':'';?>><a href="<?php echo $this->createUrl('/site/page',array('view'=>'about'));?>"><?php echo Yii::t("basic","About");?></a></li>    
            <li <?php echo ($this->id=='site'&&$this->action->id=='contact')?'class="active"':'';?>><a href="<?php echo $this->createUrl('/site/contact');?>"><?php echo Yii::t("basic","Contact");?></a></li>

          </ul>          
         <ul class="nav navbar-nav pull-right">
          	<?php if(Yii::app()->user->isGuest): ?>
          	<li><a href="<?php echo $this->createUrl('/site/login');?>" title="<?php echo Yii::t('basic','Login');?>"><span class=" glyphicon glyphicon-log-in"></span></a></li>
          	<?php else : ?>
          	<li class="dropdown">         
			  <a data-toggle="dropdown" href="#"><?php echo Yii::app()->user->name;?>  <span class="glyphicon glyphicon-cog"></span></a>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo $this->createUrl('/profile/info',array('id'=>Yii::app()->user->id));?>"><?php echo Yii::t('basic','Profile');?></a></li>
			    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
			    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
			    <li role="presentation" class="divider"></li>
			    <li role="presentation"><a  tabindex="-1" href="#">我的应用</a></li>
			    <li role="presentation" class="divider"></li>
			    <?php $list = Config::mergeConfig('quickmenu'); ?>
			    <?php if ($list):?>
			    <?php foreach ($list as $item):?>
			    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo Yii::app()->createUrl($item['link']); ?>"><?php echo $item['name'];?></a></li>
			    <?php endforeach;?>
			    <?php endif;?>
			  </ul>
			</li>         	
          	<?php if (Yii::app()->user->name == 'admin'):?>
          	<li><a href="<?php echo $this->createUrl('/administrator');?>" title="<?php echo Yii::t('basic','Control Panel');?>"><span class="glyphicon glyphicon-th"></span></a></li>
          	<?php endif;?>
          	<li><a href="<?php echo $this->createUrl('/site/logout');?>" title="<?php echo Yii::t('basic','Logout');?>&nbsp;<?php echo Yii::app()->user->name;?>"><span class="glyphicon glyphicon-log-out"></span></a></li>
          	<?php endif;?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>