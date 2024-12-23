<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Download a file.
     */
    public function download(File $file)
    {
        $filePath = storage_path("app/uploads/{$file->generated_name}");

        if (file_exists($filePath)) {
            return response()->download($filePath, $file->original_name);
        } else {
            abort(404, 'File not found');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::latest()->paginate(10);
        return view('files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:docx,pdf|max:2048'
        ]);

        $file = $request->file('file');
        $fileName = $file->hashName();
        $file->storeAs('uploads', $fileName);

        File::create([
            'original_name' => $file->getClientOriginalName(),
            'generated_name' => $fileName
        ]);

        return redirect()
            ->route('files.index')
            ->with('success', 'File berhasil diupload');
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        // Implementasi untuk menampilkan detail file
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        // Implementasi untuk menampilkan form edit file
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        // Implementasi untuk mengupdate file
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        // Implementasi untuk menghapus file
    }
}
