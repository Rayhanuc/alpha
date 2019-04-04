;(function($){
    $(document).ready(function(){
        $("#post-formats-select .post-format").on("click", function(){
            if($(this).attr("id") == "post-format-image") {
                $("#_alpha_image_").show();
            }else {
                $("#_alpha_image_").hide()
            }
        });
        if(alpha_pf.format!="image") {
            $("#_alpha_image_").hide()
        }
    });
})(jQuery);