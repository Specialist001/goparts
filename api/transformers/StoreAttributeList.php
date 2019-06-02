<?php


namespace api\transformers;


class StoreAttributeList
{
    public static function transform($list)
    {
        $data = [];

        $loop = 0;

        foreach ($list as $item) {
            $data[$loop] = [
                'id' => $item->id,
                'group_id' => $item->group_id ? $item->group_id: null,
                'title' => $item->translate->title,
                'type' => $item->type,
                'unit' => $item->unit ? $item->unit : null,
                'required' => $item->required,
                'is_filter' => $item->is_filter,
//                'options' => $item->storeAttributeOptions,
//                'subCats' => null,
                'values' => null,
            ];

            foreach ($item->storeAttributeOptions as $option) {
                $data[$loop]['values'][] = [
                    'id' => $option->id,
                    'attribute_id' => $option->attribute_id,
                    'order' => $option->order ? $option->order : null,
                    'title' => $option->translate->value,
                ];
            }

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