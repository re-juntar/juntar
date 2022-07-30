<?php

namespace App\Http\Livewire;

use App\Models\AcademicUnit;
use App\Models\AcademicUnitUser;
use Livewire\Component;
use App\Models\User;

class AddUserAcademicUnitModal extends Component
{
    public $open = false;
    public $user;
    public $userAcademicUnits;

    protected $listeners = ['showAddUserAcademicUnitModal'];

    public function render()
    {
        


        $academicUnits = AcademicUnit::all();
        return view('livewire.add-user-academic-unit-modal', ['user' => $this->user, 'academicUnits' => $academicUnits, 'userAcademicUnits' => $this->userAcademicUnits]);
    }

    public function showAddUserAcademicUnitModal(User $user) {
        $this->reset(['userAcademicUnits', 'user']);
        if (isset($user->id) && is_null($this->userAcademicUnits) ) {
            $userAcademicUnits = AcademicUnitUser::all()
                ->where('user_id', $user->id);

            $this->userAcademicUnits = $userAcademicUnits;
        }

        $this->user = $user;
        $this->open = true;
    }
}
