$(document).ready(function() {    	// autocomplete of the username (registration form)  	$('.register #username').val( $('.register #firstname').val() + $('.register #lastname').val() );	$('.register #firstname').keyup(function() {		$('.register #username').val( $('.register #firstname').val() + $('.register #lastname').val() );	});	$('.register #lastname').keyup(function() {		$('.register #username').val( $('.register #firstname').val() + $('.register #lastname').val() );	});  	     	// "dispatch" clicking a th to the corresponding anchor  	$('th.sortable').click( function() {    	window.location = $(this).children('a').attr('href');  	});  	  	// the mark all 	$('input[name="mark_all"]').click(function()	{		var checked_status = this.checked;		$('input[name*="marked"]').each(function() {			this.checked = checked_status;		});	}); 	  	  	// dropdown  	$('.table-actions .dropdown a').click(function(event) {  		event.preventDefault();  		$(this).next().slideToggle('fast');  	});   	$('.table-actions  .dropdown-slider li').click(function() {  		var value = $(this).attr('data-value');  		var action = $(this).parent().attr('id');  		action = action.substring(action.indexOf('-')+1);  		$('input[name*='+action+']:not([type=submit]), select[name*='+action+']').each(function() {			$(this).val(value);		});		$(this).parent().slideUp('fast');  	}); 	  	  	// submit search  	$('#users-search .input').keypress(function(event) {  		if( event.keyCode == 13  )  			$('#users-search').submit();  		  	});  	  	// aside filter  	$('.filter input[type="checkbox"]').click( function() {  		if( $(this).is(':checked') ) {  			$(this).parents('li').addClass('active');  		} else {  			$(this).parents('li').removeClass('active');  		}  	});  	  	// modal window 	   	// $('.action.delete').click( function(event) {
   		// event.preventDefault();
   		// var u = $(event.target).attr('data-user');
//    		
 		// var e = $('<div class="modal hide fade" id="modal-delete-user"></div>');
		// $(e).append('<div class="modal-header"><a class="close" href="#">×</a><h3>Delete User</h3></div>');
		// $(e).append('<div class="modal-body">Are you sure you want permantly to delete the user <strong>\''+u+'\'</strong>?</div>');
		// $(e).append('<div class="modal-footer"><a class="btn primary" href="#">Primary</a><a class="btn secondary" href="#">Secondary</a></div>');
		// $('.container').append(e);  		
// 
  		// $('#modal-delete-user').modal({
	    	// keyboard: true,
	    	// backdrop: 'static'
    	// });   	
// 
    	// $('#modal-delete-user').modal('show');
  	// }); 	 });