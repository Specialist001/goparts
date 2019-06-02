<?php

namespace api\transformers;

use Yii;

class StoreCategoryList
{
    public static function transform($list)
    {
        $data = [];

        $loop = 0;
        foreach ($list as $item) {
            $data[$loop] = [
                'id' => $item->id,
                'title' => $item->translate->title,
                'short' => $item->translate->short,
                'description' => $item->translate->description,
                'parent_id' => $item->parent_id? $item->parent_id: null,
                'image' => $item->image,
                'view' => $item->view,
                'subCats' => null,
            ];

            foreach ($item->activeCategories as $activeCategory) {
                $data[$loop]['subCats'][] = [
                    'id' => $activeCategory->id,
                    'title' => $activeCategory->translate->title,
                    'short' => $activeCategory->translate->short,
                    'description' => $activeCategory->translate->description,
                    'image' => $activeCategory->image,
                    'view' => $activeCategory->view,
                    'hasChild' => ($activeCategory->activeCategories)? true: false,
                ];
            }

            $loop++;
        }

        return $data;
    }
}
