<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Permission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserListController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
       $user = User::get();
       return view('user.index', ['user' => $user]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = User::find($id);


          return view('user.edit', compact('user'));
      }
      /**
       * Update the specified resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function update(Request $request, $id)
      {
          $this->validate($request, [
              'name' => 'bail|required|min:2',
              'email' => 'required|email|unique:users,email,' . $id,

          ]);
          // Get the user
          $user = User::findOrFail($id);
          // Update user
          $user->fill($request->except( 'password'));
          // check for password change
          if($request->get('password')) {
              $user->password = bcrypt($request->get('password'));
          }
          // Handle the user roles
          $this->syncPermissions($request, $user);
          $user->save();
          flash()->success('User has been updated.');
          return redirect()->route('home');
      }
      /**
       * Remove the specified resource from storage.
       *
       * @param  int $id
       * @return \Illuminate\Http\Response
       * @internal param Request $request
       */
      public function destroy($id)
      {
          if ( Auth::user()->id == $id ) {
              flash()->warning('Deletion of currently logged in user is not allowed :(')->important();
              return redirect()->back();
          }
          if( User::findOrFail($id)->delete() ) {
              flash()->success('User has been deleted');
          } else {
              flash()->success('User not deleted');
          }
          return redirect()->back();
      }
      /**
       * Sync roles and permissions
       *
       * @param Request $request
       * @param $user
       * @return string
       */
      private function syncPermissions(Request $request, $user)
      {
          // Get the submitted roles
          $roles = $request->get('roles', []);
          $permissions = $request->get('permissions', []);
          // Get the roles
          $roles = Role::find($roles);
          // check for current role changes
          if( ! $user->hasAllRoles( $roles ) ) {
              // reset all direct permissions for user
              $user->permissions()->sync([]);
          } else {
              // handle permissions
              $user->syncPermissions($permissions);
          }
          $user->syncRoles($roles);
          return $user;
      }
  }
