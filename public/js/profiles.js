$(document).ready(function() {
	//Load table data from URL
	$('#table').bootstrapTable({
		url: 'getProfiles',
		uniqueId: 'id',
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
});

$('#table').on('click-row.bs.table', function(e, row, $element, field){
	window.location.href = "viewProfile/"+row.id;
});
