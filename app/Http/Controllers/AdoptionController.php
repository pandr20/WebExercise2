<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
//use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;

class AdoptionController extends Controller
{
    public function create()
    {
        if(Auth::check()) {
            return view('adoptions.create');
        }
        
        return redirect()->route('login');
        
        
    }

    

    public function store(Request $request)
    
    
    {
        $validated = $request->validate([
            'name'        => ['required'],
            'description' => ['required'],
            'image'       => ['file', 'image']
        ]);


        $adoption = new Adoption();
        if ($request->has('image'))
        {
            $filename = Str::random(32) . "." . $request->file('image')->extension();
            $request->file('image')->move('imgs/uploads', $filename);
            $adoption->image_path = "imgs/uploads/$filename";
        }
        else
            $adoption->image_path = "imgs/demo/4.jpg";
        $adoption->name        = $validated['name'];
        $adoption->description = $validated['description'];
        $adoption->listed_by   = auth()->id();
        $adoption->save();

        
      


       
        
            return redirect()->home()->with('success', "Post for $adoption->name created successfully");
        
    
         
        

        /*
        |-----------------------------------------------------------------------
        | Task 4 User, step 5.
        | The $adoption variable should be assigned to the logged user.
        | This is done using the listed_by field from the user column in the database.
        |-----------------------------------------------------------------------
        */

    }

    public function show(Adoption $adoption)
    {
        return view('adoptions.details', ['adoption' => $adoption]);
    }

    public function adopt(Adoption $adoption)

    {
        
        abort_if($adoption->listed_by==auth()->id(), 403);

        $adoption->adopted_by = auth()->id();
        $adoption->save();
        
        /*
        |-----------------------------------------------------------------------
        | Task 5 User, step 6. You should assing $adoption
        | The $adoption variable should be assigned to the logged user.
        | This is done using the adopted_by field from the user column in the database.
        |-----------------------------------------------------------------------
        */



        return redirect()->home()->with('success', "Pet $adoption->name adopted successfully");
    }


    public function mine(Adoption $adoptions)

    {
      

        
        $adoptions = auth()->user()->adoptions;

          
        
        
        /*
        |-----------------------------------------------------------------------
        | Task 6 User, step 3.
        | You should assing the $adoptions variable with a list of all adoptions of logged user.
        |-----------------------------------------------------------------------
        */
        return view('adoptions.list', ['adoptions' => $adoptions, 'header' => 'My Adoptions']);
    }
}
