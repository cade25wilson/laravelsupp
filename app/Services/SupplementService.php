<?php
namespace App\Services;

class SupplementService
{
    public function setUrlParam($request)
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
        $offset = ($page - 1) * $limit;

        return [
            'page' => $page,
            'limit' => $limit,
            'offset' => $offset,
            'date' => '2023-10-22',
            'orderby' => $orderby,
            'order' => $order
        ];
    }

    public function formatData($supplements)
    {
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

        return $data;
    }
}