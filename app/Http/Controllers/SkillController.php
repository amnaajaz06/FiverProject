<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Skill; 
Use DB;
use Illuminate\Support\Facades\URL;
class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $seller = $user->seller;
        $seller_id = $seller->id;
        $this->validate($request, [
            'description' =>'required',
            'rate' => 'required|integer',
            'level_of_experience' => 'required|integer',
            'category' =>'required',
            'images' => 'required|array'
        ]);  
        $skill = Skill::create([
            'description' => $request->description,
            'rate' => $request->rate,
            'level_of_experience' => $request->level_of_experience,
            'category' => $request->category,
            'seller_id' =>$seller_id
        ]);
         $file = $request->file('images');
        for($x=0; $x< count($file); $x++)
        {
            $name = $file[$x]->getClientOriginalName();
            $file[$x]->move('img/skills',$name);
            $images = URL::asset('img/dishes/').'/'.$name;
            $images = $skill->skillimages()->create(['images' => $images , ]);
        }
        $skill->save();
        return response()->json(['message' => "Skills added Successfully"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = $request->user();
        $seller = $user->seller;
        $seller_id = $seller->id;
        $skill_find =DB::table('skills')->where('seller_id', '=', $seller_id)->get();
         for($x=0; $x< count($skill_find); $x++)
        {
            $skill_id = $skill_find[$x]->id;
            $skillimage= DB::table('skill_images')->select(array('id', 'images'))->where('skill_id',$skill_id)->get();
            $skill_find[$x]->images= $skillimage;
        }
        return response()->json([ 'skills' => $skill_find], 200);
    }

     public function getskill(Request $request, $id)
    {
        $user = Auth::user();
        $seller = $user->seller;
        $seller_id = $seller->id;
        $skill= DB::table('skills')->where('id',$id)->get();
        $skill_seller_id = $skill[0]->seller_id;
        if($seller_id == $skill_seller_id)
        {
            $image= DB::table('skill_images')->select(array('id','images'))->where('skill_id',$id)->get();
            return response()->json([ 
                                      'skill' => $skill
                                    ], 200);
        }
        else 
        {
            return response()->json([
                'message' => 'Record could not Found'
            ], 500);
        }
          
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
