<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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
        $this->authorize('viewAny', Comment::class);

        $comments = Comment::orderBy('id', 'desc')->paginate(7);
        return response()->view('cms.comments.index', compact('comments'));
    }


    public function store(Request $request)
    {
        $this->authorize('create', Comment::class);

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
            $authId= auth()->id();
           if (auth('author')) {
                $authname = Author::findOrFail($authId)->user->first_name . ' ' . Author::findOrFail($authId)->user->last_name;
                $authImage = Author::findOrFail($authId)->user->image;

            }
            $comment->name= $authname;
            $comment->image= $authImage;
            $comment->comment = $request->comment;
            $comment->article_id = $request->article_id;

            $issaved = $comment->save();

            return ['redirect' => route('detail', $comment->article_id)];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Commented successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'failed to Comment'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.comments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Comment::class);
        $comment = Comment::findOrFail($id);
        $delete = $comment->delete();
    }
}