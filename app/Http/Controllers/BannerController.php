<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $view;
    public function __construct()
    {
        $this->view = [];
    }
    public function index()
    {
        //
        $objPro = new Banner();
        $this->view['listBanner'] = $objPro->loadListBanner();
        return view('banner.index',$this->view);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('banner.create',$this->view);
    }
    private function uploadFile($file){
        $fileName = time().'_'.$file->getClientOriginalName();
        return $file->storeAs('image_banners',$fileName,'public');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data= $request->except('image_products');
        if($request->hasFile('image_products') && $request->file('image_products')->isValid()){
            $data['image_products'] = $this->uploadFile($request->file('image_products'));
        }
        $objPro = new Banner();
        $res = $objPro->insertDataBanner($data);
        if($res){
            return redirect()->back()->with('success',"Banner thêm thành công");
        }else{
            return redirect()->back()->with('error',"Banner không thêm thành công");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $image = Banner::findOrFail($id);
        return view('banner.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $objPro = new Banner();
        $this->view['idBanner']=$objPro->loadIdPBanner($id);
        return view('banner.edit',$this->view);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $objPro = new Banner();
        $idCheck = $objPro->loadIdPBanner($id);
        if($idCheck){
            $data=$request->except('image_products');
            if($request->hasFile('image_products') && $request->file('image_products')->isValid()){
                $data['image_products']=$this->uploadFile($request->file('image_products'));
                $imageOld= $idCheck->image;
            }else{
                $data['image_products'] = $idCheck->image;
            }
            $res = $objPro->updateDataBanner($data,$id);
            if($res){
                if ($request->hasFile('image_products') && Storage::disk('public')->exists($idCheck->image)){
                    Storage::disk('public')->delete($imageOld);
                }
                return redirect()->to('/banners')->with('success','Chỉnh sửa thành công');
            }else{
                return redirect()->back()->with('error','Chỉnh sửa không thành công');
            }
        }else{
            return redirect()->back()->with('error','Không tìm thấy id');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $objPro = new Banner();
        $idCheck = $objPro->loadIdPBanner($id);
        $imageOld = $idCheck->image;
        if($idCheck){
            $res = $objPro->deleteDataBanner($id);
            if($res){
                if(Storage::disk('public')->exists($imageOld)){
                    Storage::disk('public')->delete($imageOld);
                }
                return redirect()->back()->with('success','Xóa thông tin thành công');
            }else{
                return redirect()->back()->with('error','Xóa thông tin không thành công');
            }
        }else{
            return redirect()->back()->with('error','Không tìm thấy id');
        }
    }
}
