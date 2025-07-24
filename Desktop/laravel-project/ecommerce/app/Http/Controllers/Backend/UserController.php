<?php

namespace App\Http\Controllers\Backend;
use App\Models\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(){
        $this->returnUrl ="/users";
    }
    public $returnUrl= "/users";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view("backend.users.index", ["users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.users.insert_form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
   public function store(UserRequest $request)
    {
    $name = $request->get("name");
    $email = $request->get("email");
    $password = $request->get("password");
    $is_admin = $request->input("is_admin", 0);
    $is_active = $request->has("is_active") ? 1 : 0;

    $user = new User();
    $user->name = $name;
    $user->email = $email;
    $user->password = Hash::make($password);
    $user->is_admin = $is_admin;
    $user->is_active = $is_active;

    $user->save();

    return Redirect::to($this->returnUrl);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
    // ID'ye göre kullanıcıyı bul
    $user = User::find($id);

    // Güncelleme formunu göster
    return view("backend.users.update_form",["user"=>$user]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);

    // Ensure that we properly retrieve the checkbox values
    $name = $request->get("name");
    $email = $request->get("email");
    $is_admin = $request->get('is_admin') ? 1 : 0; // Ensure the default value is 0 if unchecked
    $is_active = $request->get('is_active') ? 1 : 0; // Same for is_active

    // Update the user record
    $user->name = $name;
    $user->email = $email;
    $user->is_admin = $is_admin;
    $user->is_active = $is_active;

    // Save the updated record
    $user->save();

    return Redirect::to($this->returnUrl);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Kullanıcı başarıyla silindi.');
    }

    /**
     * Show the form for changing password.
     *
     * @return \Illuminate\Http\Response
     */
    public function passwordForm(User $user)
{
    return view('backend.users.password_form', compact('user'));
}

public function changePassword(User $user, UserRequest $request)
{
    $password = $request->get("password");
    $user->password = Hash::make($password);
    $user->save();
    return Redirect::to($this->returnUrl);
}

}
