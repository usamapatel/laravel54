$(document).ready(function() {
	$(document).on('keyup', '#company_name', function(){
        $.ajax({
	        url: '/company/generateSlug',
	        data: { 'company_name' : $("#company_name").val() },
	        type: 'POST',
	        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
	    }).done(function(response) {
			$("#company_slug").val(response);
		});
    });
});