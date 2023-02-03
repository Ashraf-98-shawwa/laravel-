<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        $Setting = Setting::orderby('id', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => 'All Setting In Data Base ',
            'data' => $Setting
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
        $count = Setting::count();

        if ($count<1) {
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
                $setting = new Setting();
                $setting->address = $request->address;
                $setting->mobile = $request->mobile;
                $setting->email = $request->email;
                $setting->twitter_link = $request->twitter_link;
                $setting->facebook_link = $request->facebook_link;
                $setting->linkedin_link = $request->linkedin_link;
                $setting->instagram_link = $request->instagram_link;

                $issaved = $setting->save();
                if ($issaved) {

                    return response()->json([
                        'status' => true,
                        'message' => 'Setting Created successfully',
                        'RequestStatus' => 200
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Faild to create Setting ',
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
        else {
            return response()->json([
                'status' => false,
                'message' => 'Website settings already created / Edit it.',
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
        $setting = Setting::findOrfail($id);

        if ($setting) {
            return response()->json([
                'status' => true,
                'message' => 'Setting information ',
                'RequestStatus' =>  400,
                'data' => $setting

            ]);
        }
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

            $isupdated = $setting->save();



            if ($isupdated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated setting successfully',
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
        $setting = Setting::findOrfail($id);
        $setting->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}