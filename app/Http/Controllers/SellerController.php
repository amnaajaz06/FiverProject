<?php
 
namespace App\Http\Controllers;
use App\User;
use App\Seller;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Auth; 
Use DB;
class SellerController extends Controller
{
    public function index()
    {
        $sellers = auth()->user()->sellers;
 
        return response()->json([
            'success' => true,
            'data' => $sellers
        ]);
    }
 
    public function getseller($id)
    {
        $seller = auth()->user()->sellers()->find($id);
 
        if (!$seller) {
            return response()->json([
                'success' => false,
                'message' => 'Seller with id ' . $id . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $seller->toArray()
        ], 400);
    }
    
     public function show(Request $request)
    {
        $user = $request->user();
        $user_id = $user->id;
        $seller_find =DB::table('sellers')->where('user_id', '=', $user_id)->get();
        return response()->json(['sellers' => $seller_find], 200);
    }

    public function store(Request $request)
    {
         $user = $request->user();
        /*$this->validate($request, [
            //'profile_picture' => 'required|mimes:jpg,jpeg,png',
            'location' => 'required',
            'seller_description' => 'required|min:8',
            'street_address' => 'required',
            'unit_number' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required|integer',
            'birthdate' => 'required|date',
            'about_us' => 'required',
            'skill' =>'required',
            'description' =>'required',
            'rate' => 'required|integer',
            'level_of_experience' => 'required|integer',
            'category' =>'required',
            'seller_experiance' => 'required',
            'seller_description' => 'required',
            'seller_NIC' => 'required|integer',
            'skillname' =>'required|array'
        ]);*/
        /*if($file = $request->file('profile_picture'))
        {
           $name = $file->getClientOriginalName();
           $file->move('img/sellers',$name);
           $image = URL::asset('img/sellers/').'/'.$name;
        }*/
        $seller = $user->sellers()->create([
            'profile_picture' =>"abc.jpg",
            'location' => $request->seller[0]['location'],
            'seller_description' => $request->seller[0]['seller_description'],
            'street_address' => $request->seller[0]['street_address'],
            'unit_number' => $request->seller[0]['unit_number'],
            'city' => $request->seller[0]['city'],
            'state' => $request->seller[0]['state'],
            'zip_code' => $request->seller[0]['zip_code'],
            'birthdate' => $request->seller[0]['birthdate'],
            'about_us' => $request->seller[0]['about_us'],
        ]);
       $skills = $request->seller[0]['skill'];
            for($y=0; $y< count($skills); $y++)
            {
                $skill = $seller->skills()->create([
                'description' => $request->seller[0]['skill'][$y]['description'],
                'rate' => $request->seller[0]['skill'][$y]['rate'],
                'level_of_experience' => $request->seller[0]['skill'][$y]['level_of_experience'],
                'category' =>$request->seller[0]['skill'][$y]['category'],   
            ]);  
            }
        
        $seller->save(); 
        return response()->json(['seller' => $seller, 'skill' => $skills], 200);

       /* $skillname = $request->skill_name;
        for($x=0; $x< count($skillname); $x++)
        {
            $skill_name = $seller->skills()->create(['skill_name' => $skillname[$x] , ]);


        $skillname = $request->skillname;
        for($x=0; $x< count($skillname); $x++)
        {
        	$skill_name = $seller->skills()->create(['skill_name' => $skillname[$x] , ]);

        }
        $awardname = $request->award_name;
        for($x=0; $x< count($awardname); $x++)
        {
            $award_name= $seller->awards()->create(['award_name' => $awardname[$x] , ]);
        }*/
      /*  if (auth()->user()->sellers()->save($seller))
            return response()->json([
                'success' => true,
                'data' => $seller->toArray()]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Seller Record could not be added'
            ], 500);*/
    }
 
    public function update(Request $request, $id)
    {
        $seller = auth()->user()->sellers()->find($id);
 
        if (!$seller) {
            return response()->json([
                'success' => false,
                'message' => 'Seller with id ' . $id . ' not found'
            ], 400);
        }
 
        $updated = $seller->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Seller Record could not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $seller = auth()->user()->sellers()->find($id);
 
        if (!$seller) {
            return response()->json([
                'success' => false,
                'message' => 'Seller with id ' . $id . ' not found'
            ], 400);
        }
 
        if ($seller->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Seller Record could not be deleted'
            ], 500);
        }
    }
}