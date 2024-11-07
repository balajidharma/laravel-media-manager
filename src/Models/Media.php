<?php

namespace BalajiDharma\LaravelMediaManager\Models;

use BalajiDharma\LaravelMediaManager\Traits\LaravelCategories;
use Plank\Mediable\Media as MediableMedia;

class Media extends MediableMedia
{
    use LaravelCategories;
}
