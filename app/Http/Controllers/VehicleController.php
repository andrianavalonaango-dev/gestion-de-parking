<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Carbon\Carbon;

class VehicleController extends Controller
{
    // Page d'accueil
    public function index()
    {
        try {
            $vehiculesGares = Vehicle::where('statut', 'garé')->count();
        } catch (\Exception $e) {
            $vehiculesGares = 0;
        }
        return view('home', compact('vehiculesGares'));
    }

    // Formulaire d'entrée
    public function create()
    {
        return view('vehicles.create');
    }

    // Enregistrer entrée
    public function store(Request $request)
    {
        $request->validate([
            'immatriculation' => 'required|string|max:20',
            'type_vehicule' => 'required|in:voiture,moto'
        ]);

        $dejaGare = Vehicle::where('immatriculation', strtoupper($request->immatriculation))
                          ->where('statut', 'garé')
                          ->exists();

        if ($dejaGare) {
            return back()->withInput()
                        ->withErrors(['immatriculation' => 'Ce véhicule est déjà dans le parking.']);
        }

        $dernierTicket = Vehicle::latest('id')->first();
        $numero = $dernierTicket ? $dernierTicket->id + 1 : 1;
        $ticketNumber = 'PARK-' . str_pad($numero, 4, '0', STR_PAD_LEFT);

        Vehicle::create([
            'immatriculation' => strtoupper($request->immatriculation),
            'type_vehicule' => $request->type_vehicule,
            'ticket_number' => $ticketNumber,
            'heure_entree' => now(),
            'statut' => 'garé'
        ]);

        return redirect()->route('home')
                        ->with('success', 'Véhicule enregistré ! Ticket : ' . $ticketNumber);
    }

    // Page de sortie
    public function searchExit()
    {
        return view('vehicles.exit');
    }

    // Rechercher véhicule pour sortie
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string'
        ]);

        $vehicle = Vehicle::where('statut', 'garé')
                         ->where(function($query) use ($request) {
                             $query->where('immatriculation', strtoupper($request->search))
                                   ->orWhere('ticket_number', strtoupper($request->search));
                         })
                         ->first();

        if (!$vehicle) {
            return back()->withInput()
                        ->withErrors(['search' => 'Véhicule non trouvé ou déjà sorti.']);
        }

        $duree = $this->calculateDuration($vehicle->heure_entree, now());
        $montant = $this->calculateMontant($duree, $vehicle->type_vehicule);

        return view('vehicles.exit', compact('vehicle', 'duree', 'montant'));
    }

    // Enregistrer sortie
    public function exit(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        if ($vehicle->statut !== 'garé') {
            return redirect()->route('home')
                           ->with('error', 'Ce véhicule a déjà quitté le parking.');
        }

        $duree = $this->calculateDuration($vehicle->heure_entree, now());
        $montant = $this->calculateMontant($duree, $vehicle->type_vehicule);

        $vehicle->update([
            'heure_sortie' => now(),
            'duree_heures' => $duree,
            'montant' => $montant,
            'statut' => 'sorti'
        ]);

        return redirect()->route('home')
                        ->with('success', 'Sortie enregistrée ! Montant : ' . $montant . ' Ar');
    }

    // Liste véhicules garés
    public function parked()
    {
        try {
            $vehicles = Vehicle::where('statut', 'garé')
                              ->orderBy('heure_entree', 'desc')
                              ->get();
        } catch (\Exception $e) {
            $vehicles = collect();
        }
        return view('vehicles.parked', compact('vehicles'));
    }

    // Historique
    public function history()
    {
        try {
            $vehicles = Vehicle::where('statut', 'sorti')
                              ->orderBy('heure_sortie', 'desc')
                              ->paginate(20);
        } catch (\Exception $e) {
            $vehicles = collect();
        }
        return view('vehicles.history', compact('vehicles'));
    }

    // Calcul durée
    private function calculateDuration($entree, $sortie)
    {
        $minutes = Carbon::parse($entree)->diffInMinutes(Carbon::parse($sortie));
        $heures = ceil($minutes / 60);
        return max(1, $heures);
    }

    // Calcul montant
    private function calculateMontant($duree, $type)
    {
        $tarifs = ['voiture' => 500, 'moto' => 200];
        return $duree * ($tarifs[$type] ?? 500);
    }
}
