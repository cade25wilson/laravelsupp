<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiscountsuppBrand;
use App\Models\DiscountsuppSupplement;

class brand extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page') ?? 1;
        $orderby = $request->input('orderby') ?? '-discount';
        $brand = $request->input('url');

        if($orderby == '-discount') {
            $orderby = 'discount';
            $order = 'desc';
        } elseif($orderby == 'discount_price') {
            $orderby ='discount_price';
            $order = 'desc';
        } else {
            $orderby = 'discount_price';
            $order = 'asc';
        }

        $limit = 12;
        $date = '2023-10-22';
        $offset = ($page - 1) * $limit;

        $brandid = DiscountsuppBrand::select('discountsupp_brand.id')
            ->where('discountsupp_brand.brand_url', 'LIKE', '%'.$brand.'%')
            ->first();
        
        $brandid = $brandid ?? 0;
        
        $supplements = DiscountsuppSupplement::select('discountsupp_supplement.name', 'discountsupp_supplement.original_price', 'discountsupp_supplement.discount_price', 
            'discountsupp_supplement.url', 'discountsupp_supplement.image', 'discountsupp_supplement.discount','discountsupp_brand.brand_name', 'discountsupp_brand.brand_url')            ->leftJoin('discountsupp_brand', 'discountsupp_brand.id', '=', 'discountsupp_supplement.brand_id')
            ->where('discountsupp_supplement.date', '=', $date)
            ->where('discountsupp_supplement.brand_id', '=', $brandid->id)
            ->orderBy('discountsupp_supplement.'.$orderby, $order)
            ->limit($limit)
            ->offset($offset)
            ->get();

        $totalItems = DiscountsuppSupplement::select('discountsupp_supplement.*')
            ->where('discountsupp_supplement.date', '=', $date)
            ->where('discountsupp_supplement.brand_id', '=', $brandid->id)
            ->count();

        $totalPages = ceil($totalItems / $limit);

        $data = [];
        foreach ($supplements as $supplement) {
            $data[] = [    
                'supplement' => [
                    'name' => $supplement->name,
                    'originalPrice' => $supplement->original_price,
                    'discountPrice' => $supplement->discount_price,
                    'url' => $supplement->url,
                    'image' => $supplement->image,
                    'discount' => $supplement->discount,
                ],
                'brand' => [
                    'brandName' => $supplement->brand_name,
                    'brandUrl' => $supplement->brand_url,
                ]
            ];
        }

        return response()->json([
            'totalItems' => $totalItems,
            'totalPages' => $totalPages,
            'items' => $data,
        ]);

    }
}
