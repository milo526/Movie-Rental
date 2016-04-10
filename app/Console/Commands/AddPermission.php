<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;

class AddPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:permission:add {permission} {role : the id of the role} {--name=} {--description=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->option('name');
        $permission = $this->argument('permission');
        $description = $this->option('description');
        $role = Role::find($this->argument('role'));

        $permission = Permission::create([
            'name' => $name,
            'slug' => $permission,
            'description' => $description, // optional
        ]);

        $role->attachPermission($permission);
    }
}
