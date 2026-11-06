<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae - Project History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .cv-paper { background: #fff; max-width: 800px; margin: 30px auto; padding: 40px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .cv-paper { box-shadow: none; padding: 0; margin: 0; max-width: 100%; }
        }
    </style>
</head>
<body>

    <div class="text-center pt-3 no-print">
        <button onclick="window.print()" class="btn btn-primary btn-lg">
            🖨️ Print / Save as PDF
        </button>
    </div>

    <div class="cv-paper">
        <div class="border-bottom pb-3 mb-4">
            <h1 class="text-uppercase fw-bold m-0">Your Name</h1>
            <p class="text-muted fs-5 m-0">Full Stack Web Developer</p>
        </div>

        <h4 class="text-primary border-bottom pb-2 mb-3">Portfolio & Project History</h4>

        @forelse($projects as $project)
            <div class="mb-4 pb-3 border-bottom">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="fw-bold m-0">{{ $project->title }}</h5>
                        <small class="text-muted">{{ $project->company_or_client ? $project->company_or_client . ' | ' : '' }}{{ $project->category->name ?? '' }}</small>
                    </div>
                    @if($project->date_completed)
                        <span class="badge bg-secondary">{{ $project->date_completed }}</span>
                    @endif
                </div>
                <p class="mt-2 mb-2">{{ $project->description }}</p>
                @if($project->image_path)
                    <img src="{{ asset('storage/' . $project->image_path) }}" class="img-fluid rounded mt-2" style="max-height: 150px;">
                @endif
            </div>
        @empty
            <p class="text-muted">No experience or project records found.</p>
        @endforelse
    </div>

</body>
</html>