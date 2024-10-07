<?php

namespace App\Repositories;

use App\Events\AddBookingEvent;
use App\Events\CancelBookingEvent;
use App\Helpers\DateNow;
use App\Helpers\LogHelper;
use App\Interfaces\BookingRepositoryInterface;
use App\Models\Booking;
use App\Models\Trip;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;


class BookingRepository implements BookingRepositoryInterface
{

    public function createBooking(array $input): JsonResponse
    {
        DB::beginTransaction();
        try {
            $trip = Trip::find($input['trip_id']);

            $input['user_id'] = Auth::id();
            Booking::create($input);

            Event::dispatch(new AddBookingEvent($trip, $input['seats_booked']));
            DB::commit();

            LogHelper::logInfo('create_booking', 'Booking successful', $input);

            return response()->json(['message' => 'The Booking is added Successfully'], 201);
        } catch (\Exception $e) {

            DB::rollBack();

            LogHelper::logError('create_booking', 'Booking failed due to exception', [
                'error_message' => $e->getMessage(),
                'input' => $input
            ]);

            return response()->json(['message' => $e->getMessage()], 422);
        }
    }


    public function destroyBooking(int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $book = Booking::where('id', $id)
                ->where('user_id', Auth::id())
                ->first();

            if (empty($book)) {
                LogHelper::logWarning('cancel_booking', 'Booking not found for cancellation', [
                    'booking_id' => $id,
                    'user_id' => Auth::id(),
                ]);

                return response()->json(['message' => 'The book is not found'], 404);
            }

            $dateNow = DateNow::presentTime(now());
            $trip = Trip::find($book->trip_id);

            if ($trip->start_date > $dateNow || $trip->end_date < $dateNow) {
                $book->delete();

                Event::dispatch(new CancelBookingEvent($trip, $book->seats_booked));
                DB::commit();

                LogHelper::logInfo('cancel_booking', 'Booking cancelled successfully', [
                    'user_id' => Auth::id(),
                    'trip_id' => $book->trip_id,
                    'seats_cancelled' => $book->seats_booked
                ]);

                return response()->json(['message' => 'Booking cancelled successfully'], 200);
            } else {

                LogHelper::logWarning('cancel_booking', 'Booking cancellation failed due to trip start date', [
                    'user_id' => Auth::id(),
                    'trip_id' => $book->trip_id,
                    'trip_start_date' => $trip->start_date
                ]);

                return response()->json(['message' => 'you cannot cancel your book']);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            LogHelper::logError('cancel_booking', 'Booking cancellation failed due to exception', [
                'error_message' => $e->getMessage(),
                'booking_id' => $id,
                'user_id' => Auth::id(),
            ]);

            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
