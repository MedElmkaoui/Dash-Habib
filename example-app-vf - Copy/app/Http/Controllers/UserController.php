<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $users = User::where("deleted_at", null)->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'cin' => 'required|string',
            'email' => 'required|email',
            'date_rec' => 'required|date',
            'type' => 'required|in:Admin,User',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Create the user
        $user = new User;
        $user->name = $request->name;
        $user->cin = $request->cin;
        $user->email = $request->email;
        $user->date_rec = $request->date_rec;
        $user->type = $request->type;
        $user->password = bcrypt($request->password);

        // Check if a photo was uploaded and store it
        
        $photo = $request->file('photo');
        $filename = time() . '.' . $photo->getClientOriginalExtension();
        $path = $photo->move('public/photos', $filename);
        $user->photo = 'public/photos/' . $filename;

        // Save the user to the database
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

   


    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string',
            'cin' => 'required|string|unique:users,cin,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'date_rec' => 'required|date',
            'type' => 'required|in:Admin,User',
            'photo' => 'nullable|image|max:2048',
        ]);

        

        // Get the user by id
        $user =  User::findOrFail($id);
        $user->name = $request->name;
        $user->cin = $request->cin;
        $user->email = $request->email;
        $user->date_rec = $request->date_rec;
        $user->type = $request->type;
        if ($request->password !='') {
            $user->password = bcrypt($request->password);
        } 

        if ($request->hasFile('photo')) {

            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->move('public/photos', $filename);

            if ($user->photo) {
                File::delete($user->photo);
            }

            $user['photo'] = 'public/photos/' . $filename;
        }

        // Update the user to the database
        $user->update();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    

    public function destroy(User $user, Request $request)
    {

        


        //Check count of Admins 
        if($user)

        // Validate the password
        try {
            $this->validate($request, [
                'password' => 'required',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->with(['password' => 'Please enter your password.']);
        }

        if (! Auth::attempt(['email' => Auth::user()->email, 'password' => $request->password, 'type' => "Admin"])) {
            return redirect()->back()->with(['password' => 'Incorrect password.']);
        }

        $count = 0;
        $users = User::all();
        foreach ($users as $key => $user) {
           if ($user->type == "Admin") {
                $count++;
           }
        }

        if ($count == 1) {
            return redirect()->back()->with('Error', 'Erreur: impossible de suprimer tous les Admin');
        }

        
        
        if(count(User::all())==1){
            return redirect()->back()->with('Error', 'Vous ne pouvez pas supprimer tous les utilisateurs');
        }

        if ($user->photo) {
            File::delete($user->photo);
        }

        $user->delete();
        $user->save();

        return redirect()->route('users.index')->with('success', 'Item deleted successfully.');
    }

}
