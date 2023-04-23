<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Konekt\Acl\Traits\HasRoles;
use Konekt\Customer\Models\CustomerProxy;
use Konekt\Customer\Traits\BelongsToACustomer;
use Konekt\Customer\Traits\CustomerIsOptional;
use Konekt\User\Contracts\Profile;
use Konekt\User\Contracts\User as UserContract;

class User extends Authenticatable implements UserContract {

    use HasApiTokens,
        HasFactory,
        Notifiable,
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
    ];

// Implement these methods from the required Interface:
    public function inactivate() {
        $this->is_active = false;
        $this->save();
    }

    public function activate() {
        $this->is_active = true;
        $this->save();
    }

    public function getProfile(): ?Profile {
        return null;
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
