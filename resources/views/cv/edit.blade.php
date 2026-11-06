<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit CV Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5" style="max-width: 600px;">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h3 class="card-title mb-4">Edit CV Project</h3>
            
            {{-- Display Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('CVUTS.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Project Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $project->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Company / Client</label>
                    <input type="text" name="company_or_client" class="form-control" value="{{ old('company_or_client', $project->company_or_client) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Completion Date</label>
                    <input type="date" name="date_completed" class="form-control" value="{{ old('date_completed', $project->date_completed) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" required>{{ old('description', $project->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Current Image</label><br>
                    @if($project->image_path)
                        <img src="{{ asset('storage/' . $project->image_path) }}" class="img-thumbnail mb-2" style="max-height: 100px;"><br>
                    @else
                        <p class="text-muted small">No image uploaded.</p>
                    @endif
                    <label class="form-label">Replace Image (Optional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('CVUTS.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>