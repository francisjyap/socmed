<div class="col-md-2 mar-bot-5">
    <a href="{{ route("home") }}" class="btn btn-danger mar-bot-5 width-100"><i class="fas fa-arrow-left"></i> Back to Profiles</a>
    <a href="{{ route("editProfile", $profile->id)}}" class="btn btn-success mar-bot-5 width-100"><i class="far fa-edit"></i> Edit Profile</a>
    <a href="{{ route("addEmail", $profile->id)}}" class="btn btn-success mar-bot-5 width-100"><i class="fas fa-plus"></i> Add Email</a>
    <a href="{{ route("addWebsite", $profile->id)}}" class="btn btn-success mar-bot-5 width-100"><i class="fas fa-plus"></i> Add Wesbite</a>
    <a href="{{ route("addAccount", $profile->id)}}" class="btn btn-success mar-bot-5 width-100"><i class="fas fa-plus"></i> Add Account</a>
    @if(Auth::user()->is_admin)
        <button type="button" class="btn btn-danger mar-top-30 mar-bot-5 width-100" id="btnDelete"><i class="far fa-trash-alt"></i> Delete Account</button>
    @endif
</div>
