<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Bican\Roles\Models\Role;

class GenerateRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the roles';

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
        if(Role::where('name', 'Admin')->count() == 0){
            $adminRole = Role::create([
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrator', // optional
                'level' => 100, // optional, set to 1 by default
            ]);
        }

        $this->info('Generated roles that did not exist');
    }
}
