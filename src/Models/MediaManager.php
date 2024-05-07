<?php

namespace BalajiDharma\LaravelMediaManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MediaManager extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function mediaManagerMedia(): MorphOne
    {
        return $this->MorphOne($this->getMediaModel(), 'model');
    }
}