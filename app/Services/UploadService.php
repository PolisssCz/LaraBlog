<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class UploadService
{
    public function saveFile($model, $file)
    {
        // create new file
            $dirname = Str::lower(( class_basename($model) ) .'s');  
            if ( $dirname === 'users') {
            $filepath = public_path( "img/$dirname/{$model->id}" );
            } 
            else
            {
                $filepath = storage_path( "$dirname/{$model->id}" );        

            } //return filepath

            if ($dirname === 'users'){ 
                $extension = $file->getClientOriginalExtension();
                $filename = "avatar" . ".$extension";
            } 
            else
            {
                $extension = $file->getClientOriginalExtension();
                $filename = str_replace(
                    ".$extension",
                    "-". rand(11111, 99999) . ".$extension",
                    $file->getClientOriginalName(),                         
                );
                
            } //return filename

        //save the file
        $file->move($filepath, $filename);

        // detect the size of the uploaded file
        $sizeB = filesize("$filepath/$filename");
        $sizeKb =  round($sizeB * 0.00097656, 2);
        // add file to db
        return $this->addFileToDatabase( $file, $filename, $model, $sizeKb);       

    }

    public function addFileToDatabase($file, $filename, $model, $sizeKb )
    {
        // store it in the DB
        return File::create([
            'fileable_id'    => $model->id,
            'fileable_type'  => get_class($model),
            
            'name'     => $file->getClientOriginalName(),
            'filename' => $filename,
            'mime'     => $file->getClientMimeType(),
            'ext'      => $file->getClientOriginalExtension(),
            'size'     => $sizeKb,
        ]);
    }

}
