<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //config tên bảng
//    protected $table = "posts";

    // config khóa chính
//    protected $primaryKey = "tên khóa chính";

    //config tắt id tự động tăng
//    public $incrementing = false;

    // kiểu dữ liệu của khóa chính
//    protected $keyType = "Kiểu dữ liệu";

    // tắt 2 trường của timestamps
//    public $timestamps = false;

    // format định dạng của 2 trường timestamps
//    protected $dateFormat = "d-m-y";

    // config về kết nối
//    protected $connection = "connection-name";


    // khai báo những trường được phép gán giá trị
    protected $fillable = [
      'title',
      'content',
    ];
}

