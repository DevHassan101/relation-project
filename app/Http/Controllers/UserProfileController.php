<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userProfiles = UserProfile::with('user')->orderBy('created_at', 'desc')->paginate(10);


        if ($request->ajax()) {
            $html = view('pages.admin.UserProfile.table', compact('userProfiles'))->render();
            $records = $userProfiles;
            $pagination = view('pages.admin.append.pagination', compact('records'))->render();

            return response()->json([
                'error' => false,
                'html' => $html,
                'pagination' => $pagination
            ]);
        }

        return view('pages.admin.UserProfile.index', compact('userProfiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.UserProfile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    public function show(UserProfile $profile)
    {

        $profile->load('user');

        return view('pages.admin.UserProfile.show', compact('profile'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
