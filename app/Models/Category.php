<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Termwind\renderUsing;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name', 'is_delete'
    ];
    static public function get_record($request)
    {
        $return = self::select('categories.*')
            ->orderBy('categories.id', 'desc')
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
