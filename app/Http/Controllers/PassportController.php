<?php
 
namespace App\Http\Controllers;
 
use App\User;
use Illuminate\Http\Request;
 
class PassportController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phoneno' => 'required|min:10',
            'password' => 'required|min:6',
        ]);
 
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phoneno' => $request->phoneno,
    		'image' => $request->file('image'),
			'password' => bcrypt($request->password)
        ]);
 		if(!$request->hasFile('image')) {
        return response()->json(['upload_file_not_found'], 400);
    	}
    	$file = $request->file('image');
    	if(!$file->isValid()) {
        return response()->json(['invalid_file_upload'], 400);
    	}
    	$path = public_path() . '/uploads/';
    	$file->move($path, $file->getClientOriginalName());
    	return response()->json(compact('path'));
        return response()->json(['token' => $token], 200);
    }
 
    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('TutsForWeb')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
 
    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
}