<?php

namespace Modules\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Konekt\Address\Models\Person as PersonModel;

class Person extends PersonModel {

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->mergeFillable([
            'user_id',
            'gender_value',
            'bio',
        ]);
    }

}
