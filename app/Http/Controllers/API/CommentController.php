<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('viewAny', Comment::class);

        $comments = Comment::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => 'All comments In Data Base ',
            'data' => $comments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Comment::class);

        $validator = validator(
            $request->all(),
            [

                'comment' => 'required | string ',
                'article_id' => 'required',

            ],
            [
                'comment.required' => 'Enter Your Comment .. ',
            ]

        );

        if (!$validator->fails()) {
            $comment = new Comment();

            $authId = auth()->user();
            $id = $authId->id;

            $author = Author::where('id',$id)->first();

            $authname = $author->user->first_name . ' '. $author->user->last_name ;
            $authImage = $author->user->image;

            $comment->image = $authImage;
            $comment->name = $authname;

            $comment->comment = $request->comment;
            $comment->article_id = $request->article_id;

            $issaved = $comment->save();

            if ($issaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Commented successfully',
                    'RequestStatus' => 200,
                    'a' => $authname
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to comment ',
                    'RequestStatus' =>  400
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first(),
                'RequestStatus' => 400
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->authorize('delete', Comment::class);
        $comment = Comment::findOrFail($id);
        $delete = $comment->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}