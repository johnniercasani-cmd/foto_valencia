<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::orderBy('id', 'desc')->get();

        return view('equipos.index', compact('equipos'));
    }

    public function create()
    {
        return view('equipos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_equipo' => 'required|string|max:100',
            'tipo_equipo' => 'nullable|string|max:50',
            'estado_equipo' => 'required|string|max:30',
            'fecha_mantenimiento' => 'nullable|date',
            'observaciones' => 'nullable|string',
        ]);

        Equipo::create($request->all());

        return redirect()
            ->route('equipos.index')
            ->with('success', 'Equipo registrado correctamente.');
    }

    public function show(Equipo $equipo)
    {
        return view('equipos.show', compact('equipo'));
    }

    public function edit(Equipo $equipo)
    {
        return view('equipos.edit', compact('equipo'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $request->validate([
            'nombre_equipo' => 'required|string|max:100',
            'tipo_equipo' => 'nullable|string|max:50',
            'estado_equipo' => 'required|string|max:30',
            'fecha_mantenimiento' => 'nullable|date',
            'observaciones' => 'nullable|string',
        ]);

        $equipo->update($request->all());

        return redirect()
            ->route('equipos.index')
            ->with('success', 'Equipo actualizado correctamente.');
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();

        return redirect()
            ->route('equipos.index')
            ->with('success', 'Equipo eliminado correctamente.');
    }
}