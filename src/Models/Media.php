<?php

namespace BalajiDharma\LaravelMediaManager\Models;

use BalajiDharma\LaravelMediaManager\Traits\LaravelCategories;
use Plank\Mediable\Media as MediableMedia;

class Media extends MediableMedia
{
    use LaravelCategories;

    public function getMediaUrl()
    {
        $stroageFolder = config('media-manager.storage_folder');
        if ($stroageFolder) {
            return asset($stroageFolder . '/' . $this->getDiskPath());
        }
        return asset($this->getDiskPath());
    }
}
