$(document).ready(function() {
	$.ajax({
		headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    type: 'GET',
	    url: 'getProfiles',
	    success: function(data) {
			$('#table').bootstrapTable({
				id: 'id',
				data: data,
			    columns: [{
			        field: 'name',
			        title: 'Name'
			    }, {
			        field: 'email',
			        title: 'Email'
			    }, {
			        field: 'website',
			        title: 'Website'
			    }, {
			        field: 'country',
			        title: 'Country'
			    }]
			});
	    }
	});
});
