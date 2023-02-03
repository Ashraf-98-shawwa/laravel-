<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        // $this->authorize('viewAny', Subscriper::class);

        $subscripers = Subscriper::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => 'All subscripers In Data Base ',
            'data' => $subscripers
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

                    return response()->json([
                        'status' => true,
                        'message' => 'Subscriped successfully',
                        'RequestStatus' => 200
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'failed to Subscripe ',
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
        $this->authorize('delete', Subscriper::class);
        $subscriper = Subscriper::findOrFail($id);
        $delete = $subscriper->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}
