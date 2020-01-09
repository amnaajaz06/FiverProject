<?php
<<<<<<< HEAD
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
=======

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

>>>>>>> b51286efcae930f19f98de3b161ffb09700a0056
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
<<<<<<< HEAD
=======

>>>>>>> b51286efcae930f19f98de3b161ffb09700a0056
        $this->validate($request, [
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phoneno' => 'required|min:10',
            'password' => 'required|min:6',
        ]);
<<<<<<< HEAD
=======

>>>>>>> b51286efcae930f19f98de3b161ffb09700a0056
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phoneno' => $request->phoneno,
<<<<<<< HEAD
            'image' => "abc",
            'password' => bcrypt($request->password)
=======
    		'image' => "abc",
			'password' => bcrypt($request->password)
>>>>>>> b51286efcae930f19f98de3b161ffb09700a0056
        ]);
        $token = $user->createToken('TutsForWeb')->accessToken;
        return response()->json(['token' => $token], 200);
        /*$success['token'] =  $user->createToken('MyApp')->accessToken;
        return response()->json(['success'=>$success], $this->successStatus);*/
    }
<<<<<<< HEAD
=======

>>>>>>> b51286efcae930f19f98de3b161ffb09700a0056
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
<<<<<<< HEAD
=======

>>>>>>> b51286efcae930f19f98de3b161ffb09700a0056
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('TutsForWeb')->accessToken;
            return response()->json(['token' => $token], 200);
            /*$success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);*/
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
<<<<<<< HEAD
=======

>>>>>>> b51286efcae930f19f98de3b161ffb09700a0056
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
