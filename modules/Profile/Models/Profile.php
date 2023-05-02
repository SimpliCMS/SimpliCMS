<?php

namespace Modules\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Konekt\User\Models\Profile as ProfileModel;
use Modules\User\Models\User;

class Profile extends ProfileModel {

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->mergeFillable(['avatar_type',
        'avatar_data',
        'user_id',
        'person_id']);
    }

    public function getProfileAvatar() {
        if (is_null(static::where('avatar_data'))) {
            $avatar = sprintf('%s%s%s', 'https://secure.gravatar.com/avatar/', md5(strtolower(trim($this->user->email))), '?s=200');
        } else {
            $url = url($this->avatar_data);
            $avatar = $url;
        }

        return $avatar;
    }

}
