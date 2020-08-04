<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            // $Post->id
            'post_id'   => $this->id, // when run it (this) keyword is changed to which object passed to in this case pass Post
            'author'      => new AutherResource($this->author),
            'post_body' => $this->body,
            'status'    => $this->status,
            'likes'     =>$this->likes,
            'created_at'=> $this->created_at->toDayDateTimeString(),
            'comment'   => CommentResource::collection($this->comments) // $this->comments is reference to comments method in Post model
        ];
    }
}
