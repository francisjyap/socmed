@extends('layouts.layout')

@section('title', 'View Profile')

@section('content')

<div class="row" style="margin-bottom: 10%;">
	<div class="col-md-2" style="margin-top: 5%;">
		<a href="{{ route("home") }}" class="btn btn-danger" style="margin-bottom: 5%; width: 100%;"><i class="fas fa-arrow-left"></i> Back to Profiles</a>
		<a href="{{ route("editProfile", $profile->id)}}" class="btn btn-success" style="margin-bottom: 5%; width: 100%;"><i class="far fa-edit"></i> Edit Profile</a>
		<a href="{{ route("addEmail", $profile->id)}}" class="btn btn-success" style="margin-bottom: 5%; width: 100%;"><i class="fas fa-plus"></i> Add Email</a>
		<a href="{{ route("addAccount", $profile->id)}}" class="btn btn-success" style="margin-bottom: 5%; width: 100%;"><i class="fas fa-plus"></i> Add Account</a>
		<button type="button" class="btn btn-danger" id="btnDelete" style="margin-top: 30%; margin-bottom: 5%; width: 100%;"><i class="far fa-trash-alt"></i> Delete Account</button>
	</div>

	<div class="col-md-8">

		<div class="col-md-12" style="text-align: ; margin-top: 5%;">
			@if(session('status'))
	            <div class="alert alert-{{ session('type') }}" role="alert">
	              {{ session('msg') }}
	            </div>
	        @endif
			<h3 style="margin-top: 5%; margin-bottom: 5%;">View Profile</h3>
			<div class="row">			
				<div class="col-md-6">
					<h5>Name: {{ $profile->name }}</h5>
					<h5>Primary Email: {{ $profile->email }}</h5>
					<h5>Website: <a href="{{ $profile->website }}" target="_blank">{{ $profile->website }}</a></h5>
					<h5>Country: {{ $profile->country }}</h5>
					<h5>Email Sent?: 
						@if($profile->email_sent == 0)
							<p style="color: red">No</p>
						@else
							<p style="color: green">Yes</p>
						@endif
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
					<h5>Mentioned Trackimo?: 
						@if($profile->mentioned_product == 0)
							<p style="color: red">No</p>
						@else
							<p style="color: green">Yes</p>
						@endif
					</h5>
				</div>

				<div class="col-md-6">
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
										<a href="{{ route('editEmail', $email->id) }}" class="btn btn-success"> Edit</a>
										<button type="button" class="btn btn-danger btnDeleteEmail" value="{{ $email->id }}"> Delete</button>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-12">
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
							<td>{{ $s->followers }}</td>
							<td>
								<a href="{{ route('editAccount', $s->id) }}" class="btn btn-success"> Edit</a>
								<button type="button" class="btn btn-danger btnDeleteAccount" value="{{ $s->id }}"> Delete</button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
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

<form id="formDeleteAccount" method="POST" action="{{ route('deleteAccount') }}" hidden="true">
	@csrf
	<input type="hidden" name="id" id="formDeleteAccount-id" value="">
</form>

<script type="text/javascript">
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

	$(document).ready(function (){
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
	});

</script>

@endsection