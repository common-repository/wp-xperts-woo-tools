jQuery(document).ready(function(){
    jQuery('.wx-tools-section h3').click(function(e){
        var parentDiv   =   jQuery(this).closest('.wx-tools-section')
        parentDiv.toggleClass('wx-active-section');
        parentDiv.children('.wx-tools-section-fields').toggleClass('fields-active');
    });


})
