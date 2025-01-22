<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class AdminDashboard extends Component
{
    #[Layout("template-dashboard.main")]
    public function render()
    {
        return view('livewire.admin.admin-dashboard');
    }
}
