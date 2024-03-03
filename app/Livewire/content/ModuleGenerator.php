<?php

namespace App\Livewire\Content;

use App\Models\ModuleGenerator as ModelsModuleGenerator;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class ModuleGenerator extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $editModuleData;

    public $paginate = 10;
    public $search = '';

    // Add
    public $a_module_name = '';
    public $a_controller_name = '';
    public $a_route_name = '';
    public $a_icon_path = '';

    public function clearDataProperties()
    {
        $this->reset(['a_module_name', 'a_controller_name', 'a_route_name', 'a_icon_path']);
        $this->resetErrorBag();
    }

    public function addModule()
    {
        $class_name = Str::studly($this->a_route_name);

        $this->validate([
            'a_module_name' => 'required|unique:module_generators,name',
            'a_controller_name' => 'required|unique:module_generators,controller_name',
            'a_route_name' => 'required|unique:module_generators,route_name',
        ]);

        ModelsModuleGenerator::create([
            'name' => $this->a_module_name,
            'controller_name' => $this->a_controller_name,
            'route_name' => $this->a_route_name,
            'icon_img_path' => $this->a_icon_path,
            'controller_path' => "Http/Controllers/Modules/$this->a_controller_name",
            'blade_path' => "views/links/$this->a_route_name.blade.php",
            'livewire_path' => "views/livewire/livewireModule/$this->a_route_name.blade.php",
            'livewire_controller_path' => "Livewire/livewireModule/$class_name.php",
            'is_active' => 1,
            'created_by' => auth()->user()->id
        ]);

        // $this->createFileControllerBlade($this->a_module_name, $this->a_route_name);
        // $this->createFileController($this->a_controller_name, $this->a_route_name);
        // $this->createFileLivewireBlade($this->a_module_name, $this->a_route_name);
        // $this->createFileLivewireBackend($this->a_route_name);

        $this->dispatch('refreshComponent');
        request()->session()->flash('add-success', 'Module Added Sucessfully');
    }

    public function editModule()
    {

    }

    public function viewModule($moduleId)
    {
    }

    public function render()
    {
        $data = [];
        $data['modules'] = ModelsModuleGenerator::query()
            ->leftJoin('users', 'users.id', 'module_generators.id')
            ->select('module_generators.*',
                'users.name as created_by'
            )
            ->paginate($this->paginate);
        
        return view('livewire.content.module-generator', $data);
    }

    public function createFileControllerBlade($module_name, $route_name)
    {
        // Define the directory path for the view file
        $viewDirectory = resource_path("views/links");

        // Define the file path for the blade view
        $viewPath = $viewDirectory . "/$route_name.blade.php";

        // Check if the view file already exists
        if (!File::exists($viewPath)) {
            // Create the blade file
            File::put($viewPath, '');

            // Write the blade code
            $bladeCode = 
            <<<BLADE
            @extends('backend.main-layout')

            {{-- Module Title --}}
            @section('title','$module_name')

            @section('content')
                @livewire('livewireModule.$route_name')
            @endsection
            BLADE;

            // Write the blade code to the file
            File::put($viewPath, $bladeCode);
        }
    }

    public function createFileLivewireBlade($module_name, $route_name)
    {
        // Define the directory path for the view file
        $viewDirectory = resource_path("views/livewire/livewireModule");

        // Define the file path for the blade view
        $viewPath = $viewDirectory . "/$route_name.blade.php";

        // Check if the view file already exists
        if (!File::exists($viewPath)) {
            // Create the blade file
            File::put($viewPath, '');

            // Write the blade code
            $bladeCode = 
            <<<BLADE
                <div>
                    
                </div>
            BLADE;

            // Write the blade code to the file
            File::put($viewPath, $bladeCode);
        }
    }

    public function createFileLivewireBackend($route_name)
    {
        // Convert the route name to StudlyCase for class name
        $class_name = Str::studly($route_name);

        // Define the directory path for the Livewire component file
        $livewireDirectory = app_path("Livewire/livewireModule");

        // Define the file path for the Livewire component
        $livewirePath = $livewireDirectory . "/{$class_name}.php";
        
        // Check if the Livewire component file already exists
        if (!File::exists($livewirePath)) {
            // Create the Livewire component file
            File::put($livewirePath, '');

            // Write the Livewire component code
            $livewireCode = 
            <<<PHP
            <?php

            namespace App\\Livewire\\LivewireModule;

            use Livewire\\Component;

            class {$class_name} extends Component
            {
                public function render()
                {
                    return view('livewire.livewireModule.$route_name');
                }
            }
            PHP;

            // Write the Livewire component code to the file
            File::put($livewirePath, $livewireCode);
        }
    }

    public function createFileController($controller, $livewire)
    {
        $class_name = Str::studly($controller);
        $controller_name = $class_name;
        $controllerPath = app_path("Http/Controllers/Modules/$controller_name.php");

        // Check if the controller file already exists
        if (!File::exists($controllerPath)) {
            // Create the controller file
            File::put($controllerPath, '');

            // Write the controller code
            $controllerCode = 
            <<<PHP
            <?php

            namespace App\Http\Controllers\Modules;

            use Illuminate\Http\Request;
            use App\Http\Controllers\Controller;

            class {$class_name} extends Controller
            {
                public function index(){
                    return view('links.$livewire');
                }
            }
            PHP;

            // Write the controller code to the file
            File::put($controllerPath, $controllerCode);
        }
    }

}
