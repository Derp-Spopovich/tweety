<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tweet;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Storage;

class ProfilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('profiles.show', ['user' => $user, 'tweets' => $user->tweets()->withLikes()->paginate(10)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // if (auth()->user()->isNot($user)) {
        //     \abort(403);
        // }
        $this->authorize('edit', $user);  //calls the policy method edit ,if the user is the owner , he can edit
        return view('profiles.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('edit', $user);  //calls the policy method edit ,if the user is the owner , he can edit

        $attributes = request()->validate([
            'username' => ['required','string','max:255','alpha_dash',Rule::unique('users')->ignore($user)],
            'name' => 'required|string|max:255',
            'email' =>  ['required','string','email','max:255',Rule::unique('users')->ignore($user)],
            'bio' => 'string|max:255',
            'avatar' => ['image'],
            // 'password' => 'required|string|min:8|max:255|confirmed',  //see the user model password attribute for hashing the password
            'background' => ['image']
        ]);

        // if (request('avatar')) {
        //     Storage::disk('public')->delete('avatars/' .$user->avatar);
        //     $attributes['avatar'] = request('avatar')->store('avatars');
        // }

        // if (request('avatar')) {
        //     //Get file with the extension
        //     $fileNameWithExt = $request->file('avatar')->getClientOriginalName();
        //     //Get just filename
        //     $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //     //Get just extension
        //     $extension = $request->file('avatar')->getClientOriginalExtension();
        //     //Filename to store to make it unique para d ma delete if naay kaparihas ngan ang e upload
        //     $fileNameToStore = $fileName.'_'.time().'.'.$extension;
        //     //upload image to public directory
        //     $path = $request->file('avatar')->move(public_path('/avatars'), $fileNameToStore);
        // }

        // if (request('background')) {
        //     //Get file with the extension
        //     $fileNameWithExt = $request->file('background')->getClientOriginalName();
        //     //Get just filename
        //     $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //     //Get just extension
        //     $extension = $request->file('background')->getClientOriginalExtension();
        //     //Filename to store to make it unique para d ma delete if naay kaparihas ngan ang e upload
        //     $fileNameToStoreBackGround = $fileName.'_'.time().'.'.$extension;
        //     //upload image to public directory
        //     $path = $request->file('background')->move(public_path('/backgrounds'), $fileNameToStoreBackGround);
        // }

        if (request('avatar')) { 
            $attributes['avatar'] = request('avatar')->store('', ['disk' => 'avatars']);
        }
           
        if (request('background')) {
            $attributes['background'] = request('background')->store('', ['disk' => 'backgrounds']);
        }

        $user->update($attributes);

        // $user->username = request()->input('username');
        // $user->name = request()->input('name');
        // $user->email = request()->input('email');
        // $user->bio = request()->input('bio');
        // $user->avatar = $fileNameToStore;
        // $user->background = $fileNameToStoreBackGround;
        // $user->update();
        return redirect()->route('profile', [$user])->with('success', 'Profile successully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function avatar(Request $request, User $user)
    // {
    //     $this->authorize('edit', $user);

    //     request()->validate([
    //         'avatar' => ['image']
    //     ]);

    //     if (request('avatar')) {
    //         //Get file with the extension
    //         $fileNameWithExt = $request->file('avatar')->getClientOriginalName();
    //         //Get just filename
    //         $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    //         //Get just extension
    //         $extension = $request->file('avatar')->getClientOriginalExtension();
    //         //Filename to store to make it unique para d ma delete if naay kaparihas ngan ang e upload
    //         $fileNameToStore = $fileName.'_'.time().'.'.$extension;
    //         //upload image to public directory
    //         $path = $request->file('avatar')->move(public_path('/avatars'), $fileNameToStore);
    //     }

    //     $user->avatar = $fileNameToStore;
    //     $user->save();
    //     return back()->with('success', 'avatar updated');
    // }

}
