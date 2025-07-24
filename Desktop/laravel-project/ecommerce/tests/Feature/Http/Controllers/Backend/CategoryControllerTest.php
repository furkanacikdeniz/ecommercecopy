<?php

namespace Tests\Feature\Http\Controllers\Backend;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Generator;
use Illuminate\Container\Container;
use App\Models\User;

class CategoryControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_categories_index_page_status()
    {
        $response = $this->get('/categories');

        $response->assertOk();
    }
    public function test_categories_index_url_goes_to_correct_view(){
        $response = $this->get('/categories');
        $response->assertViewIs('backend.categories.index');
    }
    public function test_categories_create_form_page_status(){
        $response = $this->get('/categories/create');
        $response->assertOk();
    }
    public function test_categories_create_form_goes_to_correct_view(){
        $response = $this->get('/categories/create');
        $response->assertViewIs('backend.categories.insert_form');

    }
    public function test_categories_new_source_is_created(){

        $data = [
            'name'=> "Deneme Kategorisi",
            "slug"=> "Deneme Kategorisi",

            ];
            $response = $this->post('/categories', $data);
            $response->assertRedirect('/categories');

    }
    public function test_categories_existing_user_is_updated(){
        $entity =Category::all()->last();
        $entity->name = "Updated Name". $entity->name;
        $entity->slug = 'Email --- '. $entity->email;
        $data = $entity->toArray();
        $response = $this->put('/categories/'.$entity->category_id, $data);
        $response->assertRedirect('/categories');
    }
    public function test_categories_new_source_is_deleted(){
        // Ensure there is at least one category to delete
        $entity = Category::all()->last();
        if (!$entity) {
            $entity = Category::create([
                'name' => 'Test Category',
                'slug' => 'test-category'
            ]);
        }
        $response = $this->delete('/categories/'.$entity->category_id);
        $response->assertRedirect('/categories');

    }

}
