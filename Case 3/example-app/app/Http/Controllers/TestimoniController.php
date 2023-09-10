<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Http\Requests\StoreTestimoniRequest;
use App\Http\Requests\UpdateTestimoniRequest;
use App\Models\Testimoni;
use Illuminate\Support\Facades\Storage;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('pages.testimoni.index', [
            'testimonis' => Testimoni::orderBy('updated_at')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('pages.testimoni.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestimoniRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // put image in the public storage
           $filePath = Storage::disk('public')->put('images/testimoni/avatars', request()->file('image'));
           $validated['image'] = $filePath;
       }
    $create = Testimoni::create($validated);

    if($create) {
        // add flash for the success notification
        session()->flash('notif.success', 'Testimoni created successfully!');

        return redirect()->route('testimonis.index');
    }

    return abort(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        return response()->view('pages.testimoni.show', [
            'testimonis' => Testimoni::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        return response()->view('pages.testimoni.form', [
            'testimonis' => Testimoni::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestimoniRequest $request, string $id): RedirectResponse
    {
        $testimoni = Testimoni::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // delete image
            Storage::disk('public')->delete($testimoni->image);

            $filePath = Storage::disk('public')->put('images/testimoni/avatars', request()->file('image'), 'public');
            $validated['image'] = $filePath;
        }
   $update = $testimoni->update($validated);
   if($update) {
    session()->flash('notif.success', 'setting updated successfully!');
    return redirect()->route('settings.index');
}

return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $testimoni = Testimoni::findOrFail($id);

        Storage::disk('public')->delete($testimoni->image);

        $delete = $testimoni->delete($id);

        if($delete) {
            session()->flash('notif.success', 'Post deleted successfully!');
            return redirect()->route('testimonis.index');
        }

        return abort(500);
    }
}
