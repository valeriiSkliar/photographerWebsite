<?php

namespace App\Models;

use App\Models\Component\Component;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SectionComponent\Entities\ComponentData;

/**
 * @method static pluck(string $string, string $string1)
 */
class Album extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    private mixed $title;
    private mixed $id;

    public function componentData()
    {
        return $this->morphMany(ComponentData::class, 'dataable');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'album_images');
    }
    public function components()
    {
        return $this->hasMany(Component::class);
    }

    public static function getIdNameArray()
    {
        return self::pluck('title', 'id')->toArray();
    }

}
