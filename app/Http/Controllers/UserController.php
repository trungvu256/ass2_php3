<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $view;
    public function __construct(){
        $this->view = [];
    }
    public function register(){
        return view('user.register');
    }

    public function postRegister(Request $request){
        $objUser = new User();
        $request->merge(['password' => Hash::make($request->password)]);
        $res = $objUser->insertDataUser($request->all());
        if($res){
            return redirect()->back()->with('success','Thêm mới tài khoản thành công');
        }else{
            return redirect()->back()->with('error','Thêm mới tài khoản không thành công');
        }
    }

    public function login(){
        return view('user.login');
    }

    public function postLogin(Request $request){
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect()->route('products.index');
        }else{
            return redirect()->back()->with('error','Đăng nhập không thành công');
        }
    }

    public function sigOut(){
        Auth::logout();
        return redirect()->route('login');
    }
    public function index()
    {
        $objPro = new User();
        $this->view['listUser'] = $objPro->loadListUser();
        return view('user.index',$this->view);

    }
    public function destroy(string $id)
    {
        $User = User::find($id);

        if ($User) {

            // Nếu không còn sản phẩm liên kết, tiến hành xóa danh mục
            $User->delete();
            return redirect()->back()->with('success', 'Danh mục đã được xóa thành công.');
        } else {
            return redirect()->back()->with('error', 'Danh mục không tồn tại.');
        }
    }
    public function edit(string $id)
    {
        //
        $objCate = new Role();
        $this->view['listRole']=$objCate->loadAllRole();
        $objCate = new User();
        $this->view["idUser"] = $objCate->loadIdUser($id);
        return view("user.edit",$this->view);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( Request $request, int $id)
    {
        //
        $data = $request->all();
        $objCate = new User();
        $res = $objCate->updateDataUser($data, $id);
        if($res){
            return redirect()->back()->with("success","Sửa  thành công");
        }else{
            return redirect()->back()->with("error","Sửa thất bại");
        }
    }

}
