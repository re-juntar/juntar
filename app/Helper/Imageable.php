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

        $this->image_logo = "tmp/uploads/" . $fileName1;
        $this->image_flyer = "tmp/uploads/" . $fileName2;

        $this->save();

        $file1->move($path, $fileName1);
        $file2->move($path, $fileName2);
    }
}
