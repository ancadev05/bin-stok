<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title("Akun")]
class UserIndex extends Component
{
    // #[Layout('template-dashboard.main')]
    public function render()
    {
        $users = User::all();
        return view('livewire.user.user-index', compact('users'));
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        session()->flash('status','Data berhasil dihapus!');
    }
}
