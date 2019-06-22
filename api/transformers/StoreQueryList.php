<?php


namespace api\transformers;


class StoreQueryList
{
    public static function transform($list)
    {
        $data = [];

        $loop = 0;

        foreach ($list as $item) {
            $data[$loop] = [
                'id' => $item->id,
                'seller_id' => $item->seller_id,
                'product_id' => $item->product_id ? $item->product_id : null,
                'status' => $item->status,
                'query' => null,
                'product' => null,
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

            foreach ($item->product as $product) {
                $data[$loop]['product'][] = [
                    'product_id' => $product->id,
                    'car_id' => $product->car_id,
                    'category' => $product->category->translate->title ? $product->category->translate->title : null,
                    'type_of_car' => $product->typeCar->translate->name ? $product->typeCar->translate->name : null,
                    'user' => $product->user->username ? $product->user->username : null,
                    'name' => $product->translate->name.', '.$product->car->vendor.' '.$product->car->car.' '.$product->car->modification.' '.$product->car->year,
                    'short' => $product->translate->short,
                    'description' => $product->translate->description,
                    'serial_number' => $product->serial_number ? $product->serial_number : null,
//                'price' => $product->price ? $product->price : null,
                    'price' => $product->purchase_price ? $product->purchase_price : null,
                    'purchase_price' => $product->purchase_price ? $product->purchase_price : null,
                    'discount_price' => $product->discount_price ? $product->discount_price : null,
                    'discount' => $product->discount ? $product->discount : null,
                    'data' => $product->data ? $product->data : null,
                    'is_special' => $product->is_special ? $product->is_special : null,
                    'length' => $product->length ? $product->length : null,
                    'width' => $product->width ? $product->width : null,
                    'height' => $product->height ? $product->height : null,
                    'weight' => $product->weight ? $product->weight : null,
                    'in_stock' => $product->in_stock ? $product->in_stock : null,
                    'quantity' => $product->quantity ? $product->quantity : null,
                    'image' => $product->image ? $product->image : null,
                    'average_price' => $product->average_price ? $product->average_price : null,

                    'recommended_price' => $product->recommended_price ? $product->recommended_price : null,
                    'view' => $product->view ? $product->view : null,
                    'date' => date('d/m/Y', $product->created_at),
                ];
            }

            $loop++;
        }
        return $data;
    }
}