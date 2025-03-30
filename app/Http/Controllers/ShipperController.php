<?php

namespace App\Http\Controllers;

use App\Models\Shipper;
use Illuminate\Http\Request;

class ShipperController extends Controller
{
    //
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'shipping_address' => 'nullable|string|max:255',
        ]);

        // Create the new consignee
        $shipper = Shipper::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'shipping_address' => $request->shipping_address,
            // You can also add other fields like phone_number if necessary
        ]);

        return response()->json([
            'success' => true,
            'message'=> 'Shipper created successfully',
            'newShipper' => [
                'id' => $shipper->id,
                'name' => $shipper->name,
                'phone_number' => $shipper->phone_number,  // Return only necessary fields
            ]
        ]);
    }
}
