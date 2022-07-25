<?php

namespace App\Http\Controllers;

use App\Models\AcademicUnitUser;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->id) {
            $response = User::select('name', 'id', 'surname', 'email')->where('id', '<>', $request->id)->get();
        } else {
            $response = null;
        }
        return $response;
    }

    public function updateUserAcademicUnits(Request $request)
    {
        $userAcademicUnits = AcademicUnitUser::all()
                ->where('user_id', $request->user_id);
        $db_academic_unit_ids = array_reduce(
            $userAcademicUnits->toArray(),
            fn ($current, $userAcademicUnit) => [...$current, $userAcademicUnit['academic_unit_id']],
            []
        );

        $AU_checked_not_in_db = []; // Add to db
        $AU_in_db_unchecked = []; // Delete from db

        if (!$request->academicUnits || count($request->academicUnits) == 0) {
            foreach ($userAcademicUnits as $userAcademicUnit) {
                $userAcademicUnit->delete();
            }
        } else {
            if (count($db_academic_unit_ids) == 0) {
                $AU_checked_not_in_db = $request->academicUnits;
            } else {
                $AU_checked_not_in_db = array_diff($request->academicUnits, $db_academic_unit_ids);
                $AU_in_db_unchecked = array_diff($db_academic_unit_ids, $request->academicUnits);
            }
        }

        foreach ($AU_checked_not_in_db as $checked) {
            $academicUnitUser = new AcademicUnitUser();
            // See the create_academic_unit_users_table migration file
            //   for details on setting user_id twice
            $academicUnitUser->id = $request->user_id;
            $academicUnitUser->user_id = $request->user_id;;
            $academicUnitUser->academic_unit_id = $checked;
            if ($academicUnitUser->save()) {
                UserRole::where('user_id', $request->user_id)->update(['role_id' => 3]);
            } else abort(500);
        }

        foreach ($AU_in_db_unchecked as $unchecked) {
            DB::table('academic_unit_users')->where('academic_unit_id', $unchecked)->delete();
        }

        return redirect('gestionar/usuarios');
    }
}
