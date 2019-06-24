<?php


namespace api\transformers;


class QueryAddList
{
    public static function transform($list)
    {
        $data = [];

        $loop = 0;

        foreach ($list as $item) {
            $data[$loop] = [
                'id' => $item->id,
                'title' => $item->title,
                'car' => $item->vendor.' '.$item->car.' '.$item->modification.' '.$item->year,
                'category_id' => $item->category_id,
                'fueltype' => $item->fueltype,
                'engine' => $item->engine,
                'transmission' => $item->transmission,
                'drivetype' => $item->drivetype,
                'name' => $item->name,
                'phone' => $item->phone,
                'email' => $item->email,
            ];


            $loop++;
        }
        return $data;
    }
}