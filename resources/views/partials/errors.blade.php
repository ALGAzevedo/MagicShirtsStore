<div class="alert alert-danger fade show" role="alert">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
  </div>
