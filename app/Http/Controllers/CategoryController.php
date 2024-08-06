<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCategoriRequest;
use App\Http\Requests\UpdateCategoriRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    private $view;
    public function __construct(){
        $this->view = [];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $objCate = new Category();
        $this->view['listCate'] = $objCate->loadAllCategory();
        return view('category.index',$this->view);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('category.create',$this->view);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriRequest $request)
    {
// dd($request->all());
      $data = $request->all();
        //
        $objCate = new Category();

        $res = $objCate->insertDataCategory($data);
        if($res){
            return redirect()->back()->with('success',"Danh mục thêm thành công");
        }else{
            return redirect()->back()->with('error',"Danh mục không thêm thành công");
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
    public function edit(string $id)
    {
        //
        $objCate = new Category();
        $this->view["idCate"] = $objCate->loadIdCategory($id);
        return view("category.edit",$this->view);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( Request $request, int $id)
    {
        //
        $data = $request->all();
        $objCate = new Category();
        $res = $objCate->updateDataCategory($data, $id);
        if($res){
            return redirect()->back()->with("success","Sửa danh mục thành công");
        }else{
            return redirect()->back()->with("error","Sửa thất bại");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {

    // Tìm danh mục theo ID
    $category = Category::find($id);

    if ($category) {
        // Kiểm tra số lượng sản phẩm liên kết
        $productCount = $category->products()->count();

        if ($productCount > 0) {
            // Nếu còn sản phẩm liên kết, hiển thị thông báo lỗi
            return redirect()->back()->with('error', 'Danh mục này vẫn còn sản phẩm liên kết, không thể xóa.');
        }

        // Nếu không còn sản phẩm liên kết, tiến hành xóa danh mục
        $category->delete();
        return redirect()->back()->with('success', 'Danh mục đã được xóa thành công.');
    } else {
        return redirect()->back()->with('error', 'Danh mục không tồn tại.');
    }

        // $objCate = new Category();
        // $res = $objCate->deleteDataCategory($id);
        // if($res){
        //     return redirect()->back()->with("success","Xóa danh mục thành công");
        // }else{
        //     return redirect()->back()->with("error","Xóa thất bại");
        // }
    }
}
