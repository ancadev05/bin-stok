<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

#[Title("Akun")]
class UserEdit extends Component
{
    #[Validate('required', message: 'Kolom wajib diisi!')]
    public $name, $email, $password;
    public $id;
    public function mount($id)
    {
        $user = User::find($id);

        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->id = $id;
    }

    public function update()
    {
        $this->validate();

        // pembuatan password baru
        $user = User::find($this->id);
        if($user->password == $this->password) {
            User::find($this->id)->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
        } else {
            User::find($this->id)->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
        }

        session()->flash('status','Data berhasil diubah!');
        $this->redirectRoute('users', navigate:'true');
    }

    // #[Layout('template-dashboard.main')]
    public function render()
    {
        return view('livewire.user.user-edit');
    }
}
