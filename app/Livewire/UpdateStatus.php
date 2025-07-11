<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DeviceReceipt;

class UpdateStatus extends Component
{
    public $deviceReceipt;
    public $status;

    public function mount(DeviceReceipt $deviceReceipt)
    {
        $this->deviceReceipt = $deviceReceipt;
        $this->status = $deviceReceipt->status;
    }

    public function updateStatus()
    {
        $this->validate([
            'status' => 'required|in:pending,completed,rejected',
        ]);

        $this->deviceReceipt->update([
            'status' => $this->status,
        ]);

        session()->flash('message', 'تم!');
    }

    public function render()
    {
        return view('livewire.update-status');
    }
}
