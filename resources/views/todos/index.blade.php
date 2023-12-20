<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <title>Taskminder</title>
</head>

<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary shadow-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Taskminder</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
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

  <div class="container mt-3">
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

    <div class="container border p-4 shadow-lg rounded" style="padding-top: 50%">
      <h1 class="text-center">Dashboard</h1><br>
      <div class="d-flex justify-content-center">
        <table class="table table-striped" style="margin: 0 auto">
          <thead class="bg-light">
            <tr style="text-align: center">
              <th>Title</th>
              <th>Description</th>
              <th>Completed</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody style="text-align: center"> 
            @if (count($todos) > 0)
              @foreach ($todos as $todo)
                <tr>
                  <td>{{$todo->title}}</td>
                  <td style="max-width: 100px; overflow: hidden">{{$todo->description}}</td>
                  <td>
                    @if ($todo->is_complete == 1)
                      <span class="badge bg-success">Completed</span>
                    @else
                      <span class="badge bg-danger">Incomplete</span>
                    @endif
                  </td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Task Actions">
                      <a href="{{ route('todos.detail', $todo->id) }}" class="btn btn-success btn-sm rounded">Detail</a>
                      <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-primary btn-sm ms-2 rounded">Edit</a>
                      <form method="POST" action="{{ route('todos.remove') }}" class="ms-2">
                        @csrf
                        @method('Delete')
                        <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                        <button type="submit" class="btn btn-danger btn-sm rounded">Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="4">
                  <h3>No task added</h3>
                </td>
              </tr>
            @endif
          </tbody>
          <tfoot>
            <tr>
              <td colspan="4">
                <div class="d-flex justify-content-center">
                  <a href="{{route('todos.create')}}" class="btn btn-outline-secondary flex-grow-1" style="font-size: 20px">+</a>
                </div>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>      
  </div>
</body>
</html>