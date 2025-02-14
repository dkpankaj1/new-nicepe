<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeDatatable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:datatable {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new datatable class inside app/Actions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = str_replace('\\', '/', $this->argument('name')); // Support both slashes
        $filesystem = new Filesystem();

        // Extract the full path
        $path = app_path("Datatables/{$name}.php");

        // Extract namespace and class name
        $segments = explode('/', $name);
        $className = array_pop($segments);
        $namespace = "App\\Datatables" . (!empty($segments) ? "\\" . implode("\\", $segments) : "");

        // Ensure the directory exists
        $directory = dirname($path);
        if (!$filesystem->exists($directory)) {
            $filesystem->makeDirectory($directory, 0755, true);
        }

        // Prevent overwriting existing files
        if ($filesystem->exists($path)) {
            $this->error("Datatable class {$className} already exists!");
            return;
        }

        // Create the action class content
        $stub = <<<PHP
        <?php
        namespace $namespace;

        use Yajra\DataTables\DataTableAbstract;

        class $className extends BaseDatatable
        {
            public function __construct(){
                // parent::__construct();
            }

            public function configure(\$datatable): DataTableAbstract
            {
                return \$datatable;
                // Implement your action logic here
            }
        }
        PHP;

        // Write the file
        $filesystem->put($path, $stub);

        $this->info("Datatables class created: app/Datatables/{$name}.php");
    }
}
