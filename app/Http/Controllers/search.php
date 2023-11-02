<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiscountsuppSupplement;
use App\Services\SupplementService;

class search extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $supplementService = new SupplementService();
        $search = $request->input('search');
        $urlparam = $supplementService->setUrlParam($request);

        $supplements = DiscountsuppSupplement::select('discountsupp_supplement.name', 'discountsupp_supplement.original_price', 'discountsupp_supplement.discount_price', 
            'discountsupp_supplement.url', 'discountsupp_supplement.image', 'discountsupp_supplement.discount','discountsupp_brand.brand_name', 'discountsupp_brand.brand_url')            ->leftJoin('discountsupp_brand', 'discountsupp_brand.id', '=', 'discountsupp_supplement.brand_id')
            ->where('discountsupp_supplement.date', '=', $urlparam['date'])
            ->where('discountsupp_supplement.name', 'like', '%'.$search.'%')
            ->orderBy('discountsupp_supplement.'.$urlparam['orderby'], $urlparam['order'])
            ->limit($urlparam['limit'])
            ->offset($urlparam['offset'])
            ->get();

        $totalItems = DiscountsuppSupplement::select('discountsupp_supplement.*')
            ->where('discountsupp_supplement.date', '=', $urlparam['date'])
            ->where('discountsupp_supplement.name', 'like', '%'.$search.'%')
            ->count();

        $totalPages = ceil($totalItems / $urlparam['limit']);

        $data = $supplementService->formatData($supplements);

        return response()->json([
            'totalItems' => $totalItems,
            'totalPages' => $totalPages,
            'items' => $data
        ]);
    }
}
