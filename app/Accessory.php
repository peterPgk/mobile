<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 22.1.2018 г.
 * Time: 15:21
 */

namespace App;

use App\Contracts\FileSource;
use App\Traits\Fileable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;

class Accessory extends Model implements FileSource
{
//    use HasMediaTrait;
    use Searchable;
    use Fileable;

    protected $fillable = ['name', 'description', 'available'];

    protected $casts = [
        'year' => 'integer',
        'available' => 'boolean'
    ];


    /**
     *
     * RELATIONSHIPS
     *
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function phones()
    {
        return $this->belongsToMany(Phone::class)->withTimestamps();
    }

    /**
     * Отначало мислех да използвам този пакет за картинки
     * но след това направих мое решение(стартово)
     *
     * @param Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
//    public function registerMediaConversions(Media $media = null)
//    {
//        $this->addMediaConversion('thumb')
//            ->width(150);
//    }
}
