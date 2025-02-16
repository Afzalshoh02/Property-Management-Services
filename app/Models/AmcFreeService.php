<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmcFreeService extends Model
{
    use HasFactory;
    protected $table = 'amc_free_services';
    protected $fillable = [
        'amc_id', 'name', 'limits', 'price'
    ];
    static public function get_free_service($id)
    {
        $return = self::select('amc_free_services.*')
            ->where('amc_id', '=', $id)
            ->orderBy('id', 'asc');
            $return = $return->paginate(10);
        return $return;
    }
}
