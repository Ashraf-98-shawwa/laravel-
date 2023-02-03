<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return response()->json([
            'status' => 'true',
            'message' => 'All Articles In Data Base ',
            'data' => $articles
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

        $validator = validator(
            $request->all(),
            [

                'title' => 'required | string |min:3 ',
                'paragraph_1' => 'required | string |min:30 ',
                'paragraph_2' => 'string |min:30 ',
                'paragraph_3' => 'string |min:30 ',
                'category_id' => 'required',
                'author_id' => 'required',
                'image' => "required|image|max:2048|mimes:png,jpg,jpeg,pdf"
            ],
            [
                'image.required' => 'Upload Article Image.',
                'title.required' => 'Enter Article Title. ',
                'paragraph_1.required' => 'Enter Article Paragraph 1',
                'category_id.required' => 'Select Article Category. ',

            ]

        );

        if (!$validator->fails()) {
            $article = new Article();
            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/article', $imageName);

                $article->image = $imageName;
            }
            $article->title = $request->title;
            $article->paragraph_1 = $request->paragraph_1;
            $article->paragraph_2 = $request->paragraph_2;
            $article->paragraph_3 = $request->paragraph_3;
            $article->category_id = $request->category_id;
            $article->author_id = $request->author_id;

            $issaved = $article->save();

            if ($issaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Article Created successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to create Article ',
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrfail($id);

        if ($article) {
            return response()->json([
                'status' => true,
                'message' => 'Article information ',
                'RequestStatus' =>  400,
                'data' => $article

            ]);
        }
    }


    public function update(Request $request, $id)
    {
        $validator = validator(
            $request->all(),
            [

                'paragraph_1' => 'required | string |min:30 ',
                'paragraph_2' => 'string |min:30 ',
                'paragraph_3' => 'string |min:30 ',
                'title' => 'required | string |min:3 ',
                'category_id' => 'required',
            ],
            [
                'title.required' => 'Enter Article Title. ',
                'paragraph_1.required' => 'Enter Article Paragraph 1',
                'category_id.required' => 'Select Article Category. ',

            ]
        );

        if (!$validator->fails()) {
            $article = Article::findOrfail($id);
            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/article', $imageName);

                $article->image = $imageName;
            }
            $article->title = $request->title;
            $article->paragraph_1 = $request->paragraph_1;
            $article->paragraph_2 = $request->paragraph_2;
            $article->paragraph_3 = $request->paragraph_3;
            $article->category_id = $request->category_id;
            $article->author_id = $request->author_id;


            $isupdated = $article->save();


            if ($isupdated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated Article successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to Update',
                    'RequestStatus' => 400
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
        // $this->authorize('delete', City::class);
        $article = Article::findOrfail($id);
        $article->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}