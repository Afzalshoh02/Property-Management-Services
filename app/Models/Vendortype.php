<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendortype extends Model
{
    use HasFactory;
    protected $table = 'vendortypes';
    protected $fillable = [
      'name', 'is_delete'
    ];
    static public function get_record($request)
    {
        $return = self::select('vendortypes.*')
            ->orderBy('vendortypes.id','desc')
            ->where('vendortypes.is_delete','=', 0);
        $return = $return->paginate(10);
        return $return;
    }
    static public function get_single($id)
    {
        return self::find($id);
    }
}
