<?php

namespace Tests\Feature\Http\Controllers\Backend;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Generator;
use Illuminate\Container\Container;
use App\Models\User;
use Illuminate\Support\Str;

class ProductControllerTest  extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_products_index_page_status()
    {
        $response = $this->get('/products');

        $response->assertOk();
    }
    public function test_products_index_url_goes_to_correct_view(){
        $response = $this->get('/products');
        $response->assertViewIs('backend.products.index');
    }
    public function test_products_create_form_page_status(){
        $response = $this->get('/products/create');
        $response->assertOk();
    }
    public function test_products_create_form_goes_to_correct_view(){
        $response = $this->get('/products/create');
        $response->assertViewIs('backend.products.insert_form');

    }
    public function test_products_new_source_is_created(){
        $suffix = Str::random(5);
        $data = [
            'category_id' => 444,
            'name'=> "Yeni Ürünü - " . $suffix,
            'price' => 100.00,
            'lead'=> "Bu alan kısa acıklama için kullanılacak.",
            'old_price' => null,
        ];
        $response = $this->post('/products', $data);
        $response->assertRedirect('/products');


    }
    public function test_products_new_source_is_created_with_optional_fields(){

        $data = [
            'category_id' => 444,
            'name'=> "İndirimli Ürünü",
            'price' => 100.00,
            'old_price' => 123.85,
            "lead"=> "Bu alan kısa acıklama için kullanılacak.",

            ];
            $response = $this->post('/products', $data);
            $response->assertRedirect('/products');

    }
    public function test_products_existing_user_is_updated(){
        $entity =Product::all()->last();
        $entity->name = "Updated Name". $entity->name;
        $entity->slug = 'Email --- '. $entity->email;
        $data = $entity->toArray();
        $response = $this->put('/products/'.$entity->product_id, $data);
        $response->assertRedirect('/products');
    }
    public function test_products_new_source_is_deleted(){
        // Ensure there is at least one product to delete
        $entity = Product::all()->last();
        if (!$entity) {
            $entity = Product::create([
                'category_id' => 444,
                'name' => 'Test Product',
                'price' => 100.00,
                'lead' => 'This is a test product.',
                'old_price' => null,
            ]);
        }
        $response = $this->delete('/products/'.$entity->product_id);
        $response->assertRedirect('/products');

    }

}
