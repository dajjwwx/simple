YKG.prototype.bootstrap = function(){


	//基于Bootstrap的Modal
	/**
	 *	new ShowModal({
	 *		'id':'exampleModal',
	 *		'title':'Hello Title',
	 *		'body':'Hello Body'
	 *	}).show();
	 *
	 */
	this.ShowModal = function(data)
	{
		this.id = data.id;
		this.title = data.title;
		this.body = data.body;

		this.show = function(){
			
			$(".modal-title").html(this.title);
			$(".modal-body").html(this.body);
			return $("#"+this.id).modal('show');

		};
	};



};