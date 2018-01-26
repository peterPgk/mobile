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

class Phone extends Model implements FileSource
{
    use Searchable;
    use Fileable;

    protected $fillable = ['name', 'description', 'year', 'available'];

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
     * Phone has one or many accessories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function accessories()
    {
        return $this->belongsToMany(Accessory::class)->withTimestamps();
    }

}
