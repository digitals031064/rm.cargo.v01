<?php

use App\Models\Waybill;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipperController;
use App\Http\Controllers\WaybillController;
use App\Http\Controllers\ConsigneeController;
use App\Http\Controllers\ActivityLogController;

Route::get('/', function () {
    return view('index');
});

Route::get('/shipping-rate', function () {
    return view('shipping-rate');
});

Route::get('/tracking', function () {
    return view('tracking');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/dashboard', [ProfileController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('dashboard');


Route::post('/waybills', [WaybillController::class, 'store'])->middleware(['auth', 'verified'])->name('waybills.store');
Route::get('/waybills/{waybill}/edit', [WaybillController::class, 'edit'])->middleware(['auth', 'verified'])->name('waybills.edit');
Route::get('waybill/waybills/{id}', [WaybillController::class, 'show'])->middleware(['auth', 'verified'])->name('waybills.show');
Route::put('/waybills/{waybill}/update', [WaybillController::class, 'update'])->middleware(['auth', 'verified'])->name('waybills.update');
Route::get('/tracking/track', [ActivityLogController::class, 'track'])->name('logs.track');


Route::get('/waybill/waybills', function () {
    $statuses = [
        'Pending',
        'Arrived in Van Yard',
        'Arrived at Port of Origin',
        'Departed from Port of Origin',
        'Arrived at Port of Destination',
        'Delivered'
    ];

    $search = request()->query('search');
    $query = Waybill::with(['consignee', 'shipper'])->orderBy('created_at', 'desc');;

    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('waybill_no', 'like', "%$search%")
                ->orWhere('shipment', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%")
                ->orWhere('cbm', 'like', "%$search%")
                ->orWhereHas('shipper', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhereHas('consignee', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
        });
    }

    $waybills = $query->paginate(10);

    // If no waybills found, set a session message but still return the view
    if ($waybills->isEmpty() && !empty($search)) {
        session()->flash('message', "No waybills found for \"$search\".");
    }else{
        //dd($waybills);
    }

    return view('waybill.waybills', compact('waybills', 'statuses', 'search'));
})->middleware(['auth', 'verified'])->name('waybills');


Route::get('/waybills/search', [WaybillController::class, 'search'])->name('waybills.search');


Route::get('admin/user-management', [ActivityLogController::class, 'index'])->middleware(['auth', 'verified'])->name('user-management');

    // Consignee autocomplete
Route::get('/consignees/search', [WaybillController::class, 'searchConsignees']);
    // Shipper autocomplete
Route::get('/shippers/search', [WaybillController::class, 'searchShippers']);

Route::post('/consignees/add', [ConsigneeController::class, 'create']);
Route::post('/shippers/add', [ShipperController::class, 'create']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
