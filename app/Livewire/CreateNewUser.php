<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Input;
use App\Models\Sensor;
use App\Models\Project;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\ProjectInput;
use App\Models\ProjectSensor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

#[Layout('components.my-layouts.layout')]
class CreateNewUser extends Component
{
    public $tab = 1;
    public $previewInputs = [];
    public $previewSensors = [];

    #[Validate('nullable')]
    public $title;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|email|max:255|unique:users')]
    public $email;

    #[Validate('required|string|min:10|max:20|unique:users|regex:/^\+?[0-9\s]+$/')]
    public $phone;

    #[Validate('required')]
    public $role;

    #[Validate('nullable')]
    public $verification;

    #[Validate('nullable|string|max:100')]
    public $project_name;

    #[Validate('required_with:project_name')]
    public $category;

    #[Validate('nullable|string|max:255')]
    public $line1;

    #[Validate('nullable|string|max:255')]
    public $line2;

    #[Validate('nullable|integer|max:5')]
    public $postcode;

    #[Validate('nullable|string|max:100')]
    public $city;

    #[Validate('nullable|string|max:100')]
    public $state;

    #[Validate('nullable|string|max:100')]
    public $country;

    #[Validate('')]
    public $selectedInputs = []; // For selected inputs

    #[Validate('')]
    public $selectedSensors = []; // For selected sensors

    public function createUniqueSlug($name, $class, $field)
    {
        $parts = explode(' ', trim(strtolower($name)));

        $baseSlug = isset($parts[1]) ? $parts[1] : $parts[0];

        $randomNumber = random_int(1000, 9999);
        $slug = '@' . $baseSlug . '_' . $randomNumber;

        while ($class::query()->where($field, $slug)->exists()) {
            $randomNumber = random_int(1000, 9999);
            $slug = '@' . $baseSlug . '_' . $randomNumber;
        }

        return $slug;
    }

    public function saveAndPreview()
    {
        if(!empty($this->selectedInputs)) {
            $this->previewInputs = Input::whereIn('id', $this->selectedInputs)->get();
            dump($this->previewInputs);
        }

        if(!empty($this->selectedSensors)) {
            $this->previewSensors = Sensor::whereIn('id', $this->selectedSensors)->get();
        }

        try {
            $this->validate();
            $this->tab = 4;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->tab = 1;
            $this->validate();
        }
    }

    public function submit()
    {
        $this->validate();

        $user = User::create([
            'title' => $this->title,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => '+6' . $this->phone,
            'username' => $this->createUniqueSlug($this->name, User::class, 'username'),
            'role' => $this->role,
            'email_verified_at' => $this->verification,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        if ($this->project_name != null) {
            $Project = Project::create([
                'user_id' => $user->id,
                'name' => $this->project_name,
                'slug' => $this->createUniqueSlug($this->project_name, Project::class, 'slug'),
            ]);

            if (!empty($this->selectedInputs)) {
                $inputs = Input::whereIn('id', $this->selectedInputs)->get();

                foreach ($inputs as $input) {
                    ProjectInput::create([
                        'project_id' => $Project->id,
                        'input_id' => $input->id,
                        'custom_name' => $input->name
                    ]);
                }
            }

            if (!empty($this->selectedSensors)) {
                $sensors = Sensor::whereIn('id', $this->selectedSensors)->get();

                foreach ($sensors as $sensor) {
                    ProjectSensor::create([
                        'project_id' => $Project->id,
                        'sensor_id' => $sensor->id,
                        'value' => 0
                    ]);
                }
            }
        }

        $this->reset();

        session()->flash('success', 'User created successfully.');
 
        // Redirect to the dashboard after successful user creation
        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.create-new-user', [
            'inputs' => Input::all(),
            'sensors' => Sensor::all()
        ]);
    }

    public function incrementStep()
    {
        $this->tab++;
    }

    public function decrementStep()
    {
        $this->tab--;
    }
}
