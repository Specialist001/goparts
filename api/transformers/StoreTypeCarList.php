<?php


namespace api\transformers;


class StoreTypeCarList
{
    public static function transform($list)
    {
        $data = [];

        $loop = 0;

        foreach ($list as $item) {
            $data[$loop] = [
                'id' => $item->id,
                'title' => $item->translate->name,
                'parent_id' => $item->parent_id ? $item->parent_id: null,
                'image' => $item->image,
                'view' => $item->view,
                'external_id' => $item->external_id ? $item->external_id : null,
                'subCats' => null,
            ];

            foreach ($item->activeCategories as $activeCategory) {
                $data[$loop]['subCats'][] = [
                    'id' => $activeCategory->id,
                    'title' => $activeCategory->translate->name,
                    'image' => $activeCategory->image,
                    'view' => $activeCategory->view,
                    'external_id' => $activeCategory->external_id ? $activeCategory->external_id : null,
                    'hasChild' => ($activeCategory->activeCategories)? true: false,
                ];
            }

            $loop++;
        }
        return $data;
    }
}