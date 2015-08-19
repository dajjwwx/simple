YKG.prototype.bootstrap = function(){


	/**
	 *基于bootstrap的Modal
	 *@use <button type="button" class="btn btn-primary" data-whatever="@yuekegu.com">Large modal</button>
     */
	this.showModal = function(data){

		this.html = function(){
			return '<div class="modal fade bs-example-modal-lg" id="'+ this.id +'" role="dialog" aria-labelledby="myLargeModalLabel">'
			  +'<div class="modal-dialog modal-lg">'
			    +'<div class="modal-content">'
			      +'<div class="modal-header">'
			        +'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
			        +'<h4 class="modal-title">'+ this.title +'</h4>'
			      +'</div>'
			      +'<div class="modal-body">'
			        +'<p>'+ this.body +'</p>'
			      +'</div>'
			      +'<div class="modal-footer">'
			        +'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
			        +'<button type="button" class="btn btn-primary">Save changes</button>'
			      +'</div>'
			    +'</div><!-- /.modal-content -->'
			  +'</div><!-- /.modal-dialog -->'
			+'</div><!-- /.modal -->';
		};

		this.id = data.id;
		this.title = data.title;
		this.body = data.body;

		this.showEvent = function(){
			return $("#"+this.id).on('show.bs.modal',function(event){
				data.showEvent(event);
			});
		};

		this.hideEvent = data.hideEvent;

		this.show = function(){

			// alert(this.html());

			$(this.html()).appendTo($("body"));
			
			$(".modal-title").html(this.title);
			$(".modal-body").html(this.body);

			$("#"+this.id).modal('show');

			return this;

		};

		return this;

	}


	return this;

};