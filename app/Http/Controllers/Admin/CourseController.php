<?php
namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        Log::info('Store method called', ['input' => $request->all()]);

        try {
            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tingkat_kesulitan' => 'required|in:pemula,menengah,lanjut',
                'link_video' => [
                    'required',
                    'url',
                    'regex:#^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[a-zA-Z0-9_-]{11}(\?.*)?$#',
                ],
            ], [
                'judul.required' => 'Judul wajib diisi.',
                'deskripsi.required' => 'Deskripsi wajib diisi.',
                'tingkat_kesulitan.required' => 'Tingkat kesulitan wajib dipilih.',
                'tingkat_kesulitan.in' => 'Tingkat kesulitan tidak valid.',
                'link_video.required' => 'Link video wajib diisi.',
                'link_video.url' => 'Link video harus berupa URL valid.',
                'link_video.regex' => 'Link video harus dari YouTube dengan format yang valid (contoh: https://youtu.be/VIDEO_ID).',
            ]);

            Log::info('Validation passed', ['validated' => $validated]);

            $slug = Str::slug($request->judul);
            $existingSlug = Course::where('slug', $slug)->exists();
            $counter = 1;
            $baseSlug = $slug;
            while ($existingSlug) {
                $slug = $baseSlug . '-' . $counter++;
                $existingSlug = Course::where('slug', $slug)->exists();
            }

            Course::create([
                'judul' => $request->judul,
                'slug' => $slug,
                'deskripsi' => $request->deskripsi,
                'tingkat_kesulitan' => $request->tingkat_kesulitan,
                'link_video' => $request->link_video,
            ]);

            Log::info('Course created', ['judul' => $request->judul, 'slug' => $slug]);

            return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil dibuat.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan kursus: ' . $e->getMessage(), ['input' => $request->all()]);
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan kursus: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        try {
            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tingkat_kesulitan' => 'required|in:pemula,menengah,lanjut',
                'link_video' => [
                    'required',
                    'url',
                    'regex:#^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[a-zA-Z0-9_-]{11}(\?.*)?$#',
                ],
            ], [
                'judul.required' => 'Judul wajib diisi.',
                'deskripsi.required' => 'Deskripsi wajib diisi.',
                'tingkat_kesulitan.required' => 'Tingkat kesulitan wajib dipilih.',
                'tingkat_kesulitan.in' => 'Tingkat kesulitan tidak valid.',
                'link_video.required' => 'Link video wajib diisi.',
                'link_video.url' => 'Link video harus berupa URL valid.',
                'link_video.regex' => 'Link video harus dari YouTube dengan format yang valid (contoh: https://youtu.be/VIDEO_ID).',
            ]);

            $slug = Str::slug($request->judul);
            $existingSlug = Course::where('slug', $slug)->where('id', '!=', $course->id)->exists();
            $counter = 1;
            $baseSlug = $slug;
            while ($existingSlug) {
                $slug = $baseSlug . '-' . $counter++;
                $existingSlug = Course::where('slug', $slug)->where('id', '!=', $course->id)->exists();
            }

            $course->update([
                'judul' => $request->judul,
                'slug' => $slug,
                'deskripsi' => $request->deskripsi,
                'tingkat_kesulitan' => $request->tingkat_kesulitan,
                'link_video' => $request->link_video,
            ]);

            return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui kursus: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui kursus: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Course $course)
    {
        try {
            $course->delete();
            return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus kursus: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus kursus: ' . $e->getMessage()]);
        }
    }
}