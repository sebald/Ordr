$(document).ready(function() {    // topbar dropdown  $('.topbar').dropdown();    // autocomplete of the username (registration form)  $('.register #username').val( $('.register #firstname').val() + $('.register #lastname').val() );	$('.register #firstname').keyup(function() {	  $('.register #username').val( $('.register #firstname').val() + $('.register #lastname').val() );	});	$('.register #lastname').keyup(function() {	  $('.register #username').val( $('.register #firstname').val() + $('.register #lastname').val() );	});  	     // "dispatch" clicking a th to the corresponding anchor  $('.sortable th').click( function() {    window.location = $(this).children('a').attr('href');  });   });