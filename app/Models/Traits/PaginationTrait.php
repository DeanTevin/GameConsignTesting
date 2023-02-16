<?php

namespace App\Models\Traits;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
trait PaginationTrait {
    
    public function paginate($items, $perPage = 5, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage ;
        $itemstoshow = array_slice($items , $offset , $perPage);
        $paginator = new LengthAwarePaginator($itemstoshow ,$total,$perPage);
        return ['results' => $paginator->items(), 'current_page'=>$paginator->currentPage(),'total'=>$paginator->total(),'perPage'=>$paginator->perPage()];
    }
}