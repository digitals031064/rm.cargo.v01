<?php

namespace App\Http\Controllers;

use App\Models\Consignee;
use Illuminate\Http\Request;

class ConsigneeController extends Controller
{
    //
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'billing_address' => 'nullable|string|max:255',
        ]);

        // Create the new consignee
        $consignee = Consignee::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'billing_address' => $request->billing_address,
            // You can also add other fields like phone_number if necessary
        ]);

        return response()->json([
            'success' => true,
            'message'=> 'Consignee created successfully',
            'newConsignee' => [
                'id' => $consignee->id,
                'name' => $consignee->name,
                'phone_number' => $consignee->phone_number,  // Return only necessary fields
            ]
        ]);
    }

}
