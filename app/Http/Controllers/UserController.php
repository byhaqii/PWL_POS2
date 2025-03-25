<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function page() {
        $users = User::with('level')->get();
        $levels = Level::all();
        $metadata = [
            'pageTitle' => 'Users',
            'breadcrumbs' => [
                [
                    'name' => 'Users',
                    'route' => 'users.page'
                ],
                [
                    'name' => 'List',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.user.index', compact('users', 'levels', 'metadata'));
    }

    public function storePage() {
        $levels = Level::all();
        $metadata = [
            'pageTitle' => 'Create User',
            'breadcrumbs' => [
                [
                    'name' => 'Users',
                    'route' => 'users.page'
                ],
                [
                    'name' => 'Create',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.user.store', compact('metadata', 'levels'));
    }

    public function updatePage(string $id) {
        $user = User::with('level')->findOrFail($id);
        $levels = Level::all();
        $metadata = [
            'pageTitle' => 'Update User',
            'breadcrumbs' => [
                [
                    'name' => 'Users',
                    'route' => 'users.page'
                ],
                [
                    'name' => 'Update',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.user.update', compact('metadata', 'user', 'levels'));
    }

    public function list(Request $request) {
        $users = User::with('level');

        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
        ->addIndexColumn()
        ->addColumn('actions', function ($user) {
            $btn = '<a href="' . route('users.show', ['id' => $user->user_id]) . '" class="btn btn-primary btn-sm">Details</a>';
            $btn .= '<a href="' . route('users.update-page', ['id' => $user->user_id]) . '" class="btn btn-warning btn-sm ml-0 ml-md-2">Update</a>';
            $btn .= '<form action="' . route('users.delete', ['id' => $user->user_id]) . '" method="POST" style="display:inline-block;">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm ml-0 ml-md-2" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</button></form>';

            return $btn;
        })
        ->addColumn('actions-ajax', function ($user) {
            $btn = '<button type="button" class="details-user-ajax-btn btn btn-primary btn-sm ml-0 ml-md-2" data-toggle="modal" data-target="#detailsUserAjaxModal" data-id="' . $user->user_id . '">Details</button>';
            $btn .= '<button type="button" class="update-user-ajax-btn btn btn-warning btn-sm ml-0 ml-md-2" data-toggle="modal" data-target="#updateUserAjaxModal" data-id="' . $user->user_id . '">Update</button>';
            $btn .= '<button type="button" class="delete-user-ajax-btn btn btn-danger btn-sm ml-0 ml-md-2" data-id="' . $user->user_id . '">Delete</button>';

            return $btn;
        })
        ->rawColumns(['actions', 'actions-ajax'])
        ->make(true);
    }

    public function store(UserRequest $request) {
        $validatedData = $request->validated();

        User::create([
            'level_id' => $validatedData['level_id'],
            'username' => $validatedData['username'],
            'name' => $validatedData['name'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('users.page')->with('success', 'User created successfully.')->withInput($request->only('username', 'name'));
    }

    public function storeAjax(UserRequest $request) {
        if (!$request->validated()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user. Please check again your data.',
                'errors' => $request->errors(),
            ]);
        }

        $validatedData = $request->validated();
        User::create([
            'level_id' => $validatedData['level_id'],
            'username' => $validatedData['username'],
            'name' => $validatedData['name'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully.',
            'data' => $validatedData
        ]);
    }

    public function show(string $id) {
        $user = User::with('level')->findOrFail($id);
        $metadata = [
            'pageTitle' => 'User Details',
            'breadcrumbs' => [
                [
                    'name' => 'Users',
                    'route' => 'users.page'
                ],
                [
                    'name' => 'Details',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.user.show', compact('user', 'metadata'));
    }

    public function showAjax(string $id) {
        $user = User::with('level')->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'User details found.',
            'data' => $user
        ]);
    }

    public function update(UserRequest $request, string $id) {
        $validatedData = $request->validated();

        $user = User::findOrFail($id);
        $user->update([
            'level_id' => $validatedData['level_id'],
            'username' => $validatedData['username'],
            'name' => $validatedData['name'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('users.page')->with('success', 'User updated successfully.')->withInput($request->only('username', 'name'));
    }
    
    public function updateAjax(UserRequest $request, string $id) {
        if (!$request->validated()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user. Please check again your data.',
                'errors' => $request->errors(),
            ]);
        }

        $validatedData = $request->validated();

        $user = User::findOrFail($id);
        $user->update([
            'level_id' => $validatedData['level_id'],
            'username' => $validatedData['username'],
            'name' => $validatedData['name'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully.',
            'data' => $validatedData
        ]);
    }

    public function delete(string $id) {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.page')->with('success', 'User deleted successfully.');
    }

    public function deleteAjax(string $id) {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully.',
            'data' => $user
        ]);
    }
}