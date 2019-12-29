<?php
 
namespace App\Http\Controllers;
use App\User;
use App\Seller;
use Illuminate\Http\Request;
 
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
 
    public function show($id)
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
 
    public function store(Request $request)
    {
    	$user = $request->user();
        $this->validate($request, [
            'seller_experiance' => 'required',
            'seller_description' => 'required',
            'seller_NIC' => 'required|integer',
            'skillname' =>'required|array'
        ]);
         $seller = $user->sellers()->create([
            'seller_experiance' => $request->seller_experiance,
            'seller_description' => $request->seller_description,
            'seller_NIC' => $request->seller_NIC,
        ]);

        $skillname = $request->skillname;
        for($x=0; $x< count($skillname); $x++)
        {
        	$skill_name = $seller->skills()->create(['skill_name' => $skillname[$x] , ]);
        }
        /*$award_name = $request->award_name;
        for($x=0; $x< count($award_name); $x++)
        {
        	$award_name= $seller->awards()->create(['award_name' => $award_name[$x] , ]);
        }*/
        if (auth()->user()->sellers()->save($seller))
            return response()->json([
                'success' => true,
                'data' => $seller->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Seller Record could not be added'
            ], 500);
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