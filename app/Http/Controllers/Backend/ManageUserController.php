<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function users(UserDataTable $dataTable){

        $role = "user";
        $user = "Users";
        $route = 'admin.users.list';
        $dataTable->setRole($role);
        return $dataTable->render('admin.manageUsers.usersList', compact('user', 'route'));
    }

    public function admins(UserDataTable $dataTable){

        $role = "admin";
        $user = "Admins";
        $route = 'admin.admins.list';
        $dataTable->setRole($role);
        return $dataTable->render('admin.manageUsers.usersList', compact('user', 'route'));
    }
    public function guests(UserDataTable $dataTable){

        $role = "guest";
        $user = "Guests";
        $route = 'admin.guests.list';
        $dataTable->setRole($role);
        return $dataTable->render('admin.manageUsers.usersList', compact('user', 'route'));
    }

    public function changeStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status == 'true' ? 'active' : 'inactive';
        $user->save();
        
        return response(['message' => 'Status has been updated!']);
    }
    public function changeRole(Request $request)
    {
        if($request->id != 1){
            $user = User::findOrFail($request->id);
            if($user->role == 'admin'){
                $user->role = 'user';
            }elseif($user->role == 'user'){
                $user->role = 'admin';
            }
            $user->save();
            return response(['status'=> 'success', 'message' => 'Role Updated Successfully']);
        }
        return response(['status'=> 'error', 'message' => 'Super Admin can&rsquo;t be Modified']);
    }

    public function destroy(string $id)
    {   
        $user = User::findOrFail($id);
        $user->delete();
    
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
