<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CvController extends Controller
{
    // Menunjukkan CV nya dengan project
    public function index()
    {
        $projects = Project::with('category')->latest()->get();
        return view('cv.index', compact('projects'));
    }

    // Mengeluarkan form untuk membuat project baru
    public function create()
    {
        $categories = Category::all();
        return view('cv.create', compact('categories'));
    }

    // Menyimpan project baru dengan CVnya
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('projects', 'public');
    }

    Project::create([
        'title' => $request->title,
        'category_id' => $request->category_id,
        'description' => $request->description,
        'company_or_client' => $request->company_or_client,
        'date_completed' => $request->date_completed,
        'image_path' => $imagePath,
    ]);

    return redirect()->route('CVUTS.index')->with('success', 'Project added successfully!');
}

    // function edit utk form CVnya
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $categories = Category::all();
        return view('cv.edit', compact('project', 'categories'));
    }

    // Untuk mengupdate project dan merubah foto pada CV
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
                Storage::disk('public')->delete($project->image_path);
            }
            $project->image_path = $request->file('image')->store('projects', 'public');
        }

        $project->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'company_or_client' => $request->company_or_client,
            'date_completed' => $request->date_completed,
            'image_path' => $project->image_path,
        ]);

        return redirect()->route('CVUTS.index')->with('success', 'Project updated successfully!');
    }

    // Menghapus project beserta CV yang tertempel
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
            Storage::disk('public')->delete($project->image_path);
        }

        $project->delete();
        return redirect()->route('CVUTS.index')->with('success', 'Project deleted successfully!');
    }

    // Untuk melihat CVnya
    public function print()
    {
        $projects = Project::with('category')->get();
        return view('cv.print', compact('projects'));
    }
}