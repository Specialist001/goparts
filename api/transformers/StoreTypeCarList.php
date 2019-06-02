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

            foreach ($item->activeTypes as $activeType) {
                $data[$loop]['subCats'][] = [
                    'id' => $activeType->id,
                    'title' => $activeType->translate->name,
                    'image' => $activeType->image,
                    'view' => $activeType->view,
                    'external_id' => $activeType->external_id ? $activeType->external_id : null,
                    'hasChild' => ($activeType->activeTypes)? true: false,
                ];
            }

            $loop++;
        }
        return $data;
    }
}