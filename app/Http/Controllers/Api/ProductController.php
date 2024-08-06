<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $objPro = new Product();
        $data = $objPro->loadListProduct();
        return response()->json($data);
    }

    private function uploadFile($file){
        $fileName = time().'_'.$file->getClientOriginalName();
        return $file->storeAs('image_products',$fileName,'public');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->except('image_products');
        if($request->hasFile('image_products') && $request->file('image_products')->isValid()){
            $data['image_products'] = $this->uploadFile($request->file('image_products'));
        }
        $objPro = new Product();
        $res = $objPro->insertDataProduct($data);
        if($res){
            return response()->json(['success'=>true, 'data'=>$data]);
        }else{
            return response()->json(['error'=>false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $objPro = new Product();
        $data = $objPro->loadIdProduct($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $objPro = new Product();
        $idCheck = $objPro->loadIdProduct($id);
        if($idCheck){
            $data=$request->except('image_products');
            if($request->hasFile('image_products') && $request->file('image_products')->isValid()){
                $data['image_products']=$this->uploadFile($request->file('image_products'));
                $imageOld= $idCheck->image;
            }else{
                $data['image_products'] = $idCheck->image;
            }
            $res = $objPro->updateDataProduct($data,$id);
            if($res){
                if ($request->hasFile('image_products') && Storage::disk('public')->exists($idCheck->image)){
                    Storage::disk('public')->delete($imageOld);
                }
                return response()->json($data);
            }else{
                return response()->json(['error'=>false, 'data'=>[]]);
            }
        }else{
            return response()->json([],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $objPro = new Product();
        $idCheck = $objPro->loadIdProduct($id);
        if($idCheck){
            $res = $objPro->deleteDataProduct($id);
            if($res){
                return response()->json('success',204);
            }else{
                return response()->json('error',406);
            }
        }else{
            return response()->json('error',404);
        }
    }
}
