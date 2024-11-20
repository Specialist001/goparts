<?php


namespace api\transformers;


class OrderList
{
    public static function transform($list)
    {
        $data = [];

        $loop = 0;

        foreach ($list as $item) {
            $data[$loop] = [
                'id' => $item->id,
                'user_id' => $item->user_id,
                'status' => 'NEW',
                'paid' => 'NOT PAID',
                'total_price' => $item->total_price,
                'name' => $item->name,
                'e-mail' => $item->email,
                'phone' => $item->phone,
                'city' => $item->city,
                'created_time' => $item->created_at,
                'products' => null,
            ];

            foreach ($item->storeOrderProducts as $product) {
                $data[$loop]['products'][] = [
                    'id' => $product->id,
                    'order_id' => $product->order_id,
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'price' => $product->price,
                ];
            }


            $loop++;
        }
        return $data;
    }
}