<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Http\Requests\StoreHargaRequest;
use App\Http\Requests\UpdateHargaRequest;
use App\Models\Harga;
use Illuminate\Support\Facades\Storage;

class HargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('pages.harga.index', [
            'hargas' => Harga::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('pages.harga.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHargaRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // put image in the public storage
           $filePath = Storage::disk('public')->put('images/harga/logos', request()->file('image'));
           $validated['image'] = $filePath;
       }

       // insert only requests that already validated in the StoreRequest
       $create = Harga::create($validated);

       if($create) {
           // add flash for the success notification
           session()->flash('notif.success', 'Post created successfully!');
           return redirect()->route('hargas.index');
       }

       return abort(500);
   }


    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        return response()->view('pages.harga.show', [
            'hargas' => Harga::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        return response()->view('pages.harga.form', [
            'hargas' => Harga::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHargaRequest $request, string $id): RedirectResponse
    {
        $harga = Harga::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // delete image
            Storage::disk('public')->delete($harga->image);

            $filePath = Storage::disk('public')->put('images/harga/logos', request()->file('image'), 'public');
            $validated['image'] = $filePath;
        }

        $update = $harga->update($validated);

        if($update) {
            session()->flash('notif.success', 'Post updated successfully!');
            return redirect()->route('hargas.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $harga = Harga::findOrFail($id);

        Storage::disk('public')->delete($harga->image);

        $delete = $harga->delete($id);

        if($delete) {
            session()->flash('notif.success', 'Post deleted successfully!');
            return redirect()->route('hargas.index');
        }

        return abort(500);
    }
}
