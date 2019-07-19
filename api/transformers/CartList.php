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
                'car_id' => $item->car_id,
                'category' => $item->category_id ? $item->category->translate->title : null,
                'product_id' => $item->product_id ? $item->product_id : null,
                'vendor' => $item->vendor,
                'car' => $item->car,
                'modification' => $item->modification,
                'year' => $item->year,
                'fueltype' => $item->fueltype,
                'engine' => $item->engine,
                'transmission' => $item->transmission,
                'drivetype' => $item->drivetype,
                'description' => $item->description,
                'name' => $item->name,
                'phone' => $item->phone,
                'email' => $item->email,
                'status' => $item->status,
                'created_at' => $item->created_at,
                'images' => null,
                'requests' => null,
            ];

            foreach ($item->queryImages as $queryImage) {
                $data[$loop]['images'][] = [
                    'id' => $queryImage->id,
                    'query_id' => $queryImage->query_id,
                    'link' => $queryImage->name,
                ];
            }

            foreach ($item->sellerProducts as $sellerQuery) {
                $data[$loop]['requests'][] = [
                    'id' => $sellerQuery->id,
                    'query_id' => $sellerQuery->query_id,
                    'seller_id' => $sellerQuery->seller_id,
                    'product_id' => $sellerQuery->product_id,
                    'status' => $sellerQuery->status,
                    'product_description' => $sellerQuery->product_id ? $sellerQuery->product->translate->description : null,
                    'product_price' => $sellerQuery->product_id ? ($sellerQuery->product->price * $commission) : null,
                    'product_images' => null,
                ];

                foreach ($sellerQuery->product->storeProductImages as $productImage) {
                    $data[$loop]['product_images'][] = [
                        'id' => $productImage->id,
                        'product_id' => $productImage->product_id,
                        'link' => $productImage->link,
                    ];


                }

            }

            $loop++;
        }
        return $data;
    }
}