<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;
use Livewire\Attributes\Layout;

class CompanyIndex extends Component
{
    #[Layout('template-dashboard.main')]
    public function render()
    {
        $company = Company::first();

        return view('livewire.company.company-index', compact('company'));
    }
}
