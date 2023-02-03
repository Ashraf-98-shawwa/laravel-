<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Author;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Author::class);

        if (auth('admin')->check()) {
        $authors = Author::withCount('articles')->with('user')->orderBy('id', 'desc')->paginate(10);
        }

        if (auth('author')->check()) {
            $author= Author::withCount('articles')->with('user')->findOrFail(Auth::id());
        }

        if (auth('admin')->check()) {
        return response()->view('cms.authors.index', compact('authors'));
        }

        if (auth('author')->check()) {
        return response()->view('cms.authors.index', compact('author'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Author::class);
        $cities = City::all();
        $roles = Role::where('guard_name', 'author')->get();
        return response()->view('cms.authors.create', compact('cities','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Author::class);

        $validator = validator(
            $request->all(),
            [
                'email' => "required",
                'password' => "required",
                'first_name' => "required|string",
                'last_name' => "required|string | min:3 | max:10",
                'mobile' => "required|numeric|digits:10",
                'date' => "required|date",
                'address' => "required",
                'city_id' => "required",
                'gender' => "required",
                'image' => "required|image|max:2048|mimes:png,jpg,jpeg,pdf"
            ],
            [
                'image.required' => 'Upload an image.',
                'email.required' => 'Enter email address. ',
                'first_name.required' => 'Enter Author first name . ',
                'last_name.required' => 'Enter Author last name . ',
                'mobile.required' => 'Enter Author mobile number. ',
                'date.required' => 'Enter Author date of birth. ',
                'address.required' => 'Enter Author address. ',
                'password.required' => 'Enter Author password. ',
                'gender.required' => 'Select Author Gender ',
                'city_id.required' => 'Select Author City. '
            ]
        );

        if (!$validator->fails()) {
            $author = new Author();
            $author->email = $request->email;
            $author->password = Hash::make($request->get('password'));
            $issaved = $author->save();


            // to set the role of the author
            $roles = Role::findOrFail($request->get('role_id'));
            $author->assignRole($roles->name);

            $user = new User();
            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/author', $imageName);

                $user->image = $imageName;
            }

            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->date = $request->date;
            $user->mobile = $request->mobile;
            $user->last_name = $request->last_name;
            $user->first_name = $request->first_name;
            $user->city_id = $request->city_id;
            $user->user()->associate($author); // to associate the new admin with the apropriate user.
            $isSaved = $user->save();

            return ['redirect' => route('authors.index')];

            if ($isSaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'fails to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
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
        $this->authorize('view', Author::class);

        $author = Author::findOrFail($id);
        return response()->view('cms.authors.show', compact('author'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Author::class);
        $roles = Role::where('guard_name', 'author')->get();

        $cities = City::all();
        $author = Author::findOrFail($id);

        return response()->view('cms.authors.edit', compact('roles','cities', 'author'));
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
        $this->authorize('update', Author::class);

        $validator = validator(
            $request->all(),
            [
                'email' => "required",
                'password' => "required",
                'first_name' => "required|string",
                'last_name' => "required|string | min:3 | max:10",
                'mobile' => "required|numeric|digits:10",
                'date' => "required|date",
                'address' => "required",
                'city_id' => "required",
                'gender' => "required",
            ],
            [
                'email.required' => 'Enter email address. ',
                'first_name.required' => 'Enter Author first name . ',
                'last_name.required' => 'Enter Author last name . ',
                'mobile.required' => 'Enter Author mobile number. ',
                'date.required' => 'Enter Author date of birth. ',
                'address.required' => 'Enter Author address. ',
                'password.required' => 'Enter Author password. ',
                'gender.required' => 'Select Author Gender ',
                'city_id.required' => 'Select Author City. '
            ]
        );

        if (!$validator->fails()) {
            $author = Author::findOrFail($id);
            $author->email = $request->email;
            $author->password = Hash::make($request->get('password'));
            $issaved = $author->save();

            // to set the role of the author
            $roles = Role::findOrFail($request->get('role_id'));
            $author->assignRole($roles->name);

            $user = $author->user;
            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/author', $imageName);

                $user->image = $imageName;
            }

            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->date = $request->date;
            $user->mobile = $request->mobile;
            $user->last_name = $request->last_name;
            $user->first_name = $request->first_name;
            $user->city_id = $request->city_id;
            $isSaved = $user->save();

            return ['redirect' => route('authors.index')];

            if ($isSaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'fails to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $this->authorize('delete', Author::class);

        if (auth('author')) {
            if ($author->id == Auth::id()) {
                return redirect()->route('admins.index');
            } else {
                $author->delete();
                return response()->json(['icon' => 'success', 'title' => 'Author Deleted'], 200);
            }
        } else {
            $author->delete();
            return response()->json(['icon' => 'success', 'title' => 'Author Deleted'], 200);
        }
    }
    }
