<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $fillable = [
      'id',
      'name',
      'status',
      'created_at',
      'updated_at',
    ];
    public $timestamps = false;

    public function loadAllCategory(){
//        $query = DB::table($this->table.' as cate')
//            ->select($this->fillable)
//            ->get();

        //QRM
        $query = Category::query()
        ->orderBy('id','desc')
        ->paginate(5);
        return $query;
    }
    public function insertDataCategory($request){
        $request['status'] = 1;
        $request['created_at'] = date('Y-m-d H:i:s');
        $res = Category::query()->create($request);
        return $res;
    }
    public function loadIdCategory($id){
        $res = Category::query()->find($id);
        return $res;
    }
    public function updateDataCategory($request,$id){
        $res = Category::query()->find($id)->update($request);
        return $res;
    }
    public function deleteDataCategory($id){
        $res = Category::query()->find($id)->delete();
        return $res;
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
