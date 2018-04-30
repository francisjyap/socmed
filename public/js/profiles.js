$(document).ready(function() {
	//Load table data from URL
	$('#table').bootstrapTable({
		url: 'getProfiles',
		uniqueId: 'id',
		search: true,
	    columns: [{
	        field: 'name',
	        title: 'Name'
	    }, {
	        field: 'company_name',
	        title: 'Company Name'
	    }, {
	        field: 'phone_number',
	        title: 'Phone Number'
	    }, {
	        field: 'country',
	        title: 'Country'
	    }, {
	        field: 'is_influencer',
	        title: 'Influencer',
	        searchable: false,
	        cellStyle: function(value) {
	        	if(value == 'Yes'){
	        		return{
	        			css: {'color': 'green'}
	        		}
	        	} else {
	        		return{
	        			css: {'color': 'red'}
	        		}
	        	}
	        }
	    }, {
	        field: 'is_affliate',
	        title: 'Affliate',
	        searchable: false,
	        cellStyle: function(value) {
	        	if(value == 'Yes'){
	        		return{
	        			css: {'color': 'green'}
	        		}
	        	} else {
	        		return{
	        			css: {'color': 'red'}
	        		}
	        	}
	        }
	    }]
	});
});

$('#table').on('click-row.bs.table', function(e, row, $element, field){
	window.location.href = "viewProfile/"+row.id;
});

$('#btnResetFilter').on('click', function() {
	$('#selectType').prop('selectedIndex', 0);
	$('#selectInfAff').prop('selectedIndex', 0);
	refreshTableWithSelectValues();
});

$('#selectType').change(function() {
	refreshTableWithSelectValues();
});

$('#selectInfAff').change(function() {
	refreshTableWithSelectValues();
});

function refreshTableWithSelectValues()
{
	console.log('profileSort/' + $('#selectType').val() + '/' + $('#selectInfAff').val());
	$('#table').bootstrapTable('refresh', {
		silent: true,
		url: 'profileSort/' + $('#selectType').val() + '/' + $('#selectInfAff').val(),
	});
}
