<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 25.1.2018 г.
 * Time: 11:57
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Storage;

/**
 * App\Models\File
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $name
 * @property string $path
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read string $type
 * @property-read mixed $file_name
 * @method static Builder|File whereId($value)
 * @method static Builder|File whereTypeId($value)
 * @method static Builder|File whereName($value)
 * @method static Builder|File wherePath($value)
 * @method static Builder|File whereCreatedAt($value)
 * @method static Builder|File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    protected $fillable = ['type', 'name', 'path'];

    /**
     * @param $type
     * @return bool
     */
    public function isType($type)
    {
        return $this->type === $type;
    }

    /**
     * Ако искаме да
     * @return bool
     */
    public function removeFile()
    {
//        return Storage::delete($this->path);
        return \File::delete($this->path);
    }


}
