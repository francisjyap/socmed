{{-- /*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/ --}}

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