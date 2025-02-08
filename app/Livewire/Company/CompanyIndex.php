<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title("Pengaturan")]
class CompanyIndex extends Component
{
    #[Layout('template-dashboard.main')]
    public function render()
    {
        $company = Company::first();

        return view('livewire.company.company-index', compact('company'));
    }
}
