<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <title>Document</title>
</head>
<body>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <form method="POST" action="{{route('todos.store')}}">
    @csrf
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" class="form-control" name="title" placeholder="Example input">
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <input name="description" class="form-control" cols="5" rows="5" placeholder="Another input">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</body>
</html>