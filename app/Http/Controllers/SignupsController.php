<?php

namespace App\Http\Controllers;

use App\Models\Signup;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class SignupsController extends Controller
{
    /**
     * Store a user record in the database
     * @param Request $request the request data
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:signups',
            'first_name' => 'required',
            'last_name' => 'required',
            'opt_in' => 'required|boolean'
        ]);

        try {
            $signup = new Signup;
            $signup->email = $request->email;
            $signup->first_name = $request->first_name;
            $signup->last_name = $request->last_name;
            $signup->opt_in = $request->opt_in;
            $signup->save();
        } catch (\Exception $e) {
            return new Response([
                'message' => 'A database error occurred while storing the signup'
            ], 500);
        }

        return new Response([
            'message' => 'Signup stored successfully'
        ], 200);
    }

    /**
     * Update a user's signup
     * @param Request $request the request data
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'first_name' => '',
            'last_name' => '',
            'opt_in' => 'boolean'
        ]);

        try {
            $signup = Signup::where('email', $request->email)->first();
        } catch (\Exception $e) {
            return new Response([
                'message' => 'A database error occurred while getting the signup'
            ], 500);
        }

        if (! $signup) {
            return new Response([
                'message' => 'No matching signup found'
            ], 404);
        }

        if ($request->has('first_name')) {
            $signup->first_name = $request->first_name;
        }

        if ($request->has('last_name')) {
            $signup->last_name = $request->last_name;
        }

        if ($request->has('opt_in')) {
            $signup->opt_in = $request->opt_in;
        }

        try {
            $signup->save();
        } catch (\Exception $e) {
            return new Response([
                'message' => 'A database error occurred while updating the signup'
            ], 500);
        }

        return new Response([
            'message' => 'Signup updated successfully'
        ], 200);
    }
}
