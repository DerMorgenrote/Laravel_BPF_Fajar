<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV & Project Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>CV & Project Management</h2>
        <div>
            <a href="{{ route('CVUTS.print') }}" target="_blank" class="btn btn-secondary me-2">
                🖨️ View / Print CV
            </a>
            <a href="{{ route('CVUTS.create') }}" class="btn btn-primary">
                + Add New Project
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive bg-white p-3 rounded shadow-sm">
        <table class="table table-bordered table-striped align-middle m-0">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Company/Client</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td style="width: 100px;">
                        @if($project->image_path)
                            <img src="{{ asset('storage/' . $project->image_path) }}" class="img-thumbnail" style="max-height: 60px;">
                        @else
                            <span class="badge bg-secondary">No Image</span>
                        @endif
                    </td>
                    <td>{{ $project->title }}</td>
                    <td><span class="badge bg-info">{{ $project->category->name ?? 'Uncategorized' }}</span></td>
                    <td>{{ $project->company_or_client ?? '-' }}</td>
                    <td>
                        <a href="{{ route('CVUTS.edit', $project->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        
                        <form action="{{ route('CVUTS.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No project records found. Add one to build your CV!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>