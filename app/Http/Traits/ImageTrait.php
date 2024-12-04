<?php 
namespace App\Http\Traits;
use Illuminate\Http\Request;
Trait ImageTrait
{
    public function ImageTrait(Request $request, string $fieldName, string $destinationPath = 'assets/img/')
    {
        if ($request->hasFile($fieldName)) {
            $image = $request->file($fieldName);
            $fileName = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $fileName);

            return $destinationPath . $fileName;
        }

        return null;
    }

}