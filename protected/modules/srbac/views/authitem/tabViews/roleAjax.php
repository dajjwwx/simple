<?php
/**
 * roleAjax.php
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * The assigning task to roles listboxes
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.views.authitem.tabViews
 * @since 1.0.0
 */
 ?>
<table width="100%">
  <tr>
    <th><?php echo Helper::translate('srbac','Assigned Tasks')?></th>
    <th>&nbsp;</th>
    <th><?php echo Helper::translate('srbac','Not Assigned Tasks')?></th>
  </tr>
  <tr><td width="40%">
      <?php echo SHtml::activeDropDownList($model,'name[revoke]',
      SHtml::listData(
      $data["roleAssignedTasks"], 'name', 'name'),
      array('size'=>$this->module->listBoxNumberOfLines,'multiple'=>'multiple','class'=>'dropdown')) ?>
     <?php $data['revoke']['style']=$data['assign']['style']='width:30px;margin:2px;padding:5px;'?>
    </td>
    <td width="10%" align="center"  style="vertical-align:middle;">
      <?php
      $ajax =
          array(
          'type'=>'POST',
          'update'=>'#tasks',
        'beforeSend' => 'function(){
                      $("#loadMessRole").addClass("srbacLoading");
                  }',
        'complete' => 'function(){
                      $("#loadMessRole").removeClass("srbacLoading");
                  }');
      echo  SHtml::ajaxSubmitButton('<<',array('assign','assignTasks'=>1),$ajax,$data['assign']); ?>
      <?php
      $ajax =
          array(
          'type'=>'POST',
          'update'=>'#tasks',
        'beforeSend' => 'function(){
                      $("#loadMessRole").addClass("srbacLoading");
                  }',
        'complete' => 'function(){
                      $("#loadMessRole").removeClass("srbacLoading");
                  }');
      echo  SHtml::ajaxSubmitButton('>>',array('assign','revokeTasks'=>1),$ajax,$data['revoke']); ?>
    </td>
    <td width="40%">
      <?php echo SHtml::activeDropDownList($model,'name[assign]',
      SHtml::listData(
      $data["roleNotAssignedTasks"], 'name', 'name'),
      array('size'=>$this->module->listBoxNumberOfLines,'multiple'=>'multiple','class'=>'dropdown')); ?>
    </td></tr>
</table>
<div id="loadMessRole" class="message">
  <?php echo "&nbsp;".$message ?>
</div>
