<?php

namespace App\Helper;

trait Imageable
{
    public function storeMedia($request)
    {
        $logosPath = public_path('images/eventLogos');
        $flyersPath = public_path('images/eventFlyers');

        if (!file_exists($logosPath)) {
            mkdir($logosPath, 0777, true);
        }

        if (!file_exists($flyersPath)) {
            mkdir($flyersPath, 0777, true);
        }

        $logo = $request->file('logo');
        $flyer = $request->file('flyer');

        $logoName = uniqid() . '_' . trim($logo->getClientOriginalName());
        $flyerName = uniqid() . '_' . trim($flyer->getClientOriginalName());

        $this->image_logo = "images/eventLogos/" . $logoName;
        $this->image_flyer = "images/eventFlyers/" . $flyerName;

        $this->save();

        $logo->move($logosPath, $logoName);
        $flyer->move($flyersPath, $flyerName);
    }
}
