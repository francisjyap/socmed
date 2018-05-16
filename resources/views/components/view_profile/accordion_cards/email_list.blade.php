{{-- /*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/ --}}

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
                    @foreach($profile->emails as $email)
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
