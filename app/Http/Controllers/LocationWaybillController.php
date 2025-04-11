<?php
namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Waybill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationWaybillController extends Controller
{
    public function getNextWaybillNumber($locationId)
    {
        DB::beginTransaction();

        try {
            // Lock the location record to ensure no other process can update it simultaneously
            $location = Location::where('id', $locationId)
                ->lockForUpdate()
                ->first();

            // Lock the latest waybill for the given location, sorted by created_at and id to handle same timestamps
            $lastWaybill = Waybill::where('location_id', $locationId)
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'desc') // Added sorting by ID to handle same timestamps
                ->lockForUpdate()
                ->first();

            // Extract the numeric part of the waybill number and increment
            $prefix = strtoupper(substr($location->name, 0, 3)); // Prefix from location name

            // Get the last number by extracting the numeric part of the waybill number
            $lastNumber = $lastWaybill ? (int) substr($lastWaybill->waybill_no, 4) : 0; // Example: ZAM-000010 -> 10
            $nextNumber = $lastNumber + 1; // Increment the last number

            // Format the next number with leading zeros (total of 6 digits)
            $nextWaybillNo = $prefix . '-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

            // Debugging: log the last waybill number and extracted last number
            \Log::info("Last Waybill: " . ($lastWaybill ? $lastWaybill->waybill_no : 'None'));
            \Log::info("Extracted Last Number: " . $lastNumber);
            \Log::info("Next Waybill Number: " . $nextWaybillNo);

            DB::commit(); // Commit the transaction after completing the process

            return response()->json([
                'next_waybill_no' => $nextWaybillNo,
                'last_waybill_no' => $lastWaybill ? $lastWaybill->waybill_no : 'None', // Return last waybill for debugging
                'last_number' => $lastNumber
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Could not generate next waybill number.'], 500);
        }
    }
}



