$(document).ready(function(){
    $(document).on('click','[data-toggle="modal"]', function(e){
        var target_modal_element = $(e.currentTarget).data('content');
        var target_modal = $(e.currentTarget).data('target');

        var modal = $(target_modal);
        var modalBody = $(target_modal + ' .modal-content');
    
        console.clear();
        
        modalBody.load(target_modal_element);
    })
})