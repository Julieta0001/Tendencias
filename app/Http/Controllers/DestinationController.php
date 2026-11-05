<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use App\Models\Traveler;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = Destination::withCount('traveler_destination')->get();
        return view('destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'country'     => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'address'     => 'nullable|string|max:255',
            'price'       => 'required|numeric|min:0',
        ]);

        $data['status']        = 1;
        $data['registered_by'] = $request->user()->id;
        Destination::create($data);
        return redirect()->route('destinations.index')->with('success', 'Destino creado correctamente');
    }

    public function show(Destination $destination)
    {
        $destination->load('traveler_destination.traveler');
        $travelers = Traveler::orderBy('name')->get();
        return view('destinations.show', compact('destination', 'travelers'));
    }

    public function edit(Destination $destination)
    {
        return view('destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'country'     => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'address'     => 'nullable|string|max:255',
            'price'       => 'required|numeric|min:0',
        ]);
        $destination->update($data);
        return redirect()->route('destinations.index')->with('success', 'Destino actualizado correctamente');
    }

    public function destroy(Destination $destination)
    {
        $destination->traveler_destination()->delete();   // evita error de llave foránea
        $destination->delete();
        return redirect()->route('destinations.index')->with('success', 'Destino eliminado correctamente');
    }

    public function inscribir(Request $request, Destination $destination)
    {
        $data = $request->validate([
            'traveler_id' => 'required|exists:travelers,id',
            'notes'       => 'nullable|string',
        ]);

        // evita duplicados
        if ($destination->traveler_destination()->where('traveler_id', $data['traveler_id'])->exists()) {
            return back()->with('error', 'Ese viajero ya está inscrito');
        }

        $destination->traveler_destination()->create([
            'traveler_id'       => $data['traveler_id'],
            'registration_date' => now(),
            'notes'             => $data['notes'] ?? null,
            'registered_by'     => $request->user()->id,
        ]);

        return redirect()->route('destinations.show', $destination)->with('success', 'Viajero inscrito');
    }
}
