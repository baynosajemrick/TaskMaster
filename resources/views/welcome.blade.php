<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container" style="max-width: 600px;">
        <h3 class="fw-bold mb-4 text-center">My Task Manager</h3>

        <!-- Add Task Form -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form action="/tasks" method="POST" class="d-flex gap-2">
                    @csrf
                    <input type="text" name="title" class="form-control" placeholder="New task title..." required>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>

        <!-- Task List -->
        <div class="card shadow-sm border-0">
            <ul class="list-group list-group-flush">
                @forelse($tasks as $task)
                    <li class="list-group-item d-flex align-items-center justify-content-between py-3">
                        <div class="d-flex align-items-center gap-2">
                            <form action="/tasks/{{ $task->id }}/toggle" method="POST" class="m-0">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $task->status === 'Completed' ? 'btn-success' : 'btn-outline-secondary' }}">
                                    {{ $task->status === 'Completed' ? '✓' : '◯' }}
                                </button>
                            </form>
                            <span class="{{ $task->status === 'Completed' ? 'text-decoration-line-through text-muted' : 'fw-semibold' }}">
                                {{ $task->title }}
                            </span>
                        </div>

                        <form action="/tasks/{{ $task->id }}" method="POST" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </li>
                @empty
                    <li class="list-group-item text-center py-4 text-muted">No tasks yet!</li>
                @endforelse
            </ul>
        </div>
    </div>
</body>
</html>