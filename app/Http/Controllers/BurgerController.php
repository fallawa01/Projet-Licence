<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BurgerController extends Controller
{
    public function index()
    {
        $burgers = Burger::orderBy('id', 'asc')->paginate(6);
        return view('burgers.index', ['burgers' => $burgers]);
    }

    public function create()
    {
        $burger = new Burger();
        return view('burgers.create', ['burger' => $burger]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'prix' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png,webp,jpg,gif,svg|max:2048',
        ]);

        $fileName = 'default.png';
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images/burgers', $fileName);
        }

        $burger = new Burger();
        $burger->nom = $request->nom;
        $burger->prix = $request->prix;
        $burger->description = $request->description;
        $burger->image = $fileName;
        $burger->save();

        return redirect()->route('burgers.index')->with('success', 'Burger ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $burger = Burger::findOrFail($id);
        return view('burgers.edit', ['burger' => $burger]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'prix' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png,webp,jpg,gif,svg|max:2048',
        ]);

        $burger = Burger::findOrFail($id);
        $burger->nom = $request->nom;
        $burger->prix = $request->prix;
        $burger->description = $request->description;

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images/burgers', $fileName);
            if ($burger->image && $burger->image != 'default.png') {
                Storage::delete('public/images/burgers/' . $burger->image);
            }
            $burger->image = $fileName;
        }

        $burger->save();
        return redirect()->route('burgers.index')->with('success', 'Burger modifié avec succès');
    }

    public function destroy(string $id)
    {
        $burger = Burger::findOrFail($id);
        if ($burger->image && $burger->image != 'default.png') {
            Storage::delete('public/images/burgers/' . $burger->image);
        }
        $burger->delete();
        return redirect()->route('burgers.index')->with('success', 'Burger supprimé avec succès');
    }
}
