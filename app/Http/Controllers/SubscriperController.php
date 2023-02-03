<?php

namespace App\Http\Controllers;

use App\Models\Subscriper;
use Illuminate\Http\Request;

class SubscriperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Subscriper::class);
        $subscripers = Subscriper::orderBy('id', 'desc')->paginate(7);
        return response()->view('cms.subscripers.index', compact('subscripers'));
    }


    public function store(Request $request)
    {
        $validator = validator(
            $request->all(),
            [

                'email' => 'required | email',

            ],
            [
                'email.required' => 'Enter Your Email',
            ]

        );

        if (!$validator->fails()) {
            $subscriper = new Subscriper();

            $subscriper->email = $request->email;


            $issaved = $subscriper->save();


            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Subscriped successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'failed to Subscripe'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.subscripers.index');
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
        $this->authorize('delete', Subscriper::class);
        $subscriper = Subscriper::findOrFail($id);
        $delete = $subscriper->delete();
    }
}
