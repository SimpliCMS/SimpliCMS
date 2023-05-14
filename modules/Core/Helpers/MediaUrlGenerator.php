<?php

namespace Modules\Core\Helpers;

use Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator;
use Illuminate\Support\Facades\Storage;

class MediaUrlGenerator extends DefaultUrlGenerator {

    public function getUrl(): string {
        $url = Storage::disk($this->getDiskName())->url('') . $this->getPathRelativeToRoot();
        return $this->versionUrl($url);
    }

}
