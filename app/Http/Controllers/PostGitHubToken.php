<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\User;

class PostGitHubToken extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
            $rules = [
                'git_hub_token' => 'required',
            ];
            $validator = \Validator::make(request()->all(),$rules);
            if ($validator->fails()) {
                return response()->json($validator, 422);
            } else {
                try{
                    $user = User::find(auth()->user()->id);
                    $user->git_hub_token = Crypt::encrypt($request->git_hub_token);
                    $user->save();
                    return response()->json(substr( Crypt::decryptString($user->git_hub_token), -42,40 ));
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
                }
            }
    }
}
