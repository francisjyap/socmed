@if(session('status'))
    <div class="alert alert-{{ session('banner')['type'] }}" role="alert">
      {{ session('banner')['msg'] }}
    </div>
@endif
