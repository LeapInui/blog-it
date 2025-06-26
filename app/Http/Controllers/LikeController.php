<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Notifications\LikeNotification;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'likeable_id' => 'required|integer',
            'likeable_type' => 'required|string',
        ]);

        $like = Like::firstOrCreate([
            'user_id' => auth()->id(),
            'likeable_id' => $request->likeable_id,
            'likeable_type' => $request->likeable_type,
        ]);

        $likeableModel = $request->likeable_type::find($request->likeable_id);

        if ($likeableModel->user_id !== auth()->id()) {
            $likeableModel->user->notify(new LikeNotification($likeableModel));
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'likeable_id' => 'required|integer',
            'likeable_type' => 'required|string',
        ]);

        Like::where([
            'user_id' => auth()->id(),
            'likeable_id' => $request->likeable_id,
            'likeable_type' => $request->likeable_type,
        ])->delete();

        return redirect()->back();
    }
}