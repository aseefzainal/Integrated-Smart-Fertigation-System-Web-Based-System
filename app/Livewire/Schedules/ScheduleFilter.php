<?php

namespace App\Livewire\Schedules;

use Carbon\Carbon;
use App\Models\Project;
use Livewire\Component;
use App\Models\Schedule;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use Livewire\WithoutUrlPagination;

class ScheduleFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $input_id;
    public $project_id;
    public $scheduleId;
    public $showCrudScheduleModal = false;
    public $project;
    public $autoGenerateHST = true;
    public $hstChanges = [];
    public $generatorHST;
    public $isEditing = false;

    // #[Validate('required|string|max:7|regex:/^HST-\d+$/')]
    #[Validate('required|integer|min:1|max:365')]
    public $hst;

    #[Validate('required|exists:project_inputs,id')]
    public $type;

    // #[Validate('required|date|after_or_equal:today')]
    #[Validate('required|date')]
    public $date;

    #[Validate('required|date_format:H:i')]
    public $time;

    public $showDropdown = null;

    public function toggleDropdown($scheduleId)
    {
        $this->showDropdown = $this->showDropdown === $scheduleId ? null : $scheduleId;
        // dump($this->showDropdown);
    }

    public function hideDropdown()
    {
        $this->showDropdown = null;
    }

    public function mount($project_id)
    {
        $this->project_id = $project_id;
    }

    public function render()
    {
        $this->project = Project::findOrFail($this->project_id);
        $inputs = $this->project->inputs()->where('type', 'auto')->get();

        // Always fetch the full schedule list from the database
        if ($this->input_id != null) {
            // Filter schedules based on the selected input
            $schedules = $this->project->schedules()
                ->whereHas('projectInput', function ($query) {
                    $query->where('input_id', $this->input_id);
                });
        } else {
            // If no specific input is selected, show all schedules
            $schedules = $this->project->schedules();
        }

        return view('livewire.schedules.schedule-filter', [
            'inputs' => $inputs,
            'schedules' => $schedules->orderBy(Schedule::raw('CAST(SUBSTRING(hst, 5) AS UNSIGNED)'), 'asc')->orderBy('time', 'asc')->paginate(5)
        ]);
    }

    // lifecycle Hook livewire updating + input_id (nama variable di atas)
    public function updatingInputId()
    {
        $this->resetPage();
    }

    #[On('projectSelected')]
    public function projectSelected($projectId)
    {
        $this->project_id = $projectId;
    }

    public function hstGenerator()
    {
        if ($this->autoGenerateHST) {
            // $listHST = $this->project->schedules()->select('hst', 'date')->where('hst', 'HST-1')->first();
            $listHST = $this->project->schedules()->select('hst', 'date')->orderBy('date', 'asc')->first();
            // $listHST = $this->project->schedules()->select('hst', 'date')->first();

            $inputDate = Carbon::parse($this->date);

            if ($listHST && $this->date) {
                $difference = $listHST->date->diffInDays($inputDate);

                $hst = explode('-', trim($listHST->hst));

                $this->generatorHST = $hst[1] + $difference;
                $this->hst = $this->generatorHST;
            } else if (!$listHST && $this->date) {
                $this->hst = 1;
            } else {
                $this->hst = 0;
            }
        }

        $this->rewriteHST();
    }

    public function rewriteHST()
    {
        $this->hstChanges = []; // Clear any previous changes

        // if($this->hst != $this->generatorHST) {
        // Fetch the first record by date
        $firstHSTRecord = $this->project->schedules()->select('hst', 'date')->orderBy('date', 'asc')->first();

        // Parse the input date
        $inputDate = Carbon::parse($this->date);

        // If we have at least one schedule record
        if ($firstHSTRecord) {
            // Calculate the difference in days between the first HST record date and the input date
            $baseDifference = $firstHSTRecord->date->diffInDays($inputDate);

            // Extract the HST number from the first record
            $initialHSTNumber = explode('-', trim($firstHSTRecord->hst))[1];

            // Generate the base HST value using the difference
            $hstGenerator = $initialHSTNumber + $baseDifference;

            // Extract the current HST number to compare with the generated one
            // $currentHSTNumber = explode('-', trim($this->hst))[1];

            // Only proceed with updating if the generated HST is different
            // if ($hstGenerator != $currentHSTNumber) {
            if ($hstGenerator != $this->hst && $this->date && $this->hst) {
                // Fetch all schedule records
                if ($this->isEditing) {
                    $listHST = $this->project->schedules()->orderBy('date', 'asc')->orderBy('time', 'asc')->where('schedules.id', '!=', $this->scheduleId)->get();
                } else {
                    $listHST = $this->project->schedules()->orderBy('date', 'asc')->orderBy('time', 'asc')->get();
                }

                // Loop through all records and update HST based on the difference in days
                foreach ($listHST as $hstRecord) {
                    // Calculate the difference between the input date and the current record's date
                    $difference = $inputDate->diffInDays($hstRecord->date);

                    // Update the HST value based on the difference
                    $newHSTNumber = $this->hst + $difference;

                    $this->hstChanges[] = [
                        'id' => $hstRecord->id,
                        'old_hst' => $hstRecord->hst,
                        'new_hst' => $newHSTNumber,
                        'irrigation' => $hstRecord->projectInput->custom_name,
                        'date' => $hstRecord->date,
                        'time' => $hstRecord->time
                    ];
                }
            }
        }
    }

    public function checkedAutoGenerateHST()
    {
        $this->autoGenerateHST = !$this->autoGenerateHST;

        if ($this->autoGenerateHST) {
            $this->hstGenerator();
        }
    }

    public function edit($scheduleId)
    {
        $this->scheduleId = $scheduleId;
        $schedule = Schedule::findOrFail($scheduleId);
        $this->hst = explode('-', trim($schedule->hst))[1];
        $this->type = $schedule->project_input_id;
        $this->date = $schedule->date->format('Y-m-d');
        $this->time = $schedule->time->format('H:i');
        $this->isEditing = true;
        $this->showCrudScheduleModal = true;
    }

    public function save()
    {
        // sleep(5);

        $validatedData = $this->validate();

        // Loop through the changes and save the new HST values
        foreach ($this->hstChanges as $change) {
            $hstRecord = Schedule::find($change['id']);
            if ($change['new_hst'] <= 0) {
                $hstRecord->delete();
            } else {
                $hstRecord->hst = 'HST-' . $change['new_hst'];
                $hstRecord->save();
            }
        }

        $this->hstChanges = [];

        if ($this->isEditing) {
            $schedule = Schedule::findOrFail($this->scheduleId);
            $schedule->update([
                'project_input_id' => $validatedData['type'],
                'hst' => 'HST-' . $validatedData['hst'],
                'date' => $validatedData['date'],
                'time' => $validatedData['time']
            ]);

            $this->isEditing = false;
            session()->flash('success', 'Schedule updated successfully!');
        } else {
            Schedule::create([
                'project_input_id' => $validatedData['type'],
                'hst' => 'HST-' . $validatedData['hst'],
                'date' => $validatedData['date'],
                'time' => $validatedData['time']
            ]);

            $this->reset(['hst', 'date', 'time', 'type']);
            session()->flash('success', 'New schedule has successfully created.');
        }

        $this->showCrudScheduleModal = false;
    }

    public function delete($scheduleId = null)
    {
        if ($scheduleId) {
            // Find and delete a single schedule
            $item = Schedule::findOrFail($scheduleId);
            $item->delete();
            session()->flash('success', 'Schedule deleted successfully!');
            return;
        }

        // If no scheduleId is passed, delete all schedules related to the project_id
        $deletedCount = Schedule::whereHas('projectInput', function ($query) {
            $query->where('project_id', $this->project_id);
        })->delete();

        // Check if any schedules were deleted
        if ($deletedCount > 0) {
            session()->flash('success', "$deletedCount schedules deleted successfully!");
        } else {
            session()->flash('warning', 'No schedules found for this project.');
        }
    }

    public function openCrudModal()
    {
        $this->showCrudScheduleModal = true;
        $this->dispatch('openModal', status: true);
    }

    public function closeCrudModal()
    {
        $this->hstChanges = [];
        $this->reset(['hst', 'date', 'time', 'type']);
        $this->isEditing = false;
        $this->showCrudScheduleModal = false;
        $this->dispatch('openModal', status: false);
    }
}
