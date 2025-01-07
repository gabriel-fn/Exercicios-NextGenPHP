<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\StoredBook;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $reservation = new Reservation($request->all());

        if (null === User::find($reservation->user_id)) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $storedBook = StoredBook::find($reservation->stored_book_id);
        if (null === $storedBook) {
            return response()->json(['error' => 'Stored book not found'], 404);
        }

        $reservation->reserved_at = now();

        $reservation->save();

        return response()->json($reservation, JsonResponse::HTTP_CREATED);
    }

    public function saveReturn(Request $request): JsonResponse
    {
        $reservationId = $request->input('reservation_id');

        $reservation = Reservation::find($reservationId);
        if (null === $reservation) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }

        if (null !== $reservation->returned_at) {
            return response()->json(['error' => 'Reservation already returned'], 403);
        }

        $returnDate = $request->input('return_date');
        if ($returnDate <= $reservation->reserved_at) {
            return response()->json(['error' => 'Return date must be greater than reserved date'], 403);
        }

        $reservation->returned_at = $returnDate;

        if (false === $reservation->save()) {
            return response()->json(['error' => 'Reservation could not be returned'], 500);
        }
        return response()->json($reservation, JsonResponse::HTTP_ACCEPTED);
    }

    public function getCost(Request $request): JsonResponse
    {
        $reservationId = $request->input('reservation_id');

        $reservation = Reservation::find($reservationId);
        if (null === $reservation) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }

        $costPerDay = 4.50;
        $reservedAt = new \DateTimeImmutable($reservation->reserved_at);
        $returnedAt = new \DateTimeImmutable($reservation->returned_at);
        $reservedDays = $returnedAt->diff($reservedAt)->days;

        $reservationCost = 'R$ ' . number_format($reservedDays * $costPerDay, 2, ',', '.');

        return response()->json([
            'reservation_cost' => $reservationCost,
            'cost_per_day' => 'R$ ' . number_format($costPerDay, 2, ',', '.'),
            'reservedDays' => $reservedDays,
            'reservation' => $reservation,
        ]);
    }
}