$(document).ready(function() {    	// topbar dropdown  	$('.topbar').dropdown();    	// autocomplete of the username (registration form)  	$('.register #username').val( $('.register #firstname').val() + $('.register #lastname').val() );	$('.register #firstname').keyup(function() {		$('.register #username').val( $('.register #firstname').val() + $('.register #lastname').val() );	});	$('.register #lastname').keyup(function() {		$('.register #username').val( $('.register #firstname').val() + $('.register #lastname').val() );	});  	     	// "dispatch" clicking a th to the corresponding anchor  	$('th.sortable').click( function() {    	window.location = $(this).children('a').attr('href');  	});  	  	// modal window 	   	// $('.action.delete').click( function(event) {
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