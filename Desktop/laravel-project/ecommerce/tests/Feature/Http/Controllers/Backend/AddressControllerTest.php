<?php

namespace Tests\Feature\Http\Backend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Address;
use App\Models\User;

class AddressControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_page()
    {
        $response = $this->get('/users/2/addresses');

        $response->assertStatus(200);
    }
    public function test_index_url_goest_correct_view(){
        $response = $this->get('/users/2/addresses');

        $response->assertViewIs('backend.addresses.index');
    }
    public function test_address_create_form_page_status()
    {
        $response = $this->get('/users/2/addresses/create');

        $response->assertStatus(200);
    }
    public function test_address_url_goest_correct_view(){
        $response = $this->get('/users/2/addresses/create');

        $response->assertViewIs('backend.addresses.insert_form');
    }
    public function test_new_resource_is_created()
    {
        $data = [
            'user_id' => 2,
            'city' => 'Test City',
            'district' => 'Test District',
            'zipcode' => 12345,
            'address' => 'Test Address',
            "is_default" => 0,
            ];
        $response = $this->post('/users/2/addresses', $data);
        $response->assertRedirect('/users/2/addresses');

    }
    public function test_existing_resource_is_updated()
    {
        $entity = Address::all()->last();
        $entity->city = "Updated City" . $entity->city;
        $entity->district = "Updated District" . $entity->district;
        $data = $entity->toArray();
        $response = $this->put('/users/2/addresses/'.$entity->address_id, $data);
        $response->assertRedirect('/users/2/addresses');
    }
    public function test_new_resource_is_deleted()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $address = Address::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->delete("/users/{$user->id}/addresses/{$address->address_id}");

        $response->assertRedirect(route('backend.address.index'));
        $response->assertSessionHas('success', 'Adres başarıyla silindi.');

        $this->assertDatabaseMissing('addresses', [
            'address_id' => $address->address_id
        ]);
    }
}
