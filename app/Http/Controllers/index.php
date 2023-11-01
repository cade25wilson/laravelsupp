<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiscountsuppSupplement;

class index extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page') ?? 1;
        $orderby = $request->input('orderby') ?? '-discount';

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
        $supplements = DiscountsuppSupplement::select('discountsupp_supplement.*', 'discountsupp_brand.brand_name', 'discountsupp_brand.brand_url', 'discountsupp_brand.id as brand_id')
            ->leftJoin('discountsupp_brand', 'discountsupp_brand.id', '=', 'discountsupp_supplement.brand_id')
            ->where('discountsupp_supplement.date', '=', $date)
            ->orderBy('discountsupp_supplement.'.$orderby, $order)
            ->limit($limit)
            ->offset($offset)
            ->get();

        $totalItems = DiscountsuppSupplement::select('discountsupp_supplement.*')
            ->where('discountsupp_supplement.date', '=', $date)
            ->count();

        $totalPages = ceil($totalItems / $limit);
        $data = [];
        foreach ($supplements as $supplement) {
            $data[] = [    
                'supplement' => [
                    'id' => $supplement->id,
                    'name' => $supplement->name,
                    'originalPrice' => $supplement->original_price,
                    'discountPrice' => $supplement->discount_price,
                    'url' => $supplement->url,
                    'brandId' => $supplement->brand_id,
                    'image' => $supplement->image,
                    'categoryId' => $supplement->category_id,
                    'date' => $supplement->date,
                    'discount' => $supplement->discount,
                    'active' => $supplement->active,
                    'advertiserId' => $supplement->advertiser_id,
                    'supplementlinkId' => $supplement->supplementlink_id,
                    'advertiser' => $supplement->advertiser_id,
                    'category' => $supplement->category_id,
                    'supplementlink' => $supplement->supplementlink_id,
                ],
                'brand' => [
                    'id' => $supplement->brand_id,
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
