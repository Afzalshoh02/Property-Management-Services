<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;
    protected $table = 'service_types';
    protected $fillable = [
      'name','is_delete'
    ];
    static public function get_record($request)
    {
        $return = self::select('service_types.*')
            ->orderBy('service_types.id','desc')
            ->where('is_delete', '=', 0);
            $return = $return->paginate(10);
        return $return;
    }
    static public function get_single($id)
    {
        return self::find($id);
    }
    static public function get_record_delete()
    {
        return self::where('is_delete', 0)->get();
    }
}
