<?php

namespace Tests\Feature\Http\Backend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ProductImage;
use App\Models\User;

class ProductImageControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_page()
    {
        $response = $this->get('/products/3/images');

        $response->assertStatus(200);
    }
    public function test_index_url_goest_correct_view(){
        $response = $this->get('/products/3/images');

        $response->assertViewIs('backend.images.index');
    }
    public function test_address_create_form_page_status()
    {
        $response = $this->get('/products/3/images/create');

        $response->assertStatus(200);
    }
    public function test_address_url_goest_correct_view(){
        $response = $this->get('/products/3/images/create');

        $response->assertViewIs('backend.images.insert_form');
    }
    public function test_new_resource_is_created()
    {
        $data = [
            'product_id' => 1,
            'image' => 'https://example.com/image.jpg',
            ];
        $response = $this->post('/products/3/images', $data);
        $response->assertRedirect('/products/3/images');

    }
    public function test_existing_resource_is_updated()
    {
        $entity = ProductImage::all()->last();
        $entity->alt = "EDITED: " . $entity->alt;
        $id= $entity->image_id;
        $data = $entity->toArray();
        $response = $this->put('/products/1/images/'.$id, $data);
        $response->assertRedirect('/products/1/images');
    }
    public function test_new_resource_is_deleted()
    {
        $entity = ProductImage::all()->last();
        $id= $entity->image_id;
        $response = $this->delete('/products/1/images/'.$id);
        $response->assertJson([
            'id' => $id,
            'message' => 'Product image deleted successfully.'
        ]);
    }
}
