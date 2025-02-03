<?php

namespace App\Livewire\Setting;

use Livewire\Component;
use Livewire\Attributes\Layout;

class SettingIndex extends Component
{
    #[Layout('template-dashboard.main')]
    public function render()
    {
        return view('livewire.setting.setting-index');
    }
}
