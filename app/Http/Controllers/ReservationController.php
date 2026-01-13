<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logement;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store($logment_id)
    {
        $logment = Logement::findOrFail($logment_id);

        $existing = Reservation::where('logment_id', $logment->id)
        ->where('client_id', auth()->id())
        ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Vous avez déjà réservé ce logement.');
    }

         Reservation::create([
            'logment_id' => $logment->id,
            'client_id' => auth()->id(), 
            'locateur_id' => $logment->locateur_id, 
        ]);

        return redirect()->back()->with('success', 'Votre réservation a été envoyée.');
    }


    public function locateurReservations()
    {
        $reservations = Reservation::where('locateur_id', auth()->id())
            ->with(['client', 'logement'])
            ->latest()
            ->get();

        return view('dashboard.locateur.reservations', compact('reservations'));
    }

    public function accepterReservation($id)
    {
        $res = Reservation::findOrFail($id);
        if($res->locateur_id != auth()->id()) abort(403);
        $res->accepter();
        return redirect()->back()->with('success', 'Réservation acceptée.');
    }

    public function refuserReservation($id)
    {
        $res = Reservation::findOrFail($id);
        if($res->locateur_id != auth()->id()) abort(403);
        $res->refuser();
        return redirect()->back()->with('success', 'Réservation refusée.');
    }

    public function mesReservations()
    {
        $reservations = Reservation::where('client_id', auth()->id())
            ->with('logement')
            ->latest()
            ->get();

        return view('dashboard.client.reservations', compact('reservations'));
    }
}
