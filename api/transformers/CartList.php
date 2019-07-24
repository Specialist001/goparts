<?php


namespace api\transformers;


class CartList
{
    public static function transform($list, $commission)
    {
        $data = [];

        $loop = 0;

        foreach ($list as $item) {
            $data[$loop] = [
                'id' => $item->id,
                'user_id' => $item->user_id,
//                'car_id' => $item->car_id,
                'product_id' => $item->product_id ? $item->product_id : null,
//                'status' => $item->status,
                'count' => $item->count,
                'created_at' => $item->created_at,
                'product_name' => $item->product->translate->description.' for '.$item->product->car->vendor.' '.$item->product->car->car.' '.$item->product->car->modification.' '.$item->product->car->year,
                'product_price' => $item->product->price * $commission,
                'product_images' => null,
            ];

            foreach ($item->product->images as $productImage) {
                $data[$loop]['product_images'][] = [
                    'id' => $productImage->id,
                    'product_id' => $productImage->product_id,
                    'link' => $productImage->link,
                ];
            }


            $loop++;
        }
        return $data;
    }
}