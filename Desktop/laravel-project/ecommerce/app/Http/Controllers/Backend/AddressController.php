<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * The URL to redirect to after storing an address.
     *
     * @var string
     */
    public $returnUrl = '/backend/addresses';

    public function __invoke(){
    $user_id = request()->route('user'); // URL'deki {user} parametresini al
    $user = User::findOrFail($user_id); // User'ı veritabanından bul
    $addrs = $user->addrs; // Adres ilişkisini yükle

    return view('backend.addresses.index', [
        'user' => $user,
        'addrs' => $addrs
    ]);
}
    public function __construct(){
        $this->returnUrl = "/users/{}/addresses";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(User $user): View
    {
        $addrs = $user->addrs();
        return view("backend.addresses.index",[ "addrs"=> $addrs,"user"=> $user ]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user): View
    {
    return view("backend.addresses.insert_form", ["user"=> $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, AddressRequest $request):RedirectResponse
    {
        $user = User::findOrFail($user->user_id);
        $addr = new Address() ;
        $data =$this->prepare( $request, $addr ->getFillable() );
        $addr -> fill($data);
        $addr->fill($data);
        $addr->save();

        $this->editReturnUrl($user->user_id);
        return Redirect::to($this->returnUrl);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Address $address): View
    {
        return view("backend.addresses.update_form", ["user" => $user, "addr" => $address]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, User $user, Address $address): RedirectResponse
    {
        $data = $this->prepare($request, $address->getFillable());
        $address->fill($data);
        $address->save();
        $this->editReturnUrl($user->user_id);
        return Redirect::to($this->returnUrl);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user, Address $address): RedirectResponse
{
    $address->delete();

    return redirect()->back()->with('success', 'Kullanıcı başarıyla silindi.');
}
    private function editReturnUrl($id)
    {
        $this->returnUrl = "/users/$id/addresses";
    }
}
