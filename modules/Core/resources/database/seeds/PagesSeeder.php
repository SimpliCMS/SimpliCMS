<?php

namespace Modules\Core\Resources\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Core\Models\PageProxy;
use Illuminate\Support\Facades\File;

class PagesSeeder extends Seeder {

    public function run() {

        $privacystubFilePath = base_path('/modules/Core/Console/Commands/stubs/pages/privacy.stub');
        $privacycontent = File::get($privacystubFilePath);
        $privacyPage = PageProxy::create([
                    'Title' => 'Privacy Policy',
                    'slug' => 'privacy',
                    'content' => $privacycontent,
        ]);
        $termsstubFilePath = base_path('/modules/Core/Console/Commands/stubs/pages/terms.stub');
        $termscontent = File::get($termsstubFilePath);
        $termsPage = PageProxy::create([
                    'Title' => 'Terms and Conditions',
                    'slug' => 'terms',
                    'content' => $termscontent,
        ]);
    }

}
