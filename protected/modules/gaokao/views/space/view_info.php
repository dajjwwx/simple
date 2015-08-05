<h4><span class="glyphicon glyphicon-file"></span>&nbsp;<?php echo CHtml::encode($model->file->name)?></h4>
<p>科目：<?php echo Gaokao::model()->getCourseName($model->course);?></p>
<p class="province">适用省份：<?php echo Gaokao::model()->getProvincesScope($model->province);?></p>
<p>年份：<?php echo $model->year;?>年</p>