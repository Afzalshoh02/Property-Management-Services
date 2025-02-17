<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    protected $fillable = [
        'category_id','name','is_delete',
    ];
    static public function get_record($request)
    {
        $return = self::select('sub_categories.*', 'categories.name as category_name')
            ->join('categories','sub_categories.category_id','=','categories.id')
            ->orderBy('sub_categories.id','desc')
            ->where('sub_categories.is_delete','=', 0);
            $return = $return->paginate(10);
        return $return;
    }
    static public function get_single($id)
    {
        return self::find($id);
    }
}
