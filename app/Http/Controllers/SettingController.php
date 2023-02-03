<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Setting::class);

        $count = Setting::count();
        $settings = Setting::orderby('id', 'desc')->paginate(5);
        return response()->view('cms\settings\index', compact('settings', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Setting::class);

        return view('cms.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Setting::class);

        $validator = validator(
            $request->all(),
            [
                'address' => 'required | string |min:3',
                'mobile' => "required|numeric|digits:10",
                'email' => "required",
                'twitter_link' => "required",
                'facebook_link' => "required",
                'instagram_link' => "required",
                'linkedin_link' => "required",

            ],
            [
                'address.required' => 'Enter company address. ',
                'mobile.required' => 'Enter company mobile. ',
                'email.required' => 'Enter company email. ',
                'twitter_link.required' =>'Enter company link on twitter. ',
                'facebook_link.required' =>'Enter company link on facebook. ',
                'instagram_link.required' => 'Enter company link on instagram. ',
                'linkedin_link.required' => 'Enter company link on linkedin. '

            ]

        );

        if (!$validator->fails()) {
            $setting = new Setting();
            $setting->address = $request->address;
            $setting->mobile = $request->mobile;
            $setting->email = $request->email;
            $setting->twitter_link = $request->twitter_link;
            $setting->facebook_link = $request->facebook_link;
            $setting->linkedin_link = $request->linkedin_link;
            $setting->instagram_link = $request->instagram_link;

            $issaved = $setting->save();
            return ['redirect' => route('settings.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'faild to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.settings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Setting::class);

        $setting = Setting::findOrfail($id);
        return response()->view('cms\settings\show', compact('setting'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Setting::class);

        $setting = Setting::findOrfail($id);
        return response()->view('cms\settings\edit', compact('setting'));
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
        $this->authorize('update', Setting::class);

        $validator = validator(
            $request->all(),
            [
                'address' => 'required | string |min:3',
                'mobile' => "required|numeric|digits:10",
                'email' => "required",
                'twitter_link' => "required",
                'facebook_link' => "required",
                'instagram_link' => "required",
                'linkedin_link' => "required",

            ],
            [
                'address.required' => 'Enter company address. ',
                'mobile.required' => 'Enter company mobile. ',
                'email.required' => 'Enter company email. ',
                'twitter_link.required' => 'Enter company link on twitter. ',
                'facebook_link.required' => 'Enter company link on facebook. ',
                'instagram_link.required' => 'Enter company link on instagram. ',
                'linkedin_link.required' => 'Enter company link on linkedin. '

            ]

        );

        if (!$validator->fails()) {
            $setting = Setting::findOrfail($id);
            $setting->address = $request->address;
            $setting->mobile = $request->mobile;
            $setting->email = $request->email;
            $setting->twitter_link = $request->twitter_link;
            $setting->facebook_link = $request->facebook_link;
            $setting->linkedin_link = $request->linkedin_link;
            $setting->instagram_link = $request->instagram_link;

            $issaved = $setting->save();
            return ['redirect' => route('settings.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Updated successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'faild to update'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.settings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Setting::class);

        $setting = Setting::findOrfail($id);
        $setting->delete();
        return response()->json(['icon' => 'success', 'title' => 'Deleted Successfully'], 200);
    }
}
