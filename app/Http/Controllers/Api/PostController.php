<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->middleware([
            'auth:sanctum'
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PostResource::collection( Post::paginate(15) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return PostResource
     */
    public function store(PostRequest $request)
    {
        // to store data to post table

        return new PostResource(
            Post::create([
                'user_id' => 33,
                'body'      => $request->body,
                'status'    => $request->has('status') ? $request->status : 'draft'
            ])
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return PostResource
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        if($request->has('status')){
            $post->status = $request->status;
        }
        if($request->has('body')){
            $post->body = $request->body;
        }

        $post->save();
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        Post::destroy($post->id);
        return response()->json([]);
    }
}
