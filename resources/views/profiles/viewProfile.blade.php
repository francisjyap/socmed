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

<div class="row mar-bot-5">
	<div class="col-md-2 mar-top-5 mar-bot-5">
		<a href="{{ route("home") }}" class="btn btn-danger mar-bot-5 width-100"><i class="fas fa-arrow-left"></i> Back to Profiles</a>
		<a href="{{ route("editProfile", $profile->id)}}" class="btn btn-success mar-bot-5 width-100"><i class="far fa-edit"></i> Edit Profile</a>
		<a href="{{ route("addEmail", $profile->id)}}" class="btn btn-success mar-bot-5 width-100"><i class="fas fa-plus"></i> Add Email</a>
		<a href="{{ route("addWebsite", $profile->id)}}" class="btn btn-success mar-bot-5 width-100"><i class="fas fa-plus"></i> Add Wesbite</a>
		<a href="{{ route("addAccount", $profile->id)}}" class="btn btn-success mar-bot-5 width-100"><i class="fas fa-plus"></i> Add Account</a>
		<button type="button" class="btn btn-danger mar-top-30 mar-bot-5 width-100" id="btnDelete"><i class="far fa-trash-alt"></i> Delete Account</button>
	</div>

	<div class="col-md-8">
		@if(session('status'))
            <div class="alert alert-{{ session('type') }}" role="alert" style="margin-top: 2%">
              {{ session('msg') }}
            </div>
        @endif

		<h3 class="mar-top-5 mar-bot-5">View Profile</h3>

		<div class="row">
			<div class="col-md-6">
				<h5>Name: {{ $profile->name }}</h5>
				<h5>Primary Email: {{ $profile->email }}</h5>
				<h5>Primary Website: <a href="{{ $profile->website }}" target="_blank">{{ $profile->website }}</a></h5>
				<h5>Country: {{ $profile->country }}</h5>
			</div>

			<div class="col-md-6">
				<h5>Email Sent?:
					<table class="table table-condensed table-bordered">
						<thead>
							<tr>
								<th>Influencer</th>
								<th>Affliate</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									@if($influencer->status == 4 || $influencer['follow-up'] == 4)
										<p style="color: green">Yes</p>
									@else
										<p style="color: red">No</p>
									@endif
								</td>
								<td>
									@if($affliate->status == 4 || $affliate['follow-up'] == 4)
										<p style="color: green">Yes</p>
									@else
										<p style="color: red">No</p>
									@endif
								</td>
							</tr>
						</tbody>
					</table>
				</h5>
				<h5>Is Affliate?: 
					@if($profile->is_affliate == 0)
						<p style="color: red">No</p>
					@else
						<p style="color: green">Yes</p>
					@endif
				</h5>
				<h5>Is Influencer?: 
					@if($profile->is_influencer == 0)
						<p style="color: red">No</p>
					@else
						<p style="color: green">Yes</p>
					@endif
				</h5>
				<div>
					<button id="mention_no" class="btn btn-danger" style="float: right;"
					@if($profile->mentioned_product == 0)
						disabled
					@endif
					><i class="fas fa-times"></i></button>
					<button id="mention_yes" class="btn btn-success" style="float: right;"
					@if($profile->mentioned_product == 1)
						disabled
					@endif
					><i class="fas fa-check"></i></button>
					<h5>Mentioned Trackimo?: 
						@if($profile->mentioned_product == 0)
							<p style="color: red">No</p>
						@else
							<p style="color: green">Yes</p>
						@endif
					</h5>
				</div>
			</div>
		</div>


		<div id="accordion">
			<div class="card">
				<div class="card-header" id="headingTwo">
				  <h5 class="mb-0">
				    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						<h5 style="text-align: center;">List of Emails</h5>
				    </button>
				  </h5>
				</div>
				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
					<div class="card-body">
						<h5 style="text-align: center;">List of Emails</h5>
						<table id="emailTable" class="table table-bordered" data-toggle="table" data-pagination="true" data-page-size="7" data-search="true">
							<thead>
								<tr>
									<th data-field="email">List of Emails</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($emails as $email)
									<tr>
										<td>{{ $email->email }}</td>
										<td>
											<div class="btn-group">
												<a href="{{ route('editEmail', $email->id) }}" class="btn btn-success"> Edit</a>
												<button type="button" class="btn btn-danger btnDeleteEmail" value="{{ $email->id }}"> Delete</button>
											</div>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header" id="headingWebsite">
				  <h5 class="mb-0">
				    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseWebsite" aria-expanded="false" aria-controls="collapseWebsite">
						<h5 style="text-align: center;">List of Websites</h5>
				    </button>
				  </h5>
				</div>
				<div id="collapseWebsite" class="collapse" aria-labelledby="headingWebsite" data-parent="#accordion">
					<div class="card-body">
						<h5 style="text-align: center;">List of Websites</h5>
						<table id="emailTable" class="table table-bordered" data-toggle="table" data-pagination="true" data-page-size="7" data-search="true">
							<thead>
								<tr>
									<th data-field="email">List of Websites</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($websites as $website)
									<tr>
										<td><a href="{{ $website->website }}" target="_blank">{{ $website->website }}</a></td>
										<td>
											<div class="btn-group">
												<a href="{{ route('editWebsite', $website->id) }}" class="btn btn-success"> Edit</a>
												<button type="button" class="btn btn-danger btnDeleteWebsite" value="{{ $website->id }}"> Delete</button>
											</div>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header" id="headingThree">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							<h5 style="text-align: center;">List of Social Media Accounts</h5>
						</button>
					</h5>
				</div>
				<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
					<div class="card-body">
						<h5 style="text-align: center;">List of Social Media Accounts</h5>
						<table id="socmedTable" class="table table-bordered" data-toggle="table" data-pagination="true" data-page-size="10" data-search="true">
							<thead>
								<tr>
									<th>Type</th>
									<th>Username</th>
									<th>URL</th>
									<th>Followers</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($socmed as $s)
									<tr>
										@foreach($types as $t)
											@if($t->id == $s->type)
												<td>{{ $t->name }}</td>
												@break
											@endif
										@endforeach
										<td>{{ $s->username }}</td>
										<td><a href="{{ $s->url }}" target="_blank">{{ $s->url }}</a></td>
										<td>{{ number_format($s->followers) }}</td>
										<td>
											<div class="btn-group">
												<a href="{{ route('editAccount', $s->id) }}" class="btn btn-success"> Edit</a>
												<button type="button" class="btn btn-danger btnDeleteAccount" value="{{ $s->id }}"> Delete</button>
											</div>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 mar-top-5">
			<div class="row">
				<div class="col-md-6">
					<h5 style="text-align: center;">Influencer</h5>
					<a href="{{ route('editInf', $profile->id) }}" class="btn btn-success" style="width: 100%;">Edit</a>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" id="inf_status">
									<option value="0">N/A</option>
									<option value="1">Done</option>
									<option value="2">Declined</option>
									<option value="3">Interested</option>
									<option value="4">Emailed</option>
									<option value="5">Rejected</option>
								</select>
							</div>
							<div class="form-group">
								<label>Follow-up</label>
								<select class="form-control" id="inf_follow-up">
									<option value="0">N/A</option>
									<option value="1">Done</option>
									<option value="2">Declined</option>
									<option value="3">Interested</option>
									<option value="4">Emailed</option>
									<option value="5">Rejected</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Status Date</label>
								<p id="inf_status_date" style="margin-top: 3%;">N/A</p>
							</div>
							<div class="form-group">
								<label style="margin-top: 7%;">Follow-up Date</label>
								<p id="inf_follow-up_date" style="margin-top: 3%;">N/A</p>
							</div>
						</div>
						<div class="col-md-12">
							<h5 style="text-align: center;">History</h5>
							<a href="{{ route("createInfluencer", $profile->id)}}" class="btn btn-success mar-bot-5 width-100">Add History</a>
							<table id="tableInfHistory" data-pagination="true" data-page-size="5"></table>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<h5 style="text-align: center;">Affliate</h5>
					<a href="{{ route('editAff', $profile->id) }}" class="btn btn-success" style="width: 100%;">Edit</a>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" id="aff_status">
									<option value="0">N/A</option>
									<option value="1">Done</option>
									<option value="2">Declined</option>
									<option value="3">Interested</option>
									<option value="4">Emailed</option>
									<option value="5">Rejected</option>
								</select>
							</div>
							<div class="form-group">
								<label>Follow-up</label>
								<select class="form-control" id="aff_follow-up">
									<option value="0">N/A</option>
									<option value="1">Done</option>
									<option value="2">Declined</option>
									<option value="3">Interested</option>
									<option value="4">Emailed</option>
									<option value="5">Rejected</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Status Date</label>
								<p id="aff_status_date" style="margin-top: 3%;">N/A</p>
							</div>
							<div class="form-group">
								<label style="margin-top: 7%;">Follow-up Date</label>
								<p id="aff_follow-up_date" style="margin-top: 3%;">N/A</p>
							</div>
						</div>
						<div class="col-md-12">
							<h5 style="text-align: center;">History</h5>
							<a href="{{ route("createAffliate", $profile->id)}}" class="btn btn-success" style="margin-bottom: 5%; width: 100%;">Add History</a>
							<table id="tableAffHistory" data-pagination="true" data-page-size="5"></table>
						</div>
					</div>
				</div>
			</div>
		</div>

		{{-- Notes --}}
		<div class="col-md-12" style="margin-top: 5%;">
			<h5 style="text-align: center;">Notes</h5>
			<form method="POST" action="{{ route('addNote') }}">
				@csrf
				<input type="hidden" name="profile_id" value="{{ $profile->id }}">
				<div class="form-group">
					<textarea name="note" class="form-control" required></textarea>
				</div>
				<div class="form-group" style="text-align: center;">
					<label>Date of Action</label>
					<input type="date" name="date_of_action" id="date_of_action" class="form-control">
					<input type="checkbox" name="btnToday" id="btnToday" class="form-check-input" value="true">
					<label class="form-check-label">Today</label>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success" style="float: right; margin-bottom: 5%;"><i class="fas fa-check"></i> Submit</button>
				</div>
			</form>
		</div>

		<div class="col-md-12" style="margin-top: 5%;">
			<h5>History</h5>
			<table id="tableNotes" data-pagination="true" data-page-size="5" required"></table>
		</div>

	</div>
