<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\UserSetting;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.my-layouts.layout')]
class Setting extends Component
{
    public $user;
    public $tab = 1;
    public $sensorNotifications = [];

    public function mount(User $user)
    {
        $this->user = $user;

        // Load the initial sensor notifications from the user's settings
        $settings = $this->user->settings()->where('name', 'sensor_notification')->first();
        $this->sensorNotifications = json_decode($settings->pivot->value, true);
    }

    public function updatedTab($value)
    {
        $this->tab = (int) $value; // Cast the tab value to integer
    }

    public function updateStatus($index)
    {
        try {
            // Convert the updated sensor notifications to JSON format
            $updatedValue = json_encode($this->sensorNotifications);
    
            // Find the setting_id for 'sensor_notification'
            $settingId = $this->user->settings()->where('name', 'sensor_notification')->first()->id;
    
            // Find the UserSetting record for the current user and setting_id
            $userSetting = UserSetting::where('user_id', $this->user->id)
                ->where('setting_id', $settingId)
                ->first();
    
            // Update the value field directly in UserSetting table
            if ($userSetting) {
                $userSetting->value = $updatedValue;
                $userSetting->save();
    
                // Display success message if update is successful
                session()->flash('success', $this->sensorNotifications[$index]['name'] . ' has successfully ' . ($this->sensorNotifications[$index]['status'] ? 'turned on.' : 'turned off.'));
            }
        } catch (\Exception $e) {
            // If an error occurs, revert the status change
            $this->sensorNotifications[$index]['status'] = !$this->sensorNotifications[$index]['status'];
            
            // Display error message to the user
            session()->flash('warning', 'Failed to update ' . $this->sensorNotifications[$index]['name'] . '. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.setting', [
            'sensorNotifications' => $this->sensorNotifications
        ]);
    }
}
