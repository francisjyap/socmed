{{-- /*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/ --}}

<div class="row">
	<div class="col-md-6">
        <div>
            <h5>Name: {{ $profile->name }}</h5>
        </div>
        
        <div class="mar-top-5">
            <h5>Company Name: {{ $profile->company_name }}</h5>
        </div>
        
        <div class="mar-top-5">
            <h5>Phone Number: {{ $profile->phone_number ? $profile->phone_number : 'N/A' }}</h5>
        </div>
        
        <div class="mar-top-5">
            <h5>Country: {{ $profile->country ? $profile->country : 'N/A' }}</h5>
        </div>
        
        <div class="mar-top-5">
            <button id="edit_payment_email" class="btn btn-success" data-toggle="modal" data-target="#modal_edit_payment_email" style="float: right;"><i class="fas fa-edit"></i></button>
            <h5>Payment Email: {{ $profile->payment_email ? $profile->payment_email : 'N/A' }}</h5>
        </div>

		<div class="mar-top-5">
			<button id="edit_affliate_code" class="btn btn-success" data-toggle="modal" data-target="#modal_edit_affliate_code" style="float: right;"
                    {{ $profile->is_affliate ?: 'disabled' }}
                ><i class="fas fa-edit"></i></button>
            <h5>Affliate Code: {{ $profile->affliate_code ? $profile->affliate_code : 'N/A' }}</h5>
		</div>
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
							@isset($influencer)
								@if($influencer->email_sent)
									<p style="color: green">Yes
                                    <button type="button" class="btn btn-danger override-no" value="0"><i class="fas fa-times"></i></button>
								@else
									<p style="color: red">No
                                    <button type="button" class="btn btn-success override-yes" value="0"><i class="fas fa-check"></i></button>
								@endif
                                    </p>
							@endisset
						</td>
						<td>
							@isset($affliate)
								@if($affliate->email_sent)
									<p style="color: green">Yes
                                    <button type="button" class="btn btn-danger override-no" value="1"><i class="fas fa-times"></i></button>
								@else
									<p style="color: red">No
                                    <button type="button" class="btn btn-success override-yes" value="1"><i class="fas fa-check"></i></button>
								@endif
                                    </p>
							@endisset
						</td>
					</tr>
				</tbody>
			</table>
		</h5>
		<h5>Is Influencer?: 
			@if($profile->is_influencer == 0)
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