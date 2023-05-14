<?php

namespace Modules\Core\Helpers;

use Spatie\MediaLibrary\Support\FileNamer\FileNamer;
use Spatie\MediaLibrary\Conversions\Conversion;

class MediaFileNamer extends FileNamer {

    public function originalFileName(string $fileName): string {
        $filename = pathinfo($fileName, PATHINFO_FILENAME);
        return hash('sha256', $filename);
    }

    public function conversionFileName(string $fileName, Conversion $conversion): string {
        $strippedFileName = pathinfo($fileName, PATHINFO_FILENAME);
        $hashedFile = hash('sha256', $strippedFileName);
        return "{$hashedFile}-{$conversion->getName()}";
    }

    public function responsiveFileName(string $fileName): string {
        return pathinfo($fileName, PATHINFO_FILENAME);
    }

}
