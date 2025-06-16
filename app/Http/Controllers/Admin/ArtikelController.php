<?php
namespace App\Http\Controllers\Admin;

use App\Models\Artikel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->get();
        return view('admin.artikels.index', compact('artikels'));
    }

    public function create()
    {
        return view('admin.artikels.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'body' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ], [
                'title.required' => 'Judul wajib diisi.',
                'author.required' => 'Penulis wajib diisi.',
                'body.required' => 'Isi artikel wajib diisi.',
                'image.image' => 'File harus berupa gambar.',
                'image.mimes' => 'Gambar harus berformat jpg, jpeg, atau png.',
                'image.max' => 'Ukuran gambar maksimal 2MB.',
            ]);

            $slug = Str::slug($request->title);
            $imagePath = null;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'img-' . $slug . '.' . $image->getClientOriginalExtension();
                $imagePath = 'img/artikels/' . $imageName;

                // Simpan gambar ke public/img/artikels
                Storage::disk('public')->put($imagePath, file_get_contents($image));
                Log::info('Gambar berhasil diupload: ' . $imagePath);
            }

            Artikel::create([
                'title' => $request->title,
                'author' => $request->author,
                'slug' => $slug,
                'body' => $request->body,
                'image' => $imagePath,
            ]);

            return redirect()->route('admin.artikels.index')->with('success', 'Artikel berhasil dibuat.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan artikel: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan artikel: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(Artikel $artikel)
    {
        return view('admin.artikels.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'body' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ], [
                'title.required' => 'Judul wajib diisi.',
                'author.required' => 'Penulis wajib diisi.',
                'body.required' => 'Isi artikel wajib diisi.',
                'image.image' => 'File harus berupa gambar.',
                'image.mimes' => 'Gambar harus berformat jpg, jpeg, atau png.',
                'image.max' => 'Ukuran gambar maksimal 2MB.',
            ]);

            $slug = Str::slug($request->title);
            $imagePath = $artikel->image;

            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                    Log::info('Gambar lama dihapus: ' . $imagePath);
                }

                $image = $request->file('image');
                $imageName = 'img-' . $slug . '.' . $image->getClientOriginalExtension();
                $imagePath = 'img/artikels/' . $imageName;

                // Simpan gambar baru
                Storage::disk('public')->put($imagePath, file_get_contents($image));
                Log::info('Gambar baru diupload: ' . $imagePath);
            }

            $artikel->update([
                'title' => $request->title,
                'author' => $request->author,
                'slug' => $slug,
                'body' => $request->body,
                'image' => $imagePath,
            ]);

            return redirect()->route('admin.artikels.index')->with('success', 'Artikel berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui artikel: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui artikel: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Artikel $artikel)
    {
        try {
            // Hapus gambar jika ada
            if ($artikel->image && Storage::disk('public')->exists($artikel->image)) {
                Storage::disk('public')->delete($artikel->image);
                Log::info('Gambar dihapus: ' . $artikel->image);
            }

            $artikel->delete();
            return redirect()->route('admin.artikels.index')->with('success', 'Artikel berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus artikel: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus artikel: ' . $e->getMessage()]);
        }
    }
}