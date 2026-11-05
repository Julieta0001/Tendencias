<?php

namespace App\Http\Controllers;

use App\Models\Traveler;
use App\Models\Destination;
use App\Models\TravelerDestination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TravelerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $travelers = Traveler::withCount('traveler_destination')->get();
        return view('travelers.index', compact('travelers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $destinations = Destination::orderBy('name')->get();
        return view('travelers.create', compact('destinations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'document'     => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:travelers,email',
            'phone'        => 'nullable|string|max:30',
            'photo'        => 'nullable|image|max:2048',
            'destinations'   => 'nullable|array',
            'destinations.*' => 'exists:destinations,id',
        ]);

        $imagename = null;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imagename = Str::slug($request->name) . '-' . Carbon::now()->toDateString()
                . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/travelers'), $imagename);
        }

        $travelerData = collect($data)->except('destinations')->all();
        $travelerData['photo']         = $imagename;
        $travelerData['status']        = 1;
        $travelerData['registered_by'] = $request->user()->id;

        $traveler = Traveler::create($travelerData);

        foreach ($request->input('destinations', []) as $destinationId) {
            TravelerDestination::create([
                'traveler_id'       => $traveler->id,
                'destination_id'    => $destinationId,
                'registration_date' => now(),
                'registered_by'     => $request->user()->id,
            ]);
        }

        return redirect()->route('travelers.index')->with('success', 'Viajero creado correctamente');
    }

    public function show(Traveler $traveler)
    {
        $traveler->load('traveler_destination.destination');
        return view('travelers.show', compact('traveler'));
    }

    public function edit(Traveler $traveler)
    {
        $destinations = Destination::orderBy('name')->get();
        $inscritos    = $traveler->traveler_destination()->pluck('destination_id')->toArray();
        return view('travelers.edit', compact('traveler', 'destinations', 'inscritos'));
    }

    public function update(Request $request, Traveler $traveler)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'document'     => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:travelers,email,' . $traveler->id,
            'phone'        => 'nullable|string|max:30',
            'photo'        => 'nullable|image|max:5120',
            'destinations'   => 'nullable|array',
            'destinations.*' => 'exists:destinations,id',
        ]);

        $travelerData = collect($data)->except(['destinations', 'photo'])->all();

        if ($request->hasFile('photo')) {
            if ($traveler->photo && file_exists(public_path('uploads/travelers/' . $traveler->photo))) {
                unlink(public_path('uploads/travelers/' . $traveler->photo));
            }

            $image = $request->file('photo');
            $imagename = Str::slug($request->name) . '-' . Carbon::now()->toDateString()
                . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/travelers'), $imagename);

            $travelerData['photo'] = $imagename;
        }

        $traveler->update($travelerData);

        $nuevos   = collect($request->input('destinations', []))->map(fn ($id) => (int) $id);
        $actuales = $traveler->traveler_destination()->pluck('destination_id');

        $traveler->traveler_destination()->whereNotIn('destination_id', $nuevos)->delete();

        foreach ($nuevos->diff($actuales) as $destinationId) {
            $traveler->traveler_destination()->create([
                'destination_id'    => $destinationId,
                'registration_date' => now(),
                'registered_by'     => $request->user()->id,
            ]);
        }

        return redirect()->route('travelers.index')->with('success', 'Viajero actualizado correctamente');
    }

    public function destroy(Traveler $traveler)
    {
        $traveler->traveler_destination()->delete();
        $traveler->delete();
        return redirect()->route('travelers.index')->with('success', 'Viajero eliminado correctamente');
    }
    /**
 * Inscribe directamente un destino desde el perfil del viajero.
 */
/**
 * Inscribe directamente un destino desde el perfil del viajero.
 */
public function inscribirDestino(Request $request, Traveler $traveler)
{
    $data = $request->validate([
        'destination_id' => 'required|exists:destinations,id',
        'notes'          => 'nullable|string',
    ]);

    // Evita duplicados
    if ($traveler->traveler_destination()->where('destination_id', $data['destination_id'])->exists()) {
        return back()->with('error', 'Este viajero ya está inscrito en ese destino.');
    }

    $traveler->traveler_destination()->create([
        'destination_id'  => $data['destination_id'],
        'travel_date'     => now()->toDateString(), // Asigna la fecha actual
        'notes'           => $data['notes'] ?? null,
        'registered_by'   => $request->user()->id,
    ]);

    return redirect()->route('travelers.show', $traveler)->with('success', '¡Destino inscrito correctamente!');
}
}

