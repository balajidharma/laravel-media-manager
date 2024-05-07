<?php

namespace BalajiDharma\LaravelMediaManger\Traits;

use BalajiDharma\LaravelMediaManger\Models\MediaManager;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\morphToMany;
use Spatie\MediaLibrary\MediaCollections\FileAdder;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait HasMediable 
{

    public function mediable(): morphToMany
    {
        return $this->morphToMany(MediaManager::class, 'mediable');
    }

    public function addMedia(string|UploadedFile $file): FileAdder
    {
        $mediaManager = (new MediaManager)->create();
        $this->mediable()->save($mediaManager);
        return $mediaManager->addMedia($file);
    }

    public function addMediaFromRequest(string $key): FileAdder
    {
        $mediaManager = (new MediaManager)->create();
        $this->mediable()->save($mediaManager);
        return $mediaManager->addMediaFromRequest($key);
    }

    /**
     * Get media collection by its collectionName.
     */
    public function getMedia(string $collectionName = 'default', array|callable $filters = []): MediaCollection
    {
        $mediable = $this->mediable()->with('mediaManagerMedia')->get();
        $mediaIds = $mediable->pluck('mediaManagerMedia.id');
        return $mediable->first()->getMedia($collectionName, $filters)->whereIn('id', $mediaIds);
    }
}
