@if ($errors->any())
  <div class="form-group alert alert-danger" role="alert">
    <ul class="m-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif