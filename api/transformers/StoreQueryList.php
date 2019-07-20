<?php


namespace api\transformers;


use common\models\SellerQuery;

class StoreQueryList
{
    public static function transform($list,$counter,$price_array)
    {
        $data = [];

        $loop = 0;

        foreach ($list as $item) {
            $data[$loop] = [
                'id' => $item->id,
                'seller_id' => $item->seller_id,
                'query_id' => $item->query_id,
                'product_id' => $item->product_id ? $item->product_id : null,
                'status' => $item->status,
                'query' => null,
                'product' => null,
                'request_prices' => null,
            ];

            $data[$loop]['query'][] = [
                'query_id' => $item->query->id,
                'user_id' => $item->query->user_id,
                'car_id' => $item->query->car_id,
                'title' => $item->query->title,
                'vendor' => $item->query->vendor,
                'car' => $item->query->car,
                'modification' => $item->query->modification,
                'year' => $item->query->year,
                'fueltype' => $item->query->fueltype,
                'engine' => $item->query->engine,
                'transmission' => $item->query->transmission,
                'drivetype' => $item->query->drivetype,
                'description' => $item->query->description,
                'name' => $item->query->name,
                'phone' => $item->query->phone,
                'email' => $item->query->email,
                'status' => $item->query->status,
            ];

            $get_prices = SellerQuery::find()->where(['query_id' => $item->query_id])->andWhere(['not', ['product_id' => null]])->all();
            $price_array = [];
            foreach ($get_prices as $get_price) {
                $price_array[] += $get_price->productPrice->price;
            }
            sort($price_array);
            $arrlength = count($price_array);
            if ($arrlength > 3) $counter = 3;
            else $counter = $arrlength;
            if ($counter > 0) {
                for ($x = 0; $x < $counter; $x++) {
                    $data[$loop]['request_prices'] = [
                        $counter => $price_array[$x],
                    ];
                }
            }


            if ($item->product_id !=0 ) {
                $data[$loop]['product'][] = [
                    'product_id' => $item->product->id,
                    'car_id' => $item->product->car_id,
                    'category' => $item->product->category->translate->title ? $item->product->category->translate->title : null,
                    'type_of_car' => $item->product->typeCar->translate->name ? $item->product->typeCar->translate->name : null,
                    'user' => $item->product->user->username ? $item->product->user->username : null,
                    'name' => $item->product->translate->name.', '.$item->product->car->vendor.' '.$item->product->car->car.' '.$item->product->car->modification.' '.$item->product->car->year,
                    'short' => $item->product->translate->short,
                    'description' => $item->product->translate->description,
                    'serial_number' => $item->product->serial_number ? $item->product->serial_number : null,
//                'price' => $item->product->price ? $item->product->price : null,
                    'price' => $item->product->purchase_price ? $item->product->purchase_price : null,
                    'purchase_price' => $item->product->purchase_price ? $item->product->purchase_price : null,
                    'discount_price' => $item->product->discount_price ? $item->product->discount_price : null,
                    'discount' => $item->product->discount ? $item->product->discount : null,
                    'data' => $item->product->data ? $item->product->data : null,
                    'is_special' => $item->product->is_special ? $item->product->is_special : null,
                    'length' => $item->product->length ? $item->product->length : null,
                    'width' => $item->product->width ? $item->product->width : null,
                    'height' => $item->product->height ? $item->product->height : null,
                    'weight' => $item->product->weight ? $item->product->weight : null,
                    'in_stock' => $item->product->in_stock ? $item->product->in_stock : null,
                    'quantity' => $item->product->quantity ? $item->product->quantity : null,
                    'average_price' => $item->product->average_price ? $item->product->average_price : null,
                    'recommended_price' => $item->product->recommended_price ? $item->product->recommended_price : null,
                    'view' => $item->product->view ? $item->product->view : null,
                    'date' => date('d/m/Y', $item->product->created_at),
//                    'product_images' => null,
                ];

                foreach ($item->product->storeProductImages as $productImage) {
                    $data[$loop]['product'][$loop]['product_images'][] = [
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