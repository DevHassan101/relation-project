<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\FlareClient\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::with('roles')->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            $html = view('pages.admin.users.table', compact('users'))->render();
            $records = $users;
            $pagination = view('pages.admin.append.pagination', compact('records'))->render();

            return response()->json([
                'error' => false,
                'html' => $html,
                'pagination' => $pagination
            ]);
        }

        return view('pages.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validation = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable',
            'profile'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'nullable',
            'address' => 'nullable',
            'dob' => 'nullable',
            'password' => 'required',
        ]);

        $validation['password'] = Hash::make($request->password);

        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $name_gen = hexdec(uniqid() . '.' . $image->getClientOriginalExtension());
            $image->move('uploads/users/profile', $name_gen);
            $validation['profile'] = 'uploads/users/profile/' . $name_gen;
        }

        $user = User::create($validation);
        $validation['user_id'] = $user->id;
        $validation['created_by'] = auth()->user()->id;
        UserProfile::create($validation);
        $user->assignRole('user');

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load('profile');
        return view('pages.admin.users.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $validation = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable',
            'profile'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'nullable',
            'address' => 'nullable',
            'dob' => 'nullable',
            'password' => 'nullable',
        ]);


        if ($request->hasFile('profile')) {
            if ($user->userInfo?->profile && file_exists(public_path($user->userInfo->profile))) {
                unlink(public_path($user->userInfo->profile));
            }

            $image = $request->file('profile');
            $name_gen = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/users/profile'), $name_gen);
            $validation['profile'] = 'uploads/users/profile/' . $name_gen;
        }

        if ($request->filled('password')) {
            $validation['password'] = Hash::make($request->password);
        } else {
            unset($validation['password']);
        }

        if ($request->email !== $user->email) {
            $user->email_verified_at = null;
        }

        $validation['user_id'] = $user->id;
        $user->update($validation);

        UserProfile::where('user_id', $user->id)->firstOrFail()->update($validation);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->userInfo) {
            $user->userInfo->delete();
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
