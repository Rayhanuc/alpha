var frame;

;(function($){
	$(document).ready(function(){
		$(".omb_dp").datepicker({
	      changeMonth: true,
	      changeYear: true
	    });

		$("#upload_image").on('click',function(){
			if (frame) {
				frame.open();
				return false;
			}

			frame = wp.media({
				title	: "Select Image",
				button : {
					text : "Insert Image"
				},
				multiple: false
			});

			frame.open();
			return false;
		});
	});
})(jQuery);