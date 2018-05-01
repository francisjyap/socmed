{{-- /*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/ --}}

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
			<input type="date" name="date_of_action" id="date_of_action" class="form-control" required>
			<input type="checkbox" name="btnToday" id="btnToday" class="form-check-input" value="true">
			<label class="form-check-label">Today</label>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success" style="float: right; margin-bottom: 5%;"><i class="fas fa-check"></i> Submit</button>
		</div>
	</form>
</div>