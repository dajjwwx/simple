
<form class="form" role="form" id="books-form" method="get">
	<div class="row">
		<div class="col-md-4">
			<p class="note">请输入要查询书籍的ISBN码：</p>
			<div class="form-group">
				<input size="32" maxlength="32" class="form-control" placeholder="isbn" name="Books[isbn13]" value="<?php echo $_GET['Books']['isbn13'];?>" id="Books_isbn" type="text" />
			</div>
		</div>
		<div class="row col-md-8">
			<div class="col-md-6"id="preview">
				<img src="/public/image/bookcover.jpg" class="img-thumbnail" />
			</div>
			<div class="col-md-6">
				<p>书名：<em id="title" style="color:red;font-size:18px;font-weight:bolder;"></em></p>
				<p>作者：<span id="author"></span></p>
				<p>价格：&yen;<span id="price"></span>元</p>
				<p>出版社：<span id="publisher"></span></p>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">

function callback(data){

// 	$("#preview").html(data.image);
// 	alert(data.image);
// 	console.log(data);
}

$(function(){


	$("#preview").ajaxStart(function(){
		$(this).html('正在努力加载……');
	});

	$("#Books_isbn").focus().blur(function(e){

		e.preventDefault();

		var isbn = $(this).val();
		var url = "https://api.douban.com/v2/book/isbn/:"+isbn;

		$.ajax({
			'url':url,
			'dataType':'jsonp',
			'jsonp':'callback',
			'success':function(data){				
				$("#submit").removeAttr('disabled');
				$("#preview").html('<img style="width:100%;" class="img-thumbnail"  src='+data.images.large+' />');
				$("#price").text(parseFloat(data.price).toFixed(2));
				$("#title").text(data.title);
				$("#publisher").text(data.publisher);
				$("#author").text(data.author);

				console.log(data);
			}
		});

		$.get('/books/space/addbooks.html', {'id':'<?php echo $_GET['id'];?>','isbn13':$(this).val()}, function(message){
			console.log(message);					
		});

	});
});

</script>
