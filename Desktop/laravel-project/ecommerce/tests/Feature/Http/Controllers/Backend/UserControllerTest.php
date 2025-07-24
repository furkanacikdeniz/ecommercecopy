<?php

namespace Tests\Feature\Http\Controllers\Backend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Generator;
use Illuminate\Container\Container;
use App\Models\User;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_users_index_page_status()
    {
        $response = $this->get('/users');

        $response->assertOk();
    }
    public function test_users_index_url_goes_to_correct_view(){
        $response = $this->get('/users');
        $response->assertViewIs('backend.users.index');
    }
    public function test_users_create_form_page_status(){
        $response = $this->get('/users/create');
        $response->assertOk();
    }
    public function test_users_create_form_goes_to_correct_view(){
        $response = $this->get('/users/create');
        $response->assertViewIs('backend.users.insert_form');

    }
    public function test_users_new_source_is_created(){
        $generator = Container::getInstance()->make(Generator::class);
        $data = [
            'name'=> $generator->name,
            'email'=> $generator->email,
            'password'=>'12345',
            'password_confirmation'=>'12345',
            'is_admin'=>$generator->boolean,
            'is_active'=> $generator->boolean
            ];
            $response = $this->post('/users', $data);
            $response->assertRedirect('/users');

    }
    public function test_users_existing_user_is_updated(){
        $user =User::all()->first();
        $user->name = "Updated Name". $user->name;
        $user->email = 'Email --- '. $user->email;
        $data = $user->toArray();
        $response = $this->put('/users/'.$user->id, $data);
        $response->assertRedirect('/users');
    }
}
