<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <title>Home</title>

  <nav data-mdb-navbar-init class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Taskminder</a>
      <button
        data-mdb-collapse-init
        class="navbar-toggler"
        type="button"
        data-mdb-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Task</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Settings</a>
          </li>
        
        </ul>
      </div>
    </div>
  </nav>
</head>

<body>
  @if (Session::has('success-alert'))
  <div class="alert alert-success" role="alert">
    {{ Session::get('success-alert') }}
  </div>
  @endif
  
  @if (Session::has('delete-alert'))
  <div class="alert alert-success" role="alert">
    {{ Session::get('delete-alert') }}
  </div>
  @endif
  
  @if (Session::has('update-alert'))
  <div class="alert alert-info" role="alert">
    {{ Session::get('update-alert') }}
  </div>
  @endif

  @if (Session::has('error'))
  <div class="alert alert-danger" role="alert">
    {{ Session::get('error') }}
  </div>
  @endif

  <a href="{{route('todos.create')}}" class="btn btn-sm btn-success">Insert new task</a>  
  
  @if (count($todos) > 0)
  <table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
          
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>completed</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($todos as $todo)
          <tr>
            <td>{{$todo->title}}</td>
            <td>{{$todo->description}}</td>
            <td>
              @if ($todo->is_complete == 1)
                  <a href="" class="btn btn-sm btn-success">completed</a>
                  @else
                  <a href="" class="btn btn-sm btn-danger">incompleted</a>
              @endif
            </td>
            <td>
            <a href="{{route('todos.detail', $todo->id)}}" class="btn btn-sm btn-success">detail</a>
            <a href="{{route('todos.edit', $todo->id)}}" class="btn btn-sm btn-info">edit</a>
            <form method="POST" action="{{ route('todos.remove') }}">
            @csrf
            @method('Delete')
              <input type="hidden" name="todo_id" value="{{ $todo->id }}">
              <input type="submit" class="btn btn-sm btn-danger" value="Delete">
            </form>
          </td>
          </tr>
      @endforeach
    </tbody>
  </table>
  @else
  <h3>No task added</h3>
  @endif
   
</body>
</html>