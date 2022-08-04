<?php

namespace Database\Seeders;

use App\Http\Controllers\UserRoleController;
use App\Models\Role;
use App\Models\EventStatus;
use App\Models\AcademicUnit;
use App\Models\EventCategory;
use App\Models\EventModality;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /******************************ACACEMIC-UNIT******************************************/
        $academicUnit1 = new AcademicUnit();
        $academicUnit1->name = 'Facultad de Informatica';
        $academicUnit1->short_name = 'FAI';
        $academicUnit1->image_logo = 'logoFAI.png';
        $academicUnit1->save();

        $academicUnit2 = new AcademicUnit();
        $academicUnit2->name = 'Facultad de Economia y Administración';
        $academicUnit2->short_name = 'FAEA';
        $academicUnit2->save();

        $academicUnit3 = new AcademicUnit();
        $academicUnit3->name = 'Facultad de Ingeniería';
        $academicUnit3->short_name = 'FAIN';
        $academicUnit3->image_logo = 'logoFAIN.png';
        $academicUnit3->save();

        $academicUnit4 = new AcademicUnit();
        $academicUnit4->name = 'Facultad de Humanidades';
        $academicUnit4->short_name = 'FAHU';
        $academicUnit4->save();

        $academicUnit5 = new AcademicUnit();
        $academicUnit5->name = 'Facultad de Ciencias del Ambiente y la Salud';
        $academicUnit5->short_name = 'FACIAS';
        $academicUnit5->image_logo = 'logoFACIAS.png';
        $academicUnit5->save();

        $academicUnit6 = new AcademicUnit();
        $academicUnit6->name = 'Facultad de Turismo';
        $academicUnit6->short_name = 'FATU';
        $academicUnit6->save();
        /*******************************ROLES******************************************/
        $role1 = new Role();
        $role1->name = 'super_user';
        $role1->description = 'Has overall system management';
        $role1->save();

        $role2 = new Role();
        $role2->name = 'admin';
        $role2->description = 'Has partial system management';
        $role2->save();

        $role3 = new Role();
        $role3->name = 'validator';
        $role3->description = 'Has access only to event endorsement requests';
        $role3->save();

        $role4 = new Role();
        $role4->name = 'common_user';
        $role4->description = 'Has access only to frontend application';
        $role4->save();
        /*******************************STATUS******************************************/
        $status1 = new EventStatus();
        $status1->description = 'Activo';
        $status1->save();

        $status2 = new EventStatus();
        $status2->description = 'Deshabilitado';
        $status2->save();

        $status3 = new EventStatus();
        $status3->description = 'Finalizado';
        $status3->save();

        $status4 = new EventStatus();
        $status4->description = 'Borrador';
        $status4->save();
        /**********************************MODALITY*************************************/
        $modality1 = new EventModality();
        $modality1->description = 'Presencial';
        $modality1->save();

        $modality2 = new EventModality();
        $modality2->description = 'Online';
        $modality2->save();

        $modality3 = new EventModality();
        $modality3->description = 'Hibrido';
        $modality3->save();

        $modality4 = new EventModality();
        $modality4->description = 'Otra';
        $modality4->save();
        /******************************CATEGORY******************************************/
        $category1 = new EventCategory();
        $category1->description = 'Seminario';
        $category1->save();

        $category2 = new EventCategory();
        $category2->description = 'Congreso';
        $category2->save();

        $category3 = new EventCategory();
        $category3->description = 'Diplomatura';
        $category3->save();

        $category4 = new EventCategory();
        $category4->description = 'Taller';
        $category4->save();

        $category5 = new EventCategory();
        $category5->description = 'Curso';
        $category5->save();

        $category6 = new EventCategory();
        $category6->description = 'Otra';
        $category6->save();

        /******************************USER******************************************/
        $user = new User();
        $user->name = 'Arif';
        $user->surname = 'Lucero';
        $user->dni = 30123123;
        $user->country = 'Argentina';
        $user->province = 'Neuquen';
        $user->city = 'Neuquen';
        $user->email = 'test@test.com';
        $user->password = '$2y$10$3ZpoQdlYW4VO/yMK0rF9z.jpN4BoFRBO4sEPMc2qkmzjXp9eOVZA6'; // 12345678
        $user->save();

        $userRoleController = new UserRoleController();
        $userRoleController->store(User::max('id'));

        $user = new User();
        $user->name = 'Nicolas';
        $user->surname = 'Krueger';
        $user->dni = 30123125;
        $user->country = 'Argentina';
        $user->province = 'Neuquen';
        $user->city = 'Neuquen';
        $user->email = 'test2@test.com';
        $user->password = '$2y$10$3ZpoQdlYW4VO/yMK0rF9z.jpN4BoFRBO4sEPMc2qkmzjXp9eOVZA6'; // 12345678
        $user->save();

        $userRoleController = new UserRoleController();
        $userRoleController->store(User::max('id'));

        $user = new User();
        $user->name = 'Jordan';
        $user->surname = 'Butler';
        $user->dni = 30123124;
        $user->country = 'Argentina';
        $user->province = 'Neuquen';
        $user->city = 'Neuquen';
        $user->email = 'test3@test.com';
        $user->password = '$2y$10$3ZpoQdlYW4VO/yMK0rF9z.jpN4BoFRBO4sEPMc2qkmzjXp9eOVZA6'; // 12345678
        $user->save();

        $userRoleController = new UserRoleController();
        $userRoleController->store(User::max('id'));
    }
}
