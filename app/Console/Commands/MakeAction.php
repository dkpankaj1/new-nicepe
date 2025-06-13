<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeAction extends Command
{
    protected $signature = 'make:action {name}';
    protected $description = 'Create a new action class inside app/Actions';

    public function handle()
    {
        $name = str_replace('\\', '/', $this->argument('name')); // Support both slashes
        $filesystem = new Filesystem();

        // Extract the full path
        $path = app_path("Actions/{$name}.php");

        // Extract namespace and class name
        $segments = explode('/', $name);
        $className = array_pop($segments);
        $namespace = "App\\Actions" . (!empty($segments) ? "\\" . implode("\\", $segments) : "");

        // Ensure the directory exists
        $directory = dirname($path);
        if (!$filesystem->exists($directory)) {
            $filesystem->makeDirectory($directory, 0755, true);
        }

        // Prevent overwriting existing files
        if ($filesystem->exists($path)) {
            $this->error("Action class {$className} already exists!");
            return;
        }

        // Create the action class content
        $stub = <<<PHP
        <?php

        namespace $namespace;

        class $className
        {
            public function execute(array \$data)
            {
                // Implement your action logic here
            }
        }
        PHP;

        // Write the file
        $filesystem->put($path, $stub);

        $this->info("Action class created: app/Actions/{$name}.php");
    }
}
