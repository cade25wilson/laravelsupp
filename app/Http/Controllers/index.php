<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\Models\DiscountsuppSupplement;
use App\Services\SupplementService;

class index extends Controller
{
    public function index(Request $request)
    {
        $supplementService = new SupplementService();
    
        $urlparam = $supplementService->setUrlParam($request);
    
        $cacheKey = 'index-' . $urlparam['orderby'] . '-' . $urlparam['page'];
    
        // Try to get the result from the cache
        $result = Cache::get($cacheKey);
    
        // If the result is not in the cache, calculate it and put it in the cache
        if ($result === null) {
            $supplements = DiscountsuppSupplement::select('discountsupp_supplement.name', 'discountsupp_supplement.original_price', 'discountsupp_supplement.discount_price', 
                'discountsupp_supplement.url', 'discountsupp_supplement.image', 'discountsupp_supplement.discount','discountsupp_brand.brand_name', 'discountsupp_brand.brand_url')
                ->leftJoin('discountsupp_brand', 'discountsupp_brand.id', '=', 'discountsupp_supplement.brand_id')
                ->where('discountsupp_supplement.date', '=', $urlparam['date'])
                ->orderBy('discountsupp_supplement.' . $urlparam['orderby'], $urlparam['order'])
                ->limit($urlparam['limit'])
                ->offset($urlparam['offset'])
                ->get();
    
            $totalItems = DiscountsuppSupplement::select('discountsupp_supplement.*')
                ->where('discountsupp_supplement.date', '=', $urlparam['date'])
                ->count();
    
            $totalPages = ceil($totalItems / $urlparam['limit']);
    
            $data = $supplementService->formatData($supplements);
    
            $result = [
                'totalItems' => $totalItems,
                'totalPages' => $totalPages,
                'items' => $data,
            ];
    
            // Store the result in the cache for 60 minutes
            Cache::put($cacheKey, $result, 60);
        }
    
        return response()->json($result);
    }
}
