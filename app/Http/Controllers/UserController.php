<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'app-id' => '65dca3abafdc1b08b5688477'
        ])->get('https://dummyapi.io/data/v1/user?limit=10');

        $users = $response->json()['data'];

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
        ]);

        $response = Http::post('https://dummyapi.io/data/v1/user/create', [
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
        ]);

        return redirect('/users/create')->with('success', 'User created successfully!');
    }

    public function show()
    {
        $users = User::all();
        return view('home.users', compact('users'));
    }


    public function add()
    {
        return view('users.add');
    }

    public function storedata(Request $request)
    {
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users'),
            ],
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users'),
            ],
            'password' => 'required|string|min:8',
            'role' => 'required|integer|in:0,1',
        ]);


        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role
        ]);

        return redirect('/users')->with('success', 'Users created successfully.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users'),
            ],
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users'),
            ],
            'password' => 'required|string|min:8',
            'role' => 'required|integer|in:0,1',
        ]);
    
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;
    
        $user->save();
    
        return redirect()->route('users.edit', $user->id)->with('success', 'Users updated successfully.');
    }

    public function destroy(User $user)
    {
       
    
        $user->delete();
    
        return redirect('/users')->with('success', 'User deleted successfully.');
    }

}