<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $adoptions = Adoption::latest()->unadopted()->get();
        return view('adoptions.list', ['adoptions' => $adoptions, 'header' => 'Available for adoption']);
    }

    public function login()
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {

        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($attributes)) {
            return redirect('/');
        }


        /*
        |-----------------------------------------------------------------------
        | Task 3 Guest, step 5. You should implement this method as instructed
        |-----------------------------------------------------------------------
        */
    }

    public function register()
    {
        return view('register');
    }

    public function doRegister(Request $request)
    {
        $attributes = request()->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required_with:password-confirmation|max:255',
        'password-confirmation' => 'required|same:password|max:255'
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/');
        /*
        |-----------------------------------------------------------------------
        | Task 2 Guest, step 5. You should implement this method as instructed
        |-----------------------------------------------------------------------
        */
        }

    public function logout()
    {

        Auth::logout();
        return redirect('/');
        /*
        |-----------------------------------------------------------------------
        | Task 2 User, step 3. You should implement this method as instructed
        |-----------------------------------------------------------------------
        */
    }
}
