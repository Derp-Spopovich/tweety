<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetsController extends Controller
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
        $tweets = auth()->user()->timeline(); //get the object timeline() from user model
        return view('tweets.index')->with('tweets', $tweets);
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
        request()->validate([
            'body'=> 'required|max:255',
            'tweet_image' => 'image'
        ]);

        if ($request->hasFile('tweet_image')) {
            //Get file with the extension
            $fileNameWithExt = $request->file('tweet_image')->getClientOriginalName();
            //Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('tweet_image')->getClientOriginalExtension();
            //Filename to store to make it unique para d ma delete if naay kaparihas ngan ang e upload
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //upload image to public directory
            $path = $request->file('tweet_image')->move(public_path('/tweet_images'), $fileNameToStore);
        } else {
            $fileNameToStore = null;
        }

        $tweets = New Tweet;
        $tweets->user_id = auth()->user()->id;
        $tweets->body = request()->input('body');
        $tweets->tweet_image = $fileNameToStore;
        $tweets->save();

        return redirect('/tweet')->with('success', 'Tweet added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $tweet)
    {
        $this->authorize('delete',  $tweet);

        $tweet->delete();
        
        return back()->with('success', 'Tweet successfully deleted');
    }
}
