<?php


namespace api\transformers;


class StoreOptionList
{
    public static function transform($list)
    {
        $data = [];

        $loop = 0;

        foreach ($list as $item) {
            $data[$loop] = [
                'id' => $item->id,
                'name' => $item->name,
                'values' => null,
            ];

            foreach ($item->storeOptionValues as $value) {
                $data[$loop]['values'][] = [
                    'value_id' => $value->id,
                    'option_id' => $value->option_id,
                    'value' => $value->value,
                ];
            }

            $loop++;
        }
        return $data;
    }
}