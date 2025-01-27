<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\StoredBook;
use App\Models\User;
use Architecture\Application\Domain\Exception\NotFoundResourceException;
use Architecture\Application\UseCase\FindReservationByIdUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function __construct(
        private FindReservationByIdUseCase $findReservationByIdUseCase
    )
    { }

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

        try {
            $reservationEntity = $this->findReservationByIdUseCase->execute($reservationId);
        } catch (NotFoundResourceException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }

        $costPerDay = 4.50;

        $reservationCost = 'R$ ' . number_format($reservationEntity->getReservedDays() * $costPerDay, 2, ',', '.');

        return response()->json([
            'reservation_cost' => $reservationCost,
            'cost_per_day' => 'R$ ' . number_format($costPerDay, 2, ',', '.'),
            'reservedDays' => $reservationEntity->getReservedDays(),
            'reservation' => $reservationEntity,
        ]);
    }
}
