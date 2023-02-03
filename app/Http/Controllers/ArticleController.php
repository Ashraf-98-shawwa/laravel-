<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexArticle($id)
    {
        //
        $articles = Article::withCount('comments')->where('author_id', $id)->orderBy('created_at', 'desc')->paginate(5);
        return response()->view('cms.articles.indexarticle', compact('articles', 'id'));
    }

    public function createArticle($id)
    {
        $categories = Category::all();
        return response()->view('cms.articles.createarticle', compact('id', 'categories'));
    }

    public function index()
    {

        $this->authorize('viewAny', Article::class);

        if (auth('admin')->check()) {
            $articles = Article::withCount('comments')->orderBy('created_at', 'desc')->paginate(5);
        }

        if (auth('author')->check()) {
            $articles = Article::where('author_id',Auth::id())->withCount('comments')->orderBy('created_at', 'desc')->paginate(5);
        }

            return response()->view('cms.articles.index', compact('articles'));






    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Article::class);
        $authors = Author::all();
        $categories = Category::all();
        return response()->view('cms.articles.create', compact('categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        $validator = validator(
            $request->all(),
            [
                'title' => 'required | string |min:3 ',
                'paragraph_1' => 'required | string |min:30 ',
                'paragraph_2' => 'string |min:30 ',
                'paragraph_3' => 'string |min:30 ',
                'category_id' => 'required',
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

            return ['redirect' => route('articles.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'failed to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Article::class);
        $article = Article::findOrfail($id);
        return response()->view('cms.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Article::class);

        $article = Article::findOrfail($id);
        $authors = Author::all();
        $categories = Category::all();
        return response()->view('cms.articles.edit', compact('article', 'authors', 'categories'));
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
        $this->authorize('update', Article::class);

        $validator = validator(
            $request->all(),
            [
                'title' => 'required | string |min:3 ',
                'paragraph_1' => 'required | string |min:30 ',
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

            $issaved = $article->save();

            return ['redirect' => route('articles.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Updated successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'failed to update'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.articles.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Article::class);
        $article = Article::destroy($id);
    }
}