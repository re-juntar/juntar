<?php

namespace App\Helper;

trait Imageable
{
    public function storeMedia($request)
    {
        $path = public_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file1 = $request->file('logo');
        $file2 = $request->file('flyer');

        $fileName1 = uniqid() . '_' . trim($file1->getClientOriginalName());
        $fileName2 = uniqid() . '_' . trim($file2->getClientOriginalName());

        $this->image_logo = $fileName1;
        $this->save();

        $this->image_flyer = $fileName2;
        $this->save();

        $file1->move($path, $fileName1);
        $file2->move($path, $fileName2);

        $paths = [
            'logo' => $path . "/" . $fileName1,
            'flyer' => $path . "/" . $fileName2
        ];
        return $paths;
    }
}
