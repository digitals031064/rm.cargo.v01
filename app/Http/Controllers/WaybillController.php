<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Waybill;
use App\Models\Shipper;
use App\Models\Consignee;



class WaybillController extends Controller
{
    public function index()
    {
        $waybills = Waybill::with(['consignee', 'shipper'])->get();
        return view('waybills', compact('waybills'));
    }

    public function create()
    {
        return view('create-waybill');
    }   

    public function store(Request $request)
    {
        $data = $request->validate([
            
            'van_no' => 'nullable',
            'consignee_id' => 'required|integer|exists:consignees,id',
            'shipper_id' => 'required|integer|exists:shippers,id',
            'shipment' => 'required',
            'cbm' => 'nullable|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'declared_value' => 'nullable|numeric|max:999999.99',
            'price' => 'nullable|numeric|max:999999.99',
            'status' => 'required',
        ]);
        $data['user_id'] = auth()->id();

        $waybill = Waybill::create($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'waybill' => [
                    'id' => $waybill->id,
                    'waybill_no' => $waybill->waybill_no,
                    'van_no' => $waybill->van_no,
                    'consignee_id' => $waybill->consignee_id,
                    'consignee_name' => $waybill->consignee->name,  // ✅ Make sure this exists
                    'consignee_phone' => $waybill->consignee->phone_number,
                    'shipper_id' => $waybill->shipper_id,
                    'shipper_name' => $waybill->shipper->name,
                    'shipper_phone' => $waybill->shipper->phone_number,
                    'shipment' => $waybill->shipment,
                    'cbm' => $waybill->cbm,
                    'weight' => $waybill->weight,
                    'declared_value' => $waybill->declared_value,
                    'price' => $waybill->price,
                    'status' => $waybill->status,
                    'user_id' => $waybill->user_id
                ]
            ]);
        }

       

    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:3'
        ]);

        $waybills = Waybill::where('number', 'LIKE', "%{$request->query('query')}%")
                            ->get();

        if ($waybills->isEmpty()) {
            return response()->json(['message' => 'No waybills found.'], 404);
        }

        return response()->json($waybills);
    }
    

    public function show($id) {
        $waybill = Waybill::with(['consignee', 'shipper'])->findOrFail($id);
        return response()->json($waybill);
    }
 
    public function getNextWaybillNo(Request $request){
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $office = $user->office;

        if ($office === 'CEB') {
            // CEB users: waybill starts with 'C'
            $last = DB::table('waybills')
                ->where('waybill_no', 'LIKE', 'C%')
                ->orderByDesc(DB::raw('CAST(SUBSTRING(waybill_no, 2) AS UNSIGNED)'))
                ->value('waybill_no');

            $number = $last ? ((int) substr($last, 1)) + 1 : 100000;
            $next = 'C' . $number;

        } elseif ($office === 'ZAM') {
            // ZAM users: waybill starts with 'B'
            $last = DB::table('waybills')
                ->where('waybill_no', 'LIKE', 'B%')
                ->orderByDesc(DB::raw('CAST(SUBSTRING(waybill_no, 2) AS UNSIGNED)'))
                ->value('waybill_no');

            $number = $last ? ((int) substr($last, 1)) + 1 : 100000;
            $next = 'B' . $number;

        } else {
            // All others (e.g., MNL): plain numeric waybill
            $last = DB::table('waybills')
                ->where('waybill_no', 'NOT LIKE', 'C%')
                ->where('waybill_no', 'NOT LIKE', 'B%')
                ->orderByDesc(DB::raw('CAST(waybill_no AS UNSIGNED)'))
                ->value('waybill_no');

            $next = $last ? ((int) $last) + 1 : 100000;
        }

        return response()->json(['next_waybill_no' => (string) $next]);
    }

    public function update(Waybill $waybill, Request $request){
        //dd($request);
        DB::enableQueryLog();

        // for validation foreign keys must be passed as integers
        $data = $request->validate([
            'waybill_no' => 'required|unique:waybills,waybill_no,' . $waybill->id,
            'van_no' => 'nullable',
            'consignee_id' => 'required|integer|exists:consignees,id',
            'shipper_id' => 'required|integer|exists:shippers,id',
            'shipment' => 'required',
            'cbm' => 'nullable|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'declared_value' => 'nullable|numeric|max:999999.99',
            'price' => 'nullable|numeric|max:999999.99',
            'status' => 'required',
        ]);

        //dd($request->all());
        $waybill->update($data);
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'waybill' => $waybill,  // Send updated data back
                'message' => $data['waybill_no'].' waybill updated successfully',
            ]);
        }

        Log::info('Executed SQL Queries:', DB::getQueryLog());

        return redirect(route('waybills'))->with('success', 'waybill updated successfully');
    }

    public function track(Request $request){
        $waybill = null;

        if ($request->has('waybill_no')) {
            $request->validate([
                'waybill_no' => 'required|digits:6' 
            ]);

            $waybill = Waybill::where('waybill_no', $request->waybill_no)->first();
            
        }

        return view('tracking', compact('waybill'));
    }

    //for auto-complete
    /* Get consignees for autocomplete via AJAX.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\JsonResponse
    */
   public function searchConsignees(Request $request)
   {
       $search = $request->get('query');
       $consignees = Consignee::where('name', 'like', '%' . $search . '%')
                             ->orWhere('phone_number', 'like', '%' . $search . '%')
                             ->limit(10)
                             ->get(['id', 'name', 'phone_number','billing_address']);

       return response()->json($consignees);
   }

           /**
     * Get consignees for autocomplete via AJAX.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchShippers(Request $request)
    {
        $search = $request->get('query');
        $shippers = Shipper::where('name', 'like', '%' . $search . '%')
                              ->orWhere('phone_number', 'like', '%' . $search . '%')
                              ->limit(10)
                              ->get(['id', 'name', 'phone_number','shipping_address']);

        return response()->json($shippers);
    }
    
}
