// $(document).ready(function() {
// 	//Load table data from AJAX call
// 	$.ajax({
//         type: "POST",
//         url: 'getEmployeeData',
//         data: JSON.stringify({id: row.id}),
//         dataType: 'json',
//         processData: false,
//         contentType: 'application/json',
//         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
//     })
// 	.done(function (response){
// 		$('#emailTable').bootstrapTable({
// 			data: 'response',
// 			uniqueId: 'id',
// 		    columns: [{
// 		        field: 'name',
// 		        title: 'Name'
// 		    }, {
// 		        field: 'email',
// 		        title: 'Email'
// 		    }, {
// 		        field: 'website',
// 		        title: 'Website'
// 		    }, {
// 		        field: 'country',
// 		        title: 'Country'
// 		    }]
// 		});
// 	});
// });