</div>

<form id="formDelete" method="POST" action="{{ route('deleteProfile') }}" hidden="true">
	@csrf
	<input type="hidden" name="id" id="formDelete-id" value="{{ $profile->id }}">
</form>

<form id="formDeleteEmail" method="POST" action="{{ route('deleteEmail') }}" hidden="true">
	@csrf
	<input type="hidden" name="id" id="formDeleteEmail-id" value="">
</form>

<form id="formDeleteWebsite" method="POST" action="{{ route('deleteWebsite') }}" hidden="true">
	@csrf
	<input type="hidden" name="id" id="formDeleteWebsite-id" value="">
</form>

<form id="formDeleteAccount" method="POST" action="{{ route('deleteAccount') }}" hidden="true">
	@csrf
	<input type="hidden" name="id" id="formDeleteAccount-id" value="">
</form>

<form id="formChangeStatus" method="POST" action="{{ route('changeStatus') }}" hidden="true">
	@csrf
	<input type="hidden" name="profile_id" value="{{ $profile->id }}">
	<input type="hidden" name="class" id="formChangeStatus-class" value="">
	<input type="hidden" name="status_key" id="formChangeStatus-statusKey" value="">
	<input type="hidden" name="status_type" id="formChangeStatus-statusType" value="">
</form>

