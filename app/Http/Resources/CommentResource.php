<?php

namespace App\Http\Resources;

use App\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $comment = [
            'comment_id'    => $this->id,
            'comment_body'  => $this->body,
            'likes'         =>$this->likes,
            'created_at'    => $this->created_at->toDayDateTimeString(),
            'author'        => new AutherResource($this->author) // use (new) because Author Resource is haven't Recourse collection
        ];

        // if the sub comment is grater than 0, inject the sub comment to comments or just return a root comment
        if($this->comment->count() > 0){
            $comment['comments'] = CommentResource::collection( $this->comment );// $this->comment is reference to comments method in Comment model
        }

        return $comment;
    }
}
