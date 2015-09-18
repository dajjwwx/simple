<?php
/**
 *
 * @author Administrator
 *        
 */
class CommentWidget extends CWidget {
	
	public $view = 'list';
	
	public $id = NULL;
	public $type = NULL;
	public $status = NULL;
	
	public function commentNested($model, &$html='')
	{
	
		$html .= <<<DOM
		<div class="media">
		<a class="pull-left" href="#">
		<img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjZWVlIi8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzIiIHk9IjMyIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9zdmc+" style="width: 64px; height: 64px;" class="media-object" data-src="holder.js/64x64" alt="64x64">
		</a>
		<div class="media-body">
		<br />
		
DOM;
// 		if ($model->status == Comment::COMMENT_PUBLISHED) {
// 			$html .= '<span class="glyphicon glyphicon-ok-circle"></span>';
// 		} elseif ($model->status == Comment::COMMENT_LOCK) {
// 			$html .= '<span class="glyphicon glyphicon-ban-circle"></span>';
// 		}
	
		$html .=  $model->content;
	
		// 	$html .= '<small><a href="'.Yii::app()->createUrl('/administrator/comment/reply',array('id'=>$model->id)).'">回复</a></small>';
		
		if(!Yii::app()->user->isGuest){
		
			$html .=  '<p>
					<small>';
			
			//显示审核状态图标
			if($model->status == Comment::COMMENT_PUBLISHED){			
				$html .= '<a class="status" data-id="'.$model->id.'" data-href="'. Yii::app()->createUrl('/administrator/comment/update',array('id'=>$model->id,'')).'" onclick="update($(this));"  href="javascript:void(0);">
				      			<span class="glyphicon glyphicon-ok-circle" title="已通过审核，点击取消审核"></span>
				      		</a>';			
			} elseif ($model->status == Comment::COMMENT_LOCK) {
				$html .= '<a class="status" data-id="'.$model->id.'" data-href="'. Yii::app()->createUrl('/administrator/comment/update',array('id'=>$model->id)).'" onclick="update($(this));"  href="javascript:void(0);">
				      			<span class="glyphicon glyphicon-ban-circle" title="未通过审核，点击审核通过"></span>
				      		</a>';			
			}
			
			$html .= '
	      		&nbsp;
	      		<a class="reply" data-id="'.$model->id.'" data-href="'. Yii::app()->createUrl('/administrator/comment/reply',array('id'=>$model->id)).'" onclick="reply($(this),\''.Comment::COMMENT_TYPE_BLOG.'\');"  href="javascript:void(0);">
	      			<span class="glyphicon glyphicon-send" title="回复"></span>
	      		</a>
	      		&nbsp;
	      		<a class="delete" data-id="'. $model->id.'" data-href="'. Yii::app()->createUrl('/administrator/comment/trash',array('id'=>$model->id)).'" onclick="trash($(this));"  href="javascript:void(0);">
	      			<span class="glyphicon glyphicon-trash" title="删除此条评论"></span>
	      		</a>
		
	      	</small>
	      	</p>';
		}
	
		if($model->comments)
		{
			foreach ($model->comments as $data)
			{
				$this->commentNested($data,$html);
			}
		}
	
		$html .= '
		</div>
	</div>';
	
		return $html;
	}
	
	
	public function commentList()
	{
		$criteria = new CDbCriteria(array(
				'condition'=>'ctype = :ctype',
				'order'=>'id DESC',
				'params'=>array(
					':ctype'=>$this->type == NULL ? Comment::COMMENT_TYPE_BLOG :$this->type,
		)));
		
		if ($this->id == NULL) {
			$criteria->addCondition('cid IS NOT NULL');
		} else {
			$criteria->addCondition('cid = '. $this->id);
		}
		
		if($this->status != NULL) {
			$criteria->addCondition('status = '. $this->status);
		}
		
		$dataProvider=new CActiveDataProvider('Comment',array(
				'criteria'=>$criteria
		));
		
		return $dataProvider;
	}
	
	public function commentForm()
	{
		$model = new Comment();		
		return $model;
	}
	
	public function getData()
	{
		if ($this->view == 'list') {
			return $this->commentList();
		} else if ( $this->view == 'form') {
			return $this->commentForm();
		}
	}
	
	
	public function run()
	{		
		$this->render($this->view,array(
				'model'=>$this->getData()
		));
	}
	
}

?>