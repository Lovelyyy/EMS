$( document ).ready(function() {
	$( "employee#delete-btn" ).click(function(e) {
    	var id = $(this).attr('data-target');
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover the data for this employee!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			closeOnConfirm: false },
			function() {
				$.ajax({
					url: $('base').attr('href') + '/employee/' + id +'/delete',
					type: 'delete',
					success: function(employee) {
						swal({
							title: "Deleted!", 
							text: "The following employee has been deleted:\n" +
									employee['employee_no'] + ": " +
									employee['firstname'] + " " +
									employee['lastname'], 
							type: "success"},
							function() {
								window.location.reload();						
						}); 
		        	}
		    	});
			});
	});
	$( "position#delete-btn" ).click(function(e) {
    	var id = $(this).attr('data-target');
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover the data for this position!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			closeOnConfirm: false },
			function() {
				$.ajax({
					url: $('base').attr('href') + '/position/' + id +'/delete',
					type: 'delete',
					success: function(position) {
						swal({
							title: "Deleted!", 
							text: "The following position has been deleted:\n" +
									position['dept_name'] + ": " +
									position['position_name'], 
							type: "success"},
							function() {
								window.location.reload();						
						}); 
		        	}
		    	});
			});
	});
	$( "department#delete-btn" ).click(function(e) {
    	var id = $(this).attr('data-target');
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover the data for this position!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			closeOnConfirm: false },
			function() {
				$.ajax({
					url: $('base').attr('href') + '/department/' + id +'/delete',
					type: 'delete',
					success: function(department) {
						swal({
							title: "Deleted!", 
							text: "The following position has been deleted:\n" +
									department['dept_name'],
							type: "success"},
							function() {
								window.location.reload();						
						}); 
		        	}
		    	});
			});
	});
});