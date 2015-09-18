<h4><span class="glyphicon glyphicon-file"></span>&nbsp;&nbsp;<?php echo CHtml::encode($model->file->name);?></h4>
<p>科目：<?php echo Gaokao::model()->getCourseName($model->course);?></p>
<p class="province">适用省份：<?php echo Gaokao::model()->getProvincesScope($model->papername->provinces);?></p>
<p>年份：<?php echo $model->year;?>年</p>
<p>文件属性：<?php echo UtilFileInfo::formatSize($model->file->size);?></p>
<p>上传时间：<?php echo date('Y/m/d',$model->file->created);?></p>