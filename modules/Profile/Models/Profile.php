<?php

namespace Modules\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Konekt\User\Models\Profile as ProfileModel;
use Konekt\User\Models\UserProxy;
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

    public function getUser(): User {
        return $this->user;
    }

    public function user() {
        return $this->belongsTo(UserProxy::modelClass(), 'user_id');
    }

    public function getProfileAvatar() {
        if ($this->avatar_type != 'storage') {
            $avatar = sprintf('%s%s%s', 'https://secure.gravatar.com/avatar/', md5(strtolower(trim($this->user->email))), '?s=200&d=retro');
        } else {
            $avatar = url($this->avatar_data);
        }

        return $avatar;
    }

}
