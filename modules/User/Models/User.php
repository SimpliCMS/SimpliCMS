<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Konekt\Acl\Traits\HasRoles;
use Konekt\Customer\Models\CustomerProxy;
use Konekt\Customer\Traits\BelongsToACustomer;
use Konekt\Customer\Traits\CustomerIsOptional;
use Konekt\Enum\Eloquent\CastsEnums;
use Konekt\User\Events\UserWasActivated;
use Konekt\User\Events\UserWasCreated;
use Konekt\User\Events\UserWasDeleted;
use Konekt\User\Events\UserWasInactivated;
use Modules\Profile\Models\Profile;
use Modules\Profile\Models\Person;
use Konekt\User\Contracts\Profile as ProfileContract;
use Konekt\User\Contracts\User as UserContract;
use Konekt\User\Models\ProfileProxy;
use Konekt\User\Models\UserTypeProxy;
use Modules\Video\Models\VideoProxy;

class User extends Authenticatable implements UserContract {

    use HasApiTokens,
        HasFactory,
        Notifiable,
        SoftDeletes,
        CastsEnums,
        HasRoles,
        BelongsToACustomer,
        CustomerIsOptional;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'type',
        'is_active',
        'customer_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];
    protected $enums = [
        'type' => '\Konekt\User\Models\UserTypeProxy@enumClass'
    ];
    protected $events = [
        'created' => UserWasCreated::class,
        'deleted' => UserWasDeleted::class
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function ($user) { // before delete() method call this
            $user->profile->delete();
            $personDelete = Person::where('user_id', $user->id)->delete();
        });
    }

    public function getProfile(): ?ProfileContract {
        return $this->profile;
    }

    public function profile() {
        return $this->hasOne(ProfileProxy::modelClass(), 'user_id', 'id');
    }

    public function videos() {
        if (class_exists(VideoProxy)) {
            return $this->hasMany(VideoProxy::modelClass(), 'user_id', 'id');
        } else {
            // Return a default empty relationship
            return null;
        }
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

    public function inactivate() {
        $this->is_active = false;
        $this->save();

        event(new UserWasInactivated($this));
    }

    public function activate() {
        $this->is_active = true;
        $this->save();

        event(new UserWasActivated($this));
    }

    public function customersVisible(): Collection {
        if (!$this->can('list customers')) {
            return $this->isAssociatedWithACustomer() ?
                    collect([$this->customer]) :
                    collect();
        }

        return CustomerProxy::all()->sortBy('name');
    }

}
