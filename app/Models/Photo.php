<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;

    protected $table = 'children_to_photos';

    protected $fillable = ['photo_uri'];

    protected $appends = ['full_photo_uri', 'full_photo_uri_original'];

    /**
     * Get full photo uri
     *
     * @return string
     */
    public function getFullPhotoUriAttribute()
    {
        if (empty($this->photo_uri)) {
            return  asset('/img/portrait.png');
        }

        return asset('storage/' . $this->photo_uri);
    }

    /**
     * Get full photo uri for the original photo
     *
     * @return string
     */
    public function getFullPhotoUriOriginalAttribute()
    {
        if (empty($this->photo_uri)) {
            return  asset('/img/portrait.png');
        }

        $split_uri = explode('/', $this->photo_uri);
        $file_name = array_pop($split_uri);
        $full_uri = implode('/', $split_uri) . '/original/' . $file_name;
        return asset('storage/' . $full_uri);
    }
}
