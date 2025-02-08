<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

#[Title("Pengaturan")]
class CompanyEdit extends Component
{
    use WithFileUploads;

    public $id, $company_name, $address, $telephone, $email, $website, $description, $old_logo, $new_logo;

    #[Validate('nullable|sometimes|image|max:1024')]
    public $company_logo;
    public function mount($id)
    {

        $company = Company::find($id);

        $this->company_name = $company->company_name;
        $this->address = $company->address;
        $this->telephone = $company->telephone;
        $this->email = $company->email;
        $this->website = $company->website;
        // $this->company_logo = $company->company_logo;
        $this->description = $company->description;
        $this->id = $company->id;
        $this->old_logo = $company->company_logo;
    }

    // #[Layout('template-dashboard.main')]
    public function render()
    {
        return view('livewire.company.company-edit');
    }


    public function update()
    {
        $this->validate();

        // gunakan gambar lama jika tidak mengubah gambar
        $new_logo = $this->old_logo;

        // jika ada logo baru
        if ($this->company_logo) {
            // hapus logo lama
            Storage::disk('public')->delete($this->old_logo);
            $new_logo = $this->company_logo->store('logo', 'public');
        }

        $company = [
            'company_name' => $this->company_name,
            'address' => $this->address,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'website' => $this->website,
            'company_logo' => $new_logo,
            'description' => $this->description,
        ];

        Company::find($this->id)->update($company);

        session()->flash('status', 'Data berhasil diedit!');
        $this->redirectRoute('company', navigate: true);
    }
}
