<div class="modal fade" id="modal_edit_affliate_code" tabindex="-1" role="dialog" aria-labelledby="modal_edit_affliate_code" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Set Affliate Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('setAffliateCode') }}">
        <div class="modal-body">
            @csrf
            <input type="hidden" name="profile_id" value="{{ $profile->id }}">

            <div class="form-group">
              <label>Affliate Code</label>
              <input type="text" name="affliate_code" class="form-control" value="{{ $profile->affliate_code }}" required>
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>