<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

#[Title("Akun")]
class UserCreate extends Component
{
    #[Validate('required', message: 'Kolom wajib diisi!')]
    public $name, $email, $password;

    public function store()
    {
        $this->validate();
        
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'roles' => 2,
        ]);

        session()->flash('status','Data berhasil ditambahkan!');
        $this->redirectRoute('users', navigate:'true');
    }

    #[Layout('template-dashboard.main')]
    public function render()
    {
        return view('livewire.user.user-create');
    }
}
