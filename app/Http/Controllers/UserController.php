<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // 1. Add New User
    public function createUser(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'email' => 'required|email|unique:users,email',
                'username' => 'required|unique:users,username',
            ], [
                'email.required' => 'Email is required',
                'email.email' => 'Email is not valid',
                'email.unique' => 'Email is already registered',
                'username.required' => 'Username is required',
                'username.unique' => 'Username is already taken',
            ]);

            $user = User::create([
                'email' => $validatedData['email'],
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']),
                'isActive' => true,
            ]);

            return response()->json([
                'status' => 200,
                'msg' => 'Success Add User',
                'data' => null,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 422,
                'msg' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'msg' => 'Internal Server Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // 2. Get All Users
    public function getAllUsers()
    {
        try {
            $users = User::all();
            return response()->json([
                'status' => 200,
                'msg' => 'Success',
                'data' => $users,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'msg' => 'Error Fetching Users',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // 3. Get Single User by ID
    public function getUser($userId)
    {
        try {
            $user = User::find($userId);

            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'msg' => 'User Not Found',
                ], 404);
            }

            return response()->json([
                'status' => 200,
                'msg' => 'Success',
                'data' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'msg' => 'Error Fetching User',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // 4. Update User Active Status
    public function updateUserStatus(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'id' => 'required|exists:users,id',
                'isActive' => 'required|boolean',
            ], [
                'id.required' => 'ID is required',
                'id.exists' => 'User not found',
                'isActive.required' => 'isActive is required',
                'isActive.boolean' => 'isActive must be boolean',
            ]);

            // Find the user and update the status
            $user = User::find($validatedData['id']);
            $user->isActive = $validatedData['isActive'];
            $user->save();

            return response()->json([
                'status' => 200,
                'msg' => 'Success Update Status',
                'data' => null,
            ]);
        } catch (ValidationException $e) {
            // Catch validation errors and return the response
            return response()->json([
                'status' => 422,
                'msg' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Catch any other exceptions and return a generic error message
            return response()->json([
                'status' => 500,
                'msg' => 'Internal Server Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // 5. Get Users with Pagination
    public function getUsersPaginated($limit, $page)
    {
        try {
            Paginator::currentPageResolver(function () use ($page) {
                return $page;
            });

            $users = User::paginate($limit);

            return response()->json([
                'status' => 200,
                'msg' => 'Success',
                'data' => [
                    'users' => $users->items(),
                    'max_page' => $users->lastPage(),
                    'totalData' => $users->total(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'msg' => 'Error Fetching Paginated Users',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
