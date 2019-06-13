<?php
namespace api\transformers;


class StoreProductList
{
    public static function transform($list)
    {
        $data = [];

        $loop = 0;

        foreach ($list as $item) {
            $data[$loop] = [
                'id' => $item->id,
                'sku' => $item->sku,
                'car_id' => $item->car->id,
                'car_vendor' => $item->car->vendor,
                'car_modification' => $item->car->modification,
                'type_id' => $item->type_id ? $item->type_id : null,
                'producer_id' => $item->producer_id ? $item->producer_id : null,
                'category' => $item->category->translate->title ? $item->category->translate->title : null,
                'type_car' => $item->typeCar->translate->name ? $item->typeCar->translate->name : null,
                'user' => $item->user->username ? $item->user->username : null,
                'name' => $item->translate->name.', '.$item->car->vendor.' '.$item->car->car.' '.$item->car->modification.' '.$item->car->year,
                'short' => $item->translate->short,
                'description' => $item->translate->description,
                'serial_number' => $item->serial_number ? $item->serial_number : null,
//                'price' => $item->price ? $item->price : null,
                'price' => $item->purchase_price ? $item->purchase_price : null,
                'purchase_price' => $item->purchase_price ? $item->purchase_price : null,
                'discount_price' => $item->discount_price ? $item->discount_price : null,
                'discount' => $item->discount ? $item->discount : null,
                'data' => $item->data ? $item->data : null,
                'is_special' => $item->is_special ? $item->is_special : null,
                'length' => $item->length ? $item->length : null,
                'width' => $item->width ? $item->width : null,
                'height' => $item->height ? $item->height : null,
                'weight' => $item->weight ? $item->weight : null,
                'in_stock' => $item->in_stock ? $item->in_stock : null,
                'quantity' => $item->quantity ? $item->quantity : null,
                'image' => $item->image ? $item->image : null,
                'average_price' => $item->average_price ? $item->average_price : null,

                'recommended_price' => $item->recommended_price ? $item->recommended_price : null,
                'view' => $item->view ? $item->view : null,

            ];

//            foreach ($item->storeAttributeOptions as $option) {
//                $data[$loop]['values'][] = [
//                    'id' => $option->id,
//                    'attribute_id' => $option->attribute_id,
//                    'order' => $option->order ? $option->order : null,
//                    'title' => $option->translate->value,
//                ];
//            }

//            foreach ($item->activeCategories as $activeCategory) {
//                $data[$loop]['subCats'][] = [
//                    'id' => $activeCategory->id,
//                    'title' => $activeCategory->translate->name,
//                    'type' => $activeCategory->type,
//                    'view' => $activeCategory->view,
//                    'external_id' => $activeCategory->external_id ? $activeCategory->external_id : null,
//                    'hasChild' => ($activeCategory->activeCategories)? true: false,
//                ];
//            }

            $loop++;
        }
        return $data;
    }
}