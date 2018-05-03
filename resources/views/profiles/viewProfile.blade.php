{{-- /*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/ --}}

@extends('layouts.layout')

@section('title', 'View Profile')

@section('content')

<div class="row mar-top-5 mar-bot-5">

	@include('layouts.view_profile_sidebar')

	<div class="col-md-8">
		
		@include('layouts.banner')

		<h3 class="mar-bot-5">View Profile</h3>


		@include('components.view_profile.details')

		@include('components.view_profile.accordion')

		@include('components.view_profile.inf_aff_panel')

		@include('components.view_profile.notes')

		@include('components.view_profile.history_table')

	</div>
</div>

@include('components.view_profile.modal_edit_affliate_code')

@include('components.view_profile.hidden_forms')

<script type="text/javascript">
	$(document).ready(function (){
		//Set influencer statuses
		@isset($influencer)
			$('#inf_status').prop('selectedIndex', {{ $influencer->status }});
			$('#inf_follow-up').prop('selectedIndex', {{ $influencer['follow-up'] }});
		@endisset

		//Set affliate statuses
		@isset($affliate)
			$('#aff_status').prop('selectedIndex', {{ $affliate->status }});
			$('#aff_follow-up').prop('selectedIndex', {{ $affliate['follow-up'] }});
		@endisset

		// $('#tableInfHistory').bootstrapTable({
		// 	url: ' route('getInfHistory', $profile->id) ',
		// 	sortName: 'created_at',
		// 	sortOrder: 'desc',
		//     columns: [{
		//         field: 'field_name',
		//         title: 'Type'
		//     }, {
		//         field: 'field_data',
		//         title: 'Data'
		//     }, {
		//         field: 'created_at',
		//         title: 'Date',
		//     }]
		// });

		// $('#tableAffHistory').bootstrapTable({
			// url: ' route('getAffHistory', $profile->id) ',
		// 	sortName: 'created_at',
		// 	sortOrder: 'desc',
		//     columns: [{
		//         field: 'field_name',
		//         title: 'Type'
		//     }, {
		//         field: 'field_data',
		//         title: 'Data'
		//     }, {
		//         field: 'created_at',
		//         title: 'Date',
		//     }]
		// });

		$('#tableNotes').bootstrapTable({
			url: '{{ route('getNotes', $profile->id) }}',
			sortName: 'created_at',
			sortOrder: 'desc',
		    columns: [{
		        field: 'note',
		        title: 'Note'
		    }, {
		        field: 'author_id',
		        title: 'Author'
		    }, {
		        field: 'created_at',
		        title: 'Date of Action'
		    }]
		});

		/*****
		*	Checks Influencer/Affliate status and disables follow-up
		*	if not set to Interested or Emailed
		*****/
		if($('#inf_status').val() != 3 && $('#inf_status').val() != 4){
			$('#inf_follow-up').prop('disabled', true);
		} else {
			$('#inf_follow-up').prop('disabled', false);
		}

		if($('#aff_status').val() != 3 && $('#aff_status').val() != 4){
			$('#aff_follow-up').prop('disabled', true);
		} else {
			$('#aff_follow-up').prop('disabled', false);
		}

		/*****
		*	btnDelete function
		*****/
		$('#btnDelete').on('click', function () {
			swal({
			  title: "Are you sure you wish to delete?",
			  text: "Profile Name: {{ $profile->name }}",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	$("#formDelete").submit();
			  } else {
				    swal({
				    	title: "Account NOT deleted",
				    	icon: "error"
				    });
			  }
			});
		});
		
		/*****
		*	btnDeleteEmail function
		*****/
		$('.btnDeleteEmail').on('click', function () {
			swal({
			  title: "Are you sure?",
			  text: "You are deleting this email",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	$('#formDeleteEmail-id').val(this.value);
			  	$("#formDeleteEmail").submit();
			  } else {
				    swal({
				    	title: "Email NOT deleted",
				    	icon: "error"
				    });
			  }
			});
		});
		
		/*****
		*	btnDeleteWebsite function
		*****/
		$('.btnDeleteWebsite').on('click', function () {
			swal({
			  title: "Are you sure?",
			  text: "You are deleting this website",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	$('#formDeleteWebsite-id').val(this.value);
			  	$("#formDeleteWebsite").submit();
			  	console.log('deleteWebsiteSubmit');
			  } else {
				    swal({
				    	title: "Website NOT deleted",
				    	icon: "error"
				    });
			  }
			});
		});

		$('.btnDeleteAccount').on('click', function () {
			swal({
			  title: "Are you sure?",
			  text: "You are deleting this account",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	$('#formDeleteAccount-id').val(this.value);
			  	$("#formDeleteAccount").submit();
			  } else {
				    swal({
				    	title: "Account NOT deleted",
				    	icon: "error"
				    });
			  }
			});
		});

		$('#mention_yes').on('click', function() {
			swal({
			  title: "Are you sure?",
			  text: "You are setting Mentioned Trackimo status to 'Yes'",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	$('#formSetMentionedProduct-bool').val(1);
			  	$("#formSetMentionedProduct").submit();
			  } else {
				    swal({
				    	title: "Mentioned Trackimo NOT changed",
				    	icon: "error"
				    });
			  }
			});
		});

		$('#mention_no').on('click', function() {
			swal({
			  title: "Are you sure?",
			  text: "You are setting Mentioned Trackimo status to 'No'",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	$('#formSetMentionedProduct-bool').val(0);
			  	$("#formSetMentionedProduct").submit();
			  } else {
				    swal({
				    	title: "Mentioned Trackimo NOT changed",
				    	icon: "error"
				    });
			  }
			});
		});
        
        $('.override-no').on('click', function() {
			swal({
			  title: "OVERRIDING EMAIL SENT STATUS?",
			  text: "Setting Email Sent to 'NO'. Are you sure?",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	$('#formOverrideEmailSent-bool').val(0);
			  	$('#formOverrideEmailSent-class').val(this.value);
			  	$("#formOverrideEmailSent").submit();
			  } else {
				    swal({
				    	title: "Email Sent NOT changed",
				    	icon: "error"
				    });
			  }
			});
		});
        
        $('.override-yes').on('click', function() {
			swal({
			  title: "OVERRIDING EMAIL SENT STATUS?",
			  text: "Setting Email Sent to 'Yes'. Are you sure?",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	$('#formOverrideEmailSent-bool').val(1);
                $('#formOverrideEmailSent-class').val(this.value);
			  	$("#formOverrideEmailSent").submit();
			  } else {
				    swal({
				    	title: "Email Sent NOT changed",
				    	icon: "error"
				    });
			  }
			});
		});

		$('#inf_status').change(function() {
			var class_key = 0;
			var status_type = 0;
			var type_string = "Status";
			var status_key = $(this).val();
			var status_key_string = this.options[this.selectedIndex].text;

			changeStatus($(this), class_key, status_key, status_type, type_string, status_key_string);
		});

		$('#inf_follow-up').change(function() {
			var class_key = 0;
			var status_type = 1;
			var type_string = "Follow-up";
			var status_key = $(this).val();
			var status_key_string = this.options[this.selectedIndex].text;

			changeStatus($(this), class_key, status_key, status_type, type_string, status_key_string);
		});

		$('#aff_status').change(function() {
			var class_key = 1;
			var status_type = 0;
			var type_string = "Status";
			var status_key = $(this).val();
			var status_key_string = this.options[this.selectedIndex].text;

			changeStatus($(this), class_key, status_key, status_type, type_string, status_key_string);
		});

		$('#aff_follow-up').change(function() {
			var class_key = 1;
			var status_type = 1;
			var type_string = "Follow-up";
			var status_key = $(this).val();
			var status_key_string = this.options[this.selectedIndex].text;

			changeStatus($(this), class_key, status_key, status_type, type_string, status_key_string);
		});


		$('#btnToday').change(function() {
			if($('#btnToday').prop('checked')){
				$('#date_of_action').prop('disabled', true);
			} else {	
				$('#date_of_action').prop('disabled', false);
			}
		});
	});

	function changeStatus(elem, class_key, status_key, status_type, type_string, status_key_string)
	{
		swal({
			  title: "You are changing the " + type_string,
			  text: "Attention, you are setting " + type_string + " to " + status_key_string + ". Are you sure?",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((changeStatus) => {
			  if (changeStatus) {
				$('#formChangeStatus-class').val(class_key);
				$('#formChangeStatus-statusKey').val(status_key);
				$('#formChangeStatus-statusType').val(status_type);
				$('#formChangeStatus').submit();
			  } else {
				    swal({
				    	title: type_string + " NOT changed",
				    	icon: "error"
				    });
			  }
		});
	}

</script>

@endsection