<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        'id',
        'name',
        'price',
        'quantity',
        'image',
        'category_id',
        'describe',
        'status',
        'created_at',
        'updated_at',
    ];
    public $timestamps = false;

    public function loadAllCate(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function loadListProduct(){
        // truy vấn lồng
//        $this->fillable[] = 'cate.name as catename';
//        $query = DB::table($this->table.' as pr')
//            ->select($this->fillable)
//            ->join('categories as cate', 'pr.category_id','=','cate.id')
////            ->get();
//            ->orderBy('id')
//            ->paginate(7);
//        return $query;

        // truy vấn kết hợp logic
//        $query = DB::table($this->table.' as pr')
//            ->select($this->fillable)
//            ->orderBy('id')
//            ->paginate('5');
//        return $query;

        //QRM
        $query = Product::query()
            ->with('loadAllCate')
            ->orderBy('id')
            ->paginate(5);
        return $query;
    }

    public function insertDataProduct($params){
        $params['status'] = 1;
        $params['created_at'] = date('Y-m-d H:i:s');
        $res = Product::query()->create($params);
        return $res;
    }

    public function loadIdProduct($id){
        $query = Product::query()
            ->with('loadAllCate')
            ->find($id);
        return $query;
    }

    public function updateDataProduct($params,$id){
        $res = Product::query()->find($id)
            ->update($params);
        return $res;
    }

    public function deleteDataProduct($id){
        $res = Product::query()->find($id)->delete();
        return $res;
    }

}
