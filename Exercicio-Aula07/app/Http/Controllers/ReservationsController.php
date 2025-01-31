<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Architecture\Application\Domain\DTO\CreateReservationInputDTO;
use Architecture\Application\Domain\Exception\NotFoundResourceException;
use Architecture\Application\UseCase\CreateReservationUseCase;
use Architecture\Application\UseCase\FindReservationByIdUseCase;
use Architecture\Application\UseCase\FindStoredBookByIdUseCase;
use Architecture\Application\UseCase\FindUserByIdUseCase;
use Architecture\Application\UseCase\RegisterReturnReservationUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use TypeError;

class ReservationsController extends Controller
{
    public function __construct(
        private FindReservationByIdUseCase $findReservationByIdUseCase,
        private FindUserByIdUseCase $findUserByIdUseCase,
        private FindStoredBookByIdUseCase $findStoredBookByIdUseCase,
        private CreateReservationUseCase $createReservationUseCase,
        private RegisterReturnReservationUseCase $registerReturnReservationUseCase
    )
    { }

    public function create(Request $request): JsonResponse
    {
        try {
            $reservationInputDTO = new CreateReservationInputDTO(
                $request->user_id,
                $request->stored_book_id,
                now()->format('Y-m-d H:i:s')
            );

            $this->findUserByIdUseCase->execute($reservationInputDTO->getUserId());
            $this->findStoredBookByIdUseCase->execute($reservationInputDTO->getStoredBookId());
        } catch (TypeError $e) {
            return response()->json(['error' => 'Bad Request'], 400);
        } catch (NotFoundResourceException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        } catch (Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }

        $reservationEntity = $this->createReservationUseCase->execute($reservationInputDTO);

        return response()->json($reservationEntity, JsonResponse::HTTP_CREATED);
    }

    public function saveReturn(Request $request): JsonResponse
    {
        $reservationId = $request->input('reservation_id');
        $returnDate = $request->input('return_date');

        try {
            $reservationEntity = $this->registerReturnReservationUseCase->execute($reservationId, $returnDate);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }

        return response()->json($reservationEntity, JsonResponse::HTTP_ACCEPTED);
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
        
        return response()->json([
            'reservation_cost' => $reservationEntity->getReservationCost($costPerDay),
            'cost_per_day' => 'R$ ' . number_format($costPerDay, 2, ',', '.'),
            'reservedDays' => $reservationEntity->getReservedDays(),
            'reservation' => $reservationEntity,
        ]);
    }
}
