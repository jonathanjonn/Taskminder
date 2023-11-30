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
  <form method="POST" action="{{route('todos.update')}}">
    @csrf
    @method('PUT')
    <input type="hidden" name="todo_id" value="{{$todo->id}}">
    <h3>edit task</h3>
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" class="form-control" name="title" placeholder="edit title" value="{{$todo->title}}">
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <input name="description" class="form-control" cols="5" rows="5" placeholder="edit desc" value="{{$todo->description}}">
    </div>
    <div class="mb-3">
      <label for="">Status</label>
      <select name="is_complete" class="form-control">
        <option disable selected>select option</option>  
        <option value="1">completed</option>
        <option value="0">incompleted</option>
      </select>  
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</body>
</html>