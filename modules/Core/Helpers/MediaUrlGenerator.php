<?php

namespace Modules\Core\Helpers;

use Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator;

class MediaUrlGenerator extends DefaultUrlGenerator {

  public function getUrl(): string
    {
        $url = url('/app/storage/app/public/'.$this->getPathRelativeToRoot());

        return $this->versionUrl($url);
    }

}
