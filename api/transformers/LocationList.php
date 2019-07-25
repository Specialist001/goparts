<?php


namespace api\transformers;


class LocationList
{
    public static function transform($list)
    {
        $data = [];

        $loop = 0;

        foreach ($list as $item) {
            $data[$loop] = [
                'id' => $item->id,
                'city_name' => $item->name,
                'stocks' => null,
            ];

            foreach ($item->stocks as $stock) {
                $data[$loop]['stocks'][] = [
                    'id' => $stock->id,
                    'city_id' => $stock->city_id,
                    'name' => $stock->name,
                ];
            }

            $loop++;
        }

        return $data;
    }
}