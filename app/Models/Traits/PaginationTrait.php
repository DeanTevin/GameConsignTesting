<?php

namespace App\Models\Traits;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
trait PaginationTrait {
    
    public function paginate($items, $perPage = 5, $page = null,$total_items = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = $total_items ?: ($total_items ?: count($items));
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage ;
        $itemstoshow = array_slice($items , $offset , $perPage);
        return new LengthAwarePaginator($itemstoshow ,$total,$perPage);
    }
}