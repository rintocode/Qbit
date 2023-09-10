<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Http\Requests\StoreTentangRequest;
use App\Http\Requests\UpdateTentangRequest;
use App\Models\Tentang;
use Illuminate\Support\Facades\Storage;

class TentangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('pages.tentang.index', [
            'tentangs' => Tentang::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('pages.tentang.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTentangRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // put image in the public storage
           $filePath = Storage::disk('public')->put('images/tentang/gambar', request()->file('image'));
           $validated['image'] = $filePath;
       }

       // insert only requests that already validated in the StoreRequest
       $create = Tentang::create($validated);

       if($create) {
           // add flash for the success notification
           session()->flash('notif.success', 'Post created successfully!');
           return redirect()->route('tentangs.index');
       }

       return abort(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        return response()->view('pages.tentang.show', [
            'tentangs' => Tentang::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        return response()->view('pages.tentang.form', [
            'tentangs' => Tentang::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTentangRequest $request, string $id): RedirectResponse
    {
        $tentang = Tentang::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // delete image
            Storage::disk('public')->delete($tentang->image);

            $filePath = Storage::disk('public')->put('images/tentang/gambar', request()->file('image'), 'public');
            $validated['image'] = $filePath;
        }

        $update = $tentang->update($validated);

        if($update) {
            session()->flash('notif.success', 'Post updated successfully!');
            return redirect()->route('tentangs.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $tentang = Tentang::findOrFail($id);

        Storage::disk('public')->delete($tentang->image);

        $delete = $tentang->delete($id);

        if($delete) {
            session()->flash('notif.success', 'Post deleted successfully!');
            return redirect()->route('tentangs.index');
        }

        return abort(500);
    }
}
