<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Etablissement extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'etablissements';

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name_complet',
        'tel_1',
        'tel_2',
        'email_professionel',
        'email_personnel',
        'fix',
        'direction_id',
        'unite_id',
        'profession_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function direction()
    {
        return $this->belongsTo(Directorate::class, 'direction_id');
    }

    public function unite()
    {
        return $this->belongsTo(Unit::class, 'unite_id');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }
}