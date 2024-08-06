<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = "roles";
    protected $fillable = [
      'id',
      'name',
      'status',
      'created_at',
      'updated_at',
    ];
    public function loadAllRole(){
        //        $query = DB::table($this->table.' as cate')
        //            ->select($this->fillable)
        //            ->get();
        
                //QRM
                $query = Role::query()
                ->orderBy('id','desc')
                ->paginate(5);
                return $query;
            }
            public function loadIdRole($id){
                $res = Role::query()->find($id);
                return $res;
            }
}
