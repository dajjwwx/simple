<?php
echo Category::model()->generateCheckTreeByType($this->type,array('treeview'=>$this->treeview,'link'=>$this->link),$this->htmlOptions);
?>