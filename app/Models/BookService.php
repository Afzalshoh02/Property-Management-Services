<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Laravel\Prompts\select;

class BookService extends Model
{
    use HasFactory;
    protected $table = 'book_services';
    static public function getBookService($b_id, $request)
    {
        $return = self::select('book_services.*')
            ->where('book_services.user_id', '=', $b_id)
            ->orderBy('book_services.id', 'desc');
            $return = $return->paginate(10);
        return $return;
    }
    public function get_service_type_name()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }
    public function get_category_name()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function get_sub_category_name()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
    public function get_amc_free_service()
    {
        return $this->belongsTo(AmcFreeService::class, 'amc_free_service_id');
    }
}
