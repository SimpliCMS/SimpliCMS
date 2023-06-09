<?php

namespace Modules\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Konekt\Acl\Contracts\Role;
use Konekt\Acl\Models\RoleProxy;
use Konekt\AppShell\Acl\ResourcePermissionMapper;
use Konekt\User\Models\UserProxy;
use Konekt\User\Models\UserType;
use Konekt\Address\Models\PersonProxy;
use Modules\User\Models\User;
use Modules\Profile\Models\Profile;

class SuperCommand extends Command {

    protected $signature = 'core:make:superuser';
    protected $description = 'Create a superuser (for initial setup)';

    /** @var ResourcePermissionMapper */
    private $permissionMapper;

    public function handle(ResourcePermissionMapper $permissionMapper) {
        $this->permissionMapper = $permissionMapper;
        $this->info("Now you're about to create a new user with all privileges");

        $email = $this->askEmail();
        $username = $this->askUsername();
        $name = $this->ask('Name');
        $pass = $this->secret('Password');
        $roleName = $this->ask('Role name', 'admin');

        $role = $this->fetchRole($roleName);

        $user = User::create([
                    'email' => $email,
                    'username' => $username,
                    'name' => $name,
                    'password' => bcrypt($pass),
                    'type' => UserType::ADMIN
                ])->fresh();

        $nameParts = explode(' ', $user->name, 2); // Split into maximum 2 parts

        $firstName = $nameParts[0]; // First name is always the first part

        if (count($nameParts) > 1) {
            $lastName = $nameParts[1]; // Last name is the second part if available
        } else {
            $lastName = $firstName; // Use first name for last name if last name is not available
        }

        $person = PersonProxy::create([
                    'user_id' => $user->id,
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                ])->fresh();

        $profile = new Profile([
            'user_id' => $user->id,
            'person_id' => $person->id
        ]);

        $user->profile()->save($profile);
        $this->info("User '$email' has been created (id: {$user->id})");

        $user->assignRole($roleName);
        $this->info("Role '$roleName' has been assigned to '$email'.");
    }

    /**
     * Asks for and validates E-mail address
     *
     * @return string
     */
    protected function askEmail() {
        $email = $this->ask('E-mail');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error("'$email' is not an email address.");
            exit(2);
        }
        /** @var Builder $query */
        $query = UserProxy::where('email', $email);
        if ($usesSoftDelete = method_exists(UserProxy::modelClass(), 'initializeSoftDeletes')) {
            $query->withTrashed();
        }
        if ($user = $query->first()) {
            if ($usesSoftDelete && $user->trashed()) {
                $this->error("A deleted user '$email' already exists");
            } else {
                $this->error("User '$email' already exists");
            }
            exit(3);
        }

        return $email;
    }

    /**
     * Asks for and validates Username
     *
     * @return string
     */
    protected function askUsername() {
        $username = $this->ask('Username');

        /** @var Builder $query */
        $query = UserProxy::where('username', $username);
        if ($usesSoftDelete = method_exists(UserProxy::modelClass(), 'initializeSoftDeletes')) {
            $query->withTrashed();
        }
        if ($user = $query->first()) {
            if ($usesSoftDelete && $user->trashed()) {
                $this->error("A deleted user '$username' already exists");
            } else {
                $this->error("User '$username' already exists");
            }
            exit(3);
        }

        return $username;
    }

    /**
     * @param $roleName
     *
     * @return Role
     */
    protected function fetchRole($roleName) {
        $role = RoleProxy::where('name', $roleName)->first();
        if (!$role) {
            if (!$this->confirm("Role '$roleName' doesn't exists. Create it?")) {
                $this->warn('Nothing has been done.');
                exit(1);
            }

            $role = $this->createRole($roleName);
            $this->info("Role '$roleName' has been created (id: {$role->id})'");
        }

        return $role;
    }

    /**
     * @param $name
     *
     * @return Role
     */
    protected function createRole($name) {
        /** @var \Konekt\Acl\Models\Role $role */
        $role = RoleProxy::create(['name' => $name])->fresh();

        $role->givePermissionTo($this->permissionMapper->allPermissionsFor('user'));
        $role->givePermissionTo($this->permissionMapper->allPermissionsFor('role'));

        return $role;
    }

}
