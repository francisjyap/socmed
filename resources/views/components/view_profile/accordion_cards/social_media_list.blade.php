{{-- /*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/ --}}

<div class="card">
	<div class="card-header" id="headingSocialMedia">
		<h5 class="mb-0">
			<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSocialMedia" aria-expanded="false" aria-controls="collapseSocialMedia">
				<h5 style="text-align: center;">List of Social Media Accounts</h5>
			</button>
		</h5>
	</div>
	<div id="collapseSocialMedia" class="collapse" aria-labelledby="headingSocialMedia" data-parent="#accordion">
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
					@foreach($profile->socmed as $s)
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