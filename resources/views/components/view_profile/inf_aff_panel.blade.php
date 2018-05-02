{{-- /*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/ --}}

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
						<p id="inf_status_date" style="margin-top: 3%;">
							@if($influencer['status_date'])
								{{ $influencer['status_date']->toFormattedDateString() }}
							@else
								N/A
							@endif
						</p>
					</div>
					<div class="form-group">
						<label style="margin-top: 7%;">Follow-up Date</label>
						<p id="inf_follow-up_date" style="margin-top: 3%;">
							@if($influencer['follow-up_date'])
								{{ $influencer['follow-up_date']->toFormattedDateString() }}
							@else
								N/A
							@endif
						</p>
					</div>
				</div>
				<div class="col-md-12">
					<h5 style="text-align: center;">History</h5>
					<a href="{{ route("createInfluencer", $profile->id)}}" class="btn btn-success mar-bot-5 width-100">Add History</a>
					{{-- <table id="tableInfHistory" data-pagination="true" data-page-size="5"></table> --}}
					<table id="tableInfHistory" data-toggle="table" data-pagination="true" data-page-size="5">
						<thead>
							<tr>
								<th>Type</th>
								<th>Data</th>
								<th>Status</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>
							@isset($infHistory)
								@foreach($infHistory as $history)
									<tr>
										<td>{{ $history->field_name }}</td>
										<td>{{ $history->field_data }}</td>
										<td>{{ $history->created_at->toFormattedDateString() }}</td>
										<td>
											<a href="{{ route('editHistory', $history->id) }}" class="btn btn-success"><i class="far fa-edit"></i></a>
										</td>
									</tr>
								@endforeach
							@endisset
						</tbody>
					</table>
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
						<p id="aff_status_date" style="margin-top: 3%;">
							@if($affliate['status_date'])
								{{ $affliate['status_date']->toFormattedDateString() }}
							@else
								N/A
							@endif
						</p>
					</div>
					<div class="form-group">
						<label style="margin-top: 7%;">Follow-up Date</label>
						<p id="aff_follow-up_date" style="margin-top: 3%;">
							@if($affliate['follow-up_date'])
								{{ $affliate['follow-up_date']->toFormattedDateString() }}
							@else
								N/A
							@endif
						</p>
					</div>
				</div>
				<div class="col-md-12">
					<h5 style="text-align: center;">History</h5>
					<a href="{{ route("createAffliate", $profile->id)}}" class="btn btn-success" style="margin-bottom: 5%; width: 100%;">Add History</a>
					{{-- <table id="tableAffHistory" data-pagination="true" data-page-size="5"></table> --}}
					<table id="tableAffHistory" data-toggle="table" data-pagination="true" data-page-size="5">
						<thead>
							<tr>
								<th>Type</th>
								<th>Data</th>
								<th>Status</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>
							@isset($affHistory)
								@foreach($affHistory as $history)
									<tr>
										<td>{{ $history->field_name }}</td>
										<td>{{ $history->field_data }}</td>
										<td>{{ $history->created_at->toFormattedDateString() }}</td>
										<td>
											<a href="{{ route('editHistory', $history->id) }}" class="btn btn-success"><i class="far fa-edit"></i></a>
										</td>
									</tr>
								@endforeach
							@endisset
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>