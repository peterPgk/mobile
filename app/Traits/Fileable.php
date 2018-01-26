<?php

/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 25.1.2018 г.
 * Time: 11:44
 */

namespace App\Traits;

use App\File;
//use Illuminate\Http\UploadedFile;
//use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

/**
 * Trait Fileable
 * @package App\Traits
 *
 * @property Collection $files
 */
trait Fileable
{

    protected $fileDir = 'files/';
    /**
     * @return mixed
     */
    public function files()
    {
        return $this->morphToMany(File::class, 'fileable');
    }

    public function images()
    {
        return $this->files()->where('type', 'image')->orderBy('weight', "asc");
    }

    public function saveFiles(Request $request, ...$args)
    {
        foreach ($request->files as $type => $file) {
            $theFile = $file->move($this->fileDir . $type .'/', $file->getClientOriginalName());
            $path = $theFile->getPathname();

//            $path = $request->{$type}->store('public/'.Str::plural($type));

            $this->files()->create([
                'type' => $type,
                'path' => $path,
                'name' => $file->getClientOriginalName()
            ]);
        }
    }

    public function deleteFile($id)
    {
        /** @var File $file */
        $file = $this->files->find($id);
        if ($file) {
            $file->delete();
            $file->removeFile();
        }
    }

    /**
     * @param int|string $type
     * @return bool
     */
    public function hasImageType($type = 'image')
    {
        return $this->files->where('type', $type)->count() > 0;
    }

    public function imageByType($type = 'image')
    {
        $image = $this->files->where('type', $type)->first();
        return $image;
    }

    public function deleteImageByType( $type = 'image')
    {
        $image = $this->files->where('type', $type)->first();

        if ($image) {
            $image->delete();
            $image->removeFile();
        }
    }

}

