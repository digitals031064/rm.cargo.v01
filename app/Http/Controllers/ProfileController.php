<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Waybill;
use App\Models\ActivityLog;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show(){
        $users = User::simplePaginate(5);
        $waybills = Waybill::where('status', '!=', 'Delivered')
            ->with('consignee') // Prevents N+1 query issue
            ->orderBy('updated_at', 'asc')
            ->simplePaginate(5);

        $waybillCounts = Waybill::selectRaw('COUNT(*) as total, SUM(CASE WHEN status != "Delivered" THEN 1 ELSE 0 END) as active')
                            ->first();

        $totalWaybills = $waybillCounts->total;
        $activeWaybills = $waybillCounts->active;
        $deliveredWaybills = Waybill::where('status', 'Delivered')->count();

        //$logs = ActivityLog::simplePaginate(5);
        $logs = ActivityLog::with(['user', 'waybill'])->latest()->simplePaginate(5);

        $user = auth()->user(); // Get the authenticated user

        if ($user->usertype === 'admin') {
            return view('admin.dashboard', compact('waybills','users', 'logs', 'totalWaybills', 'activeWaybills', 'deliveredWaybills'));
        } else {
            return view('dashboard', compact('waybills', 'totalWaybills', 'activeWaybills', 'deliveredWaybills'));
        }
    }

    public function updateStatus(Request $request, Waybill $waybill){

        $request->validate([
            'status' => 'required|string|in:Pending,Arrived in Van Yard,Arrived at Port of Origin,Departed from Port of Origin,Arrived at Port of Destination,Delivered',
        ]);

        $waybill->status = $request->status;
        $waybill->save();

        return back()->with('success', "Waybill #{$waybill->waybill_no}'s waybill status has been updated to {$waybill->status} successfully.");
    }

    public function updateOffice(Request $request, User $user){

        $request->validate([
            'office' => 'required|string|in:CEB,MNL,ZAM'
        ]);

        $user->office = $request->office;
        $user->save();

        return back()->with('success', "User office updated successfully for {$user->name}");
        
    }
}
