<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeFullCrud extends Command
{
    protected $signature = 'make:full-crud {name} {fields*}';
    protected $description = 'Generate model, migration, controller, requests, repository, service and routes';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $fields = $this->argument('fields');
        $modelVar = Str::camel($name);
        $modelPlural = Str::plural($modelVar);
        $table = Str::snake(Str::plural($name));

        $attributes = [];
        $migrationFields = [];
        $validations = [];

        foreach ($fields as $field) {
            $parts = explode(':', $field);
            $fieldName = $parts[0];
            $type = $parts[1] ?? 'string';
            $required = $parts[2] ?? 'nullable';
            
            $attributes[] = "'$fieldName'";
            $rule = $required === 'required' ? 'required' : 'nullable';
            $validations[$fieldName] = $rule;

            $migrationFields[] = "            \$table->$type('$fieldName');";
        }

        // Model + Migration
        $this->call('make:model', ['name' => $name, '--migration' => true]);

        // Update model with fillable
        $modelPath = app_path("Models/$name.php");
        if (File::exists($modelPath)) {
            $content = File::get($modelPath);
            $fillable = "    protected \$fillable = [\n        " . implode(",\n        ", $attributes) . "\n    ];";
            $content = preg_replace('/class\s+' . $name . '\s+extends\s+Model\s*\{/', "class $name extends Model\n{\n$fillable\n", $content);
            File::put($modelPath, $content);
        }

        // Update migration with fields (insert between id and timestamps)
        $files = File::files(database_path('migrations'));
        foreach ($files as $file) {
            if (Str::contains($file->getFilename(), "create_{$table}_table")) {
                $content = File::get($file->getRealPath());
                $fieldsStr = implode("\n", $migrationFields);
                // Insert fields after $table->id() and before $table->timestamps()
                $content = preg_replace('/(\$table->id\(\);)/', "$1\n$fieldsStr", $content);
                File::put($file->getRealPath(), $content);
                break;
            }
        }

        // Store & Update Requests
        foreach (['Store', 'Update'] as $prefix) {
            $requestName = $prefix . $name . 'Request';
            $this->call('make:request', ['name' => $requestName]);
            $path = app_path("Http/Requests/$requestName.php");
            if (File::exists($path)) {
                $content = File::get($path);
                // Set authorize() to return true
                $content = preg_replace("/public function authorize\(\).*?\{.*?return false;.*?\}/s", "public function authorize(): bool\n    {\n        return true;\n    }", $content);
                
                $rules = "";
                foreach ($validations as $field => $rule) {
                    $rules .= "            '$field' => '$rule',\n";
                }
                $content = preg_replace('/public function rules\(\).*?\{.*?return \[.*?\];.*?\}/s', "public function rules(): array\n    {\n        return [\n$rules        ];\n    }", $content);
                File::put($path, $content);
            }
        }

        // Controller
        $controller = $name . 'Controller';
        $this->call('make:controller', ['name' => $controller]);

        $controllerPath = app_path("Http/Controllers/$controller.php");
        if (File::exists($controllerPath)) {
            $controllerContent = $this->getControllerStub($name, $modelVar);
            File::put($controllerPath, $controllerContent);
        }

        // Repository & Interface
        $repoPath = app_path("Repositories/{$name}Repository.php");
        $repoInterfacePath = app_path("Repositories/Contracts/{$name}RepositoryInterface.php");
        File::ensureDirectoryExists(dirname($repoInterfacePath));
        File::ensureDirectoryExists(dirname($repoPath));

        File::put($repoInterfacePath, "<?php

namespace App\Repositories\Contracts;

interface {$name}RepositoryInterface
{
    public function all();
    public function find(\$id);
    public function create(array \$data);
    public function update(\$id, array \$data);
    public function delete(\$id);
}
");

        File::put($repoPath, "<?php

namespace App\Repositories;

use App\Models\$name;
use App\Repositories\Contracts\$nameRepositoryInterface;

class {$name}Repository implements {$name}RepositoryInterface
{
    public function all()
    {
        return {$name}::all();
    }

    public function find(\$id)
    {
        return {$name}::findOrFail(\$id);
    }

    public function create(array \$data)
    {
        return {$name}::create(\$data);
    }

    public function update(\$id, array \$data)
    {
        \$model = {$name}::findOrFail(\$id);
        \$model->update(\$data);
        return \$model;
    }

    public function delete(\$id)
    {
        return {$name}::destroy(\$id);
    }
}
");

        // Service & Interface
        $servicePath = app_path("Services/{$name}Service.php");
        $serviceInterfacePath = app_path("Services/Contracts/{$name}ServiceInterface.php");
        File::ensureDirectoryExists(dirname($servicePath));
        File::ensureDirectoryExists(dirname($serviceInterfacePath));

        File::put($serviceInterfacePath, "<?php

namespace App\Services\Contracts;

interface {$name}ServiceInterface
{
    public function all();
    public function find(\$id);
    public function create(array \$data);
    public function update(\$id, array \$data);
    public function delete(\$id);
}
");

        File::put($servicePath, "<?php

namespace App\Services;

use App\Repositories\Contracts\$nameRepositoryInterface;
use App\Services\Contracts\{$name}ServiceInterface;

class {$name}Service implements {$name}ServiceInterface
{
    protected \$repository;

    public function __construct({$name}RepositoryInterface \$repository)
    {
        \$this->repository = \$repository;
    }

    public function all()
    {
        return \$this->repository->all();
    }

    public function find(\$id)
    {
        return \$this->repository->find(\$id);
    }

    public function create(array \$data)
    {
        return \$this->repository->create(\$data);
    }

    public function update(\$id, array \$data)
    {
        return \$this->repository->update(\$id, \$data);
    }

    public function delete(\$id)
    {
        return \$this->repository->delete(\$id);
    }
}
");

        // Bind in AppServiceProvider
        $providerPath = app_path('Providers/AppServiceProvider.php');
        if (File::exists($providerPath)) {
            $providerContent = File::get($providerPath);

            $bindCode = "        \$this->app->bind(\\App\\Repositories\\Contracts\\{$name}RepositoryInterface::class, \\App\\Repositories\\{$name}Repository::class);\n";
            $bindCode .= "        \$this->app->bind(\\App\\Services\\Contracts\\{$name}ServiceInterface::class, \\App\\Services\\{$name}Service::class);";

            if (!str_contains($providerContent, "{$name}RepositoryInterface")) {
                // Check if register method exists and has content
                if (preg_match('/public function register\(\)\s*\{([^}]*)\}/s', $providerContent, $matches)) {
                    $existingContent = trim($matches[1]);
                    if (empty($existingContent)) {
                        // Empty register method
                        $providerContent = preg_replace('/public function register\(\)\s*\{\s*\}/', "public function register()\n    {\n$bindCode\n    }", $providerContent);
                    } else {
                        // Add to existing content
                        $providerContent = preg_replace('/public function register\(\)\s*\{/', "public function register()\n    {\n$bindCode", $providerContent);
                    }
                } else {
                    // No register method found, add it
                    $providerContent = preg_replace('/class AppServiceProvider extends ServiceProvider\s*\{/', "class AppServiceProvider extends ServiceProvider\n{\n    public function register()\n    {\n$bindCode\n    }", $providerContent);
                }
                File::put($providerPath, $providerContent);
            }
        }

        // Add to routes
        $routePath = base_path('routes/api.php');
        $route = "Route::apiResource('" . Str::kebab($modelPlural) . "', {$controller}::class);";
        
        if (File::exists($routePath)) {
            $routeContent = File::get($routePath);
            if (!str_contains($routeContent, $route)) {
                File::append($routePath, "\n$route\n");
            }
        }

        $this->info("✅ Full CRUD for {$name} generated successfully!");
        $this->info("📁 Generated files:");
        $this->info("   - Model: app/Models/{$name}.php");
        $this->info("   - Migration: database/migrations/..._create_{$table}_table.php");
        $this->info("   - Controller: app/Http/Controllers/{$controller}.php");
        $this->info("   - Requests: app/Http/Requests/Store{$name}Request.php, Update{$name}Request.php");
        $this->info("   - Repository: app/Repositories/{$name}Repository.php");
        $this->info("   - Service: app/Services/{$name}Service.php");
        $this->info("   - Route: routes/api.php");
    }

    private function getControllerStub($name, $modelVar)
    {
        return "<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store{$name}Request;
use App\Http\Requests\Update{$name}Request;
use App\Services\Contracts\{$name}ServiceInterface;
use Illuminate\Http\JsonResponse;

class {$name}Controller extends Controller
{
    protected \$service;

    public function __construct({$name}ServiceInterface \$service)
    {
        \$this->service = \$service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        \${$modelVar}s = \$this->service->all();
        return response()->json(\${$modelVar}s);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store{$name}Request \$request): JsonResponse
    {
        \${$modelVar} = \$this->service->create(\$request->validated());
        return response()->json(\${$modelVar}, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string \$id): JsonResponse
    {
        \${$modelVar} = \$this->service->find(\$id);
        return response()->json(\${$modelVar});
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update{$name}Request \$request, string \$id): JsonResponse
    {
        \${$modelVar} = \$this->service->update(\$id, \$request->validated());
        return response()->json(\${$modelVar});
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string \$id): JsonResponse
    {
        \$this->service->delete(\$id);
        return response()->json(null, 204);
    }
}
";
    }
}