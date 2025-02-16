<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmcAddOns extends Model
{
    use HasFactory;
    protected $table = 'amc_add_ons';
    protected $fillable = [
        'amc_id','name','price'
    ];
    static public function get_single($id)
    {
        return self::find($id);
    }
    static public function get_add_ons($id)
    {
        $return = self::select('amc_add_ons.*')
            ->where('amc_id', '=', $id)
            ->orderBy('id', 'desc');
            $return = $return->paginate(10);
        return $return;
    }
}
