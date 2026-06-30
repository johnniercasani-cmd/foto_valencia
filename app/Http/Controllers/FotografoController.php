<?php

namespace App\Http\Controllers;

use App\Models\Fotografo;
use Illuminate\Http\Request;

class FotografoController extends Controller
{
    public function index()
    {
        $fotografos = Fotografo::orderBy('id', 'desc')->get();

        return view('fotografos.index', compact('fotografos'));
    }

    public function create()
    {
        return view('fotografos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:100',
            'estado' => 'required|string|max:30',
        ]);

        Fotografo::create($request->all());

        return redirect()
            ->route('fotografos.index')
            ->with('success', 'Fotógrafo registrado correctamente.');
    }

    public function show(Fotografo $fotografo)
    {
        $fotografo->load('reservas.servicio', 'reservas.cliente');

        return view('fotografos.show', compact('fotografo'));
    }

    public function edit(Fotografo $fotografo)
    {
        return view('fotografos.edit', compact('fotografo'));
    }

    public function update(Request $request, Fotografo $fotografo)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:100',
            'estado' => 'required|string|max:30',
        ]);

        $fotografo->update($request->all());

        return redirect()
            ->route('fotografos.index')
            ->with('success', 'Fotógrafo actualizado correctamente.');
    }

    public function destroy(Fotografo $fotografo)
    {
        $fotografo->delete();

        return redirect()
            ->route('fotografos.index')
            ->with('success', 'Fotógrafo eliminado correctamente.');
    }
}