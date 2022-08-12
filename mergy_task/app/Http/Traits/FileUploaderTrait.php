<?php

namespace App\Http\Traits;

/**
 * Trait FileUploaderTrait
 * @author Ahmed Mohamed
 */
trait FileUploaderTrait
{
    /**
     * function server Local storage files
     * @param $file
     * @return string
     */
    public function uploadFile($file): string
    {
        $extension = $file->getClientOriginalExtension();

        $fileName = 'file_'. time() . '_' . uniqid() . '.' . $extension;

        $file->storeAs('uploads', $fileName, 'public');

        return $fileName;
    }

}