<form id="formSetMentionedProduct" method="POST" action="{{ route('setMentionedProduct') }}" hidden="true">
	@csrf
	<input type="hidden" name="profile_id" id="formSetMentionedProduct-id" value="">
	<input type="hidden" name="bool" id="formSetMentionedProduct-bool" value="">
</form>

<script type="text/javascript">
	$(document).ready(function (){
		//Set influencer statuses
		$('#inf_status').prop('selectedIndex', {{ $influencer->status }});
		$('#inf_follow-up').prop('selectedIndex', {{ $influencer['follow-up'] }});
		$('#inf_status_date').text('@if($influencer->status_date != null) {{ substr($influencer->status_date,0,11) }} @else N/A @endif')
		$('#inf_follow-up_date').text('@if($influencer["follow-up_date"] != null) {{ substr($influencer["follow-up_date"],0,11) }} @else N/A @endif')

		//Set affliate statuses
		$('#aff_status').prop('selectedIndex', {{ $affliate->status }});
		$('#aff_follow-up').prop('selectedIndex', {{ $affliate['follow-up'] }});
		$('#aff_status_date').text('@if($affliate->status_date != null) {{ substr($affliate->status_date,0,11) }} @else N/A @endif')
		$('#aff_follow-up_date').text('@if($affliate["follow-up_date"] != null) {{ substr($affliate["follow-up_date"],0,11) }} @else N/A @endif')

		$('#tableInfHistory').bootstrapTable({
			url: '{{ route('getInfHistory', $profile->id) }}',
			sortName: 'created_at',
			sortOrder: 'desc',
		    columns: [{
		        field: 'field_name',
		        title: 'Type'
		    }, {
		        field: 'field_data',
		        title: 'Data'
		    }, {
		        field: 'created_at',
		        title: 'Date',
		    }]
		});

		$('#tableAffHistory').bootstrapTable({
			url: '{{ route('getAffHistory', $profile->id) }}',
			sortName: 'created_at',
			sortOrder: 'desc',
		    columns: [{
		        field: 'field_name',
		        title: 'Type'
		    }, {
		        field: 'field_data',
		        title: 'Data'
		    }, {
		        field: 'created_at',
		        title: 'Date',
		    }]
		});

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
			  	$('#formSetMentionedProduct-id').val({{ $profile->id }});
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
			  	$('#formSetMentionedProduct-id').val({{ $profile->id }});
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