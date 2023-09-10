<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Http\Requests\StoreBantuanRequest;
use App\Http\Requests\UpdateBantuanRequest;
use App\Models\Bantuan;

class BantuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('pages.bantuan.index',
            ['bantuans' => Bantuan::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('pages.bantuan.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBantuanRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Bantuan::create($validated);

        {
            // add flash for the success notification
            session()->flash('notif.success', 'Testimoni created successfully!');
            return redirect()->route('bantuans.index');
        }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        return response()->view('pages.bantuan.show', [
            'bantuans' => Bantuan::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        return response()->view('pages.bantuan.form', [
            'bantuans' => Bantuan::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBantuanRequest $request, string $id): RedirectResponse
    {
        $validated = $request->validated();
        $bantuan = Bantuan::findOrFail($id);

        $update = $bantuan->update($validated);
        if($update) {
        session()->flash('notif.success', 'Post updated successfully!');
        return redirect()->route('bantuans.index');
        }
        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string  $id): RedirectResponse
    {
        $bantuan = Bantuan::findOrFail($id);

        $delete = $bantuan->delete($id);

        if($delete) {
            session()->flash('notif.success', 'Post deleted successfully!');
            return redirect()->route('bantuans.index');
        }

        return abort(500);
    }
}
