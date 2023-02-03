<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Feature;
use App\Models\Project;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\Worker;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home()
    {
        $about = About::orderBy('id', 'desc')->first();
        $features = Feature::orderBy('id', 'desc')->get();
        $articles = Article::orderBy('id', 'desc')->paginate(3);
        $projects = Project::orderBy('id', 'desc')->get();
        $sliders = Slider::orderBy('id', 'desc')->get();
        $services = Service::orderBy('id', 'desc')->get();
        $workers = Worker::orderBy('id', 'desc')->get();
        $testimonials = Testimonial::orderBy('id', 'desc')->get();
        $categories = Category::all();

        return response()->view('website.index',compact('about', 'features', 'articles', 'projects', 'sliders', 'services', 'workers', 'testimonials', 'categories'));
    }

    public function about()
    {
        $about = About::orderBy('id', 'desc')->first();
        $features = Feature::orderBy('id', 'desc')->get();
        return response()->view('website.about', compact('about', 'features'));
    }

    public function blogs()
    {
        $categories = Category::all();
        $articles = Article::orderBy('id', 'desc')->paginate(6);
        return response()->view('website.blog', compact('articles', 'categories'));
    }

    public function categoryarticles($id)
    {
        $categories = Category::all();
        $blog = Category::findOrFail($id);
        $articles = Article::where('category_id', $id)->orderBy('id', 'desc')->paginate(6);
        return response()->view('website.categoryblog', compact('articles','blog' ,'categories'));
    }

    public function contact()
    {
        return response()->view('website.contact');
    }

    public function detail($id)
    {
        $comments = Comment::where('article_id',$id)->orderBy('id', 'asc')->get();
        $articles = Article::orderBy('id', 'desc')->paginate(6);
        $categories = Category::all();
        $article = Article::withCount('comments')->findOrFail($id);
        return view('website.detail', compact('article', 'categories','articles', 'comments'));
    }

    public function projects()
    {
        $projects = Project::orderBy('id', 'desc')->get();
        $categories = Category::all();
        return response()->view('website.project', compact('categories', 'projects'));
    }

    public function services()
    {
        $services = Service::orderBy('id', 'desc')->get();
        return response()->view('website.service', compact('services'));
    }

    public function team()
    {
        $workers = Worker::orderBy('id', 'desc')->get();
        return response()->view('website.team', compact('workers'));
    }

    public function testimonials()
    {
        $testimonials = Testimonial::orderBy('id', 'desc')->get();
        return response()->view('website.testimonial', compact('testimonials'));
    }
}