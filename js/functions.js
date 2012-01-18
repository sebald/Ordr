$(document).ready(function() {    	// autocomplete of the username (registration form)  	$('.register #username').val( $('.register #firstname').val() + $('.register #lastname').val() );	$('.register #firstname').keyup(function() {		$('.register #username').val( $('.register #firstname').val() + $('.register #lastname').val() );	});	$('.register #lastname').keyup(function() {		$('.register #username').val( $('.register #firstname').val() + $('.register #lastname').val() );	});  	     	// "dispatch" clicking a th to the corresponding anchor  	$('th.sortable').click( function() {    	window.location = $(this).children('a').attr('href');  	});  	  	// the mark all 	$('input[name="mark_all"]').click(function()	{		var checked_status = this.checked;		$('input[name*="marked"]').each(function() {			this.checked = checked_status;		});		if( $('input[name="mark_all"]').is(':checked') && $('.marking-needed').is(':hidden') ) {  			$('.marking-needed').fadeIn("slow");  		} else if( $('input[name="mark_all"]').is(':checked') && $('.marking-needed').is(':visible') ) {  			// do nothing  		} else {  			$('.marking-needed').fadeOut("slow");  		}			}); 	  	  	// show actions only if some data is marked  	$('input[name*="marked"]').change(function() {  		if( $('input[name*="marked"]').is(':checked') ) {  			if( $('.marking-needed').is(':hidden') )  				$('.marking-needed').fadeIn("slow");  		} else {  			$('.marking-needed').fadeOut("slow");  		}	});  	  	// quick-actions  	$('.quick-action a[data-value]').click(function(event) {  		event.preventDefault();  		var value = $(this).attr('data-value');  		var action = $(this).closest('div').attr('data-action');  		$('select[name*='+action+']').each(function() {			$(this).val(value);		});  	});	  	  	// submit search  	$('.search-form input[type="search"]').keypress(function(event) {  		if( event.keyCode == 13  )  			$('.search-form').submit();  		  	});  	  	// aside filter  	$('.filter input[type="checkbox"]').click( function() {  		if( $(this).is(':checked') ) {  			$(this).parents('li').addClass('active');  		} else {  			$(this).parents('li').removeClass('active');  		}  	});	// tooltips	$('.page-controls').tooltip({		selector: "[rel=tooltip]"	}); 		// calculator	if( $('input[name="price_unit"]').val() != '' && $('input[name="quantity"]').val() != '' ){		var total = $('input[name="price_unit"]').val().replace(",", ".") * $('input[name="quantity"]').val();		total = Math.round(total*100)/100;		$('input[name="price_total_disabled"]').attr( 'placeholder', total );		}	$('input[name="price_unit"], input[name="quantity"]').keyup(function() {		var total = $('input[name="price_unit"]').val().replace(",", ".") * $('input[name="quantity"]').val();		total = Math.round(total*100)/100;		$('input[name="price_total_disabled"]').attr( 'placeholder', total );	});		// added currency to total price	if( $('input[name="currency"]').val() != '' ){		$('input[name="currency_disabled"]').attr( 'placeholder', $('input[name="currency"]').val() );	}	$('input[name="currency"]').keyup(function() {		$('input[name="currency_disabled"]').attr( 'placeholder', $('input[name="currency"]').val() );	});		$('input[name="currency"]').change(function() {		$('input[name="currency_disabled"]').attr( 'placeholder', $('input[name="currency"]').val() );	}); });