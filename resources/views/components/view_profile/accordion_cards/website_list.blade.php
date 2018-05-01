{{-- /*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/ --}}

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
					@isset($websites)
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
					@endisset
				</tbody>
			</table>
		</div>
	</div>
</div>