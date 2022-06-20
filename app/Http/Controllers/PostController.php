<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Subscribe;
use App\Jobs\SendMailToSubscribeUserOnPostCreation;

class PostController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'website_id' => 'required|numeric'
        ]);

        $postModel = new Post();
        $postModel->title = $request->title;
        $postModel->description = $request->description;
        $postModel->website_id = $request->website_id;
        $postModel->save();

        if (isset($postModel->id) && $postModel->id) {
            $subscribers = Subscribe::where('website_id', $request->website_id)->get();

            // print_r(['subscriber' => $subscribers, 'post' => $postModel]);

            foreach ($subscribers as $subscriber) {
                dispatch(new SendMailToSubscribeUserOnPostCreation($subscriber->email, $postModel->title, $postModel->description));
            }


            return Response()->json(['status' => 'success', 'subscribers' => $subscribers]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
