<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class PageHelper
{
    public static function paginate($param, $request)
    {
        $res = json_decode($param->body());
        $page = $res->meta->pagination;
        $current = $request->page ?? $page->current_page;
        // Setup Pagination
        $pagination = new Paginator($page->count, $page->total, $page->per_page, $current, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return [
            'datas' => $res->data,
            'page' => $pagination,
        ];
    }
}
