var isSlugNameChanged = false;
$(document).ready(function() {
	$(document).on('keyup', '#company_name', debounce(function(){
        if ($(this).val() !== "" && isSlugNameChanged == false) {
	        $.ajax({
		        url: '/company/generateSlug',
		        data: { 'company_name' : $("#company_name").val() },
		        type: 'POST',
		        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		    }).done(function(response) {
				$("#company_slug").val(response);
			});
		}
    },500));

    $("#company_slug").blur(function(){
    	isSlugNameChanged = true
    });

    //http://davidwalsh.name/javascript-debounce-function
	function debounce(func, wait, immediate) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	};
});