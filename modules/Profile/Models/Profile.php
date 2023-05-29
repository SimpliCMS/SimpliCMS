<?php

namespace Modules\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Konekt\User\Models\Profile as ProfileModel;
use Konekt\User\Models\UserProxy;
use Modules\User\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laravolt\Avatar\Facade as Avatar;

class Profile extends ProfileModel implements HasMedia {

    use InteractsWithMedia;

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
            $gravatarUrl = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->user->email))) . '?s=200&d=404';

            $response = Http::head($gravatarUrl);

            if ($response->status() === 404) {
                $avatar = Avatar::create($this->user->name)->setFontSize(200)->setDimension(500, 500)->toBase64();
                return $avatar;
            } else {
                return $gravatarUrl;
            }
        } else {
            $avatar = url($this->avatar_data);
        }

        return $avatar;
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('avatar')
                ->useDisk('profile_avatar')
                ->singleFile()
                ->registerMediaConversions(function (Media $media) {
                    $this
                    ->addMediaConversion('thumb')
                    ->width(100)
                    ->height(100);
                });

        $this->addMediaCollection('cover-photos')
                ->useDisk('profile_cover')
                ->registerMediaConversions(function (Media $media) {
                    $this
                    ->addMediaConversion('thumb')
                    ->width(100)
                    ->height(100);
                });
    }

}
