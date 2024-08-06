<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $view;
    public function __construct()
    {
        $this->view = [];
    }

    /**
     * Display a listing of the resource.
     */
    public  function home(){
        return view('welcome.index',$this->view);
    }
    public function index()
    {
//        return view('product.index');
//        $objPro = new Product();
//        $this->view['listPro'] = $objPro->loadListProduct();
//        return view('product.index',$this->view);

        //truy vấn kết hợp logic
//        $objCate = new Category();
//        $category = $objCate->loadAllCategory();
//        $arrCate = [];
//        foreach ($category as $item){
//            $arrCate[$item->id] = $item->name;
//        }
//        $this->view['listCate']= $arrCate;
//        $objPro = new Product();
//        $this->view['listPro'] = $objPro->loadListProduct();
//        return view('product.index',$this->view);


        //ORM
        $objPro = new Product();
        $this->view['listPro'] = $objPro->loadListProduct();
        return view('product.index',$this->view);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        return view('product.create');
        // Hiển thị danh sách danh mục sản phẩm
        $objCate = new Category();
        $this->view['listCate']= $objCate->loadAllCategory();
        return view('product.create',$this->view);
    }

    /**
     * Store a newly created resource in storage.
     */
    private function uploadFile($file){
        $fileName = time().'_'.$file->getClientOriginalName();
        return $file->storeAs('image_products',$fileName,'public');
    }

    public function store(Request $request)
    {
//        $validateData= $request->validate(
//            [
//                'name'=>['required','string','max:255'],
//                'price'=>['required','integer','min:0'],
//                'quantity'=>['required','integer','min:1'],
//                'image_products'=>['required','image_products','mimes:jpeg,png,jpg,gif','max:2048'],
//                'category_id'=>['required','exists:categories,id'],
//                'describe'=>['required','string'],
//            ],
//            [
//                'name.required'=> 'Trường tên là bắt buộc',
//                'name.string'=>'Tên phải là chuỗi ký tự',
//                'name.max'=>'Tên không vượt quá 255 ký tự',
//                'price.required'=>'Giá là bắt buộc',
//                'price.integer'=>'Giá là số nguyên',
//                'price.min'=>'Giá nhỏ nhất là 0',
//                'quantity.required'=>'Số lượng là bắt buộc',
//                'quantity.integer'=>'Số lượng là số nguyên',
//                'quantity.min'=>'Số lượng nhỏ nhất là 1',
//                'image_products.required'=>'Tệp là bắt buộc',
//                'image_products.image_products'=>'Tệp bắt buộc là hình ảnh',
//                'image_products.mimes'=>'Hình ảnh là các tệp loại:jpeg,png,jpg,gif',
//                'image_products.max'=>'kích thước ảnh không vượt quá 2048 kylobytes',
//                'category_id.required'=>'Trường danh mục là bắt buộc',
//                'category_id.exists'=>'Danh mục đã chọn không hợp lệ',
//                'describe.required'=>'Mô tả là bắt buộc',
//                'describe.string'=>'Mô tả là chuỗi ký tự',
//            ]
//        );

        $data= $request->except('image');
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $data['image'] = $this->uploadFile($request->file('image'));
        }
        $objPro = new Product();
        $res = $objPro->insertDataProduct($data);
        if($res){
            return redirect()->back()->with('success',"Sản phẩm thêm thành công");
        }else{
            return redirect()->back()->with('error',"Sản phẩm không thêm thành công");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $objCate = new Category();
        $this->view['listCate']=$objCate->loadAllCategory();
        $objPro = new Product();
        $this->view['idPro']=$objPro->loadIdProduct($id);
        return view('product.edit',$this->view);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
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
                return redirect()->back()->with('success','Chỉnh sửa thành công');
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
        $objPro = new Product();
        $idCheck = $objPro->loadIdProduct($id);
        $imageOld = $idCheck->image;
        if($idCheck){
            $res = $objPro->deleteDataProduct($id);
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
