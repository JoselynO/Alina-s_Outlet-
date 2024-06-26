<?php


use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsControllerTest extends TestCase{

    use RefreshDatabase;
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
    }

    public function test_index() {
        $response = $this->get('/products');
        $response->assertViewIs('products.index');
        $response->assertViewHas('products');
        $response->assertStatus(200);
    }

    public function test_index_search_gucci() {
        $response = $this->get('/products?search=gucci');
        $response->viewData('products')->each(function ($product) {
            $this->assertStringContainsString('gucci', strtolower($product->name));
        });
        $response->assertViewIs('products.index');
        $response->assertViewHas('products');
        $response->assertStatus(200);
    }

    public function test_index_filter_watches() {
        $response = $this->get('/products?category=4');
        $response->viewData('products')->each(function ($product) {
            $this->assertStringContainsString('watches', strtolower($product->category->name));
        });
        $response->assertViewIs('products.index');
        $response->assertViewHas('products');
        $response->assertStatus(200);
    }

    public function test_show_view(){
        $product = Product::first();
        $response = $this->get(route('products.show', $product->id));
        $response->assertStatus(200);
        $response->assertViewIs('products.show');
        $response->assertViewHas('product', $product);
    }

    public function test_create_view_admin(){
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get('/products/create');
        $response->assertViewIs('products.create');
        $response->assertStatus(200);
    }

    public function test_create_view_user(){
        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user)->get('/products/create');
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function test_create_view_guest(){
        $response = $this->get('/products/create');
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }

    public function test_update_view_admin(){
        $user = User::factory()->create(['role' => 'admin']);
        $product = Product::first();
        $response = $this->actingAs($user)->get('/products/' . $product->id . '/edit', $product->toArray());
        $response->assertViewIs('products.edit');
        $response->assertStatus(200);
    }

    public function test_update_view_user(){
        $user = User::factory()->create(['role' => 'user']);
        $product = Product::first();
        $response = $this->actingAs($user)->get('/products/1/edit', $product->toArray());
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function test_update_view_guest(){
        $product = Product::first();
        $response = $this->get('/products/1/edit', $product->toArray());
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }


    public function test_update_image_view_user(){
        $user = User::factory()->create(['role' => 'user']);
        $product = Product::first();
        $response = $this->actingAs($user)->get('/products/1/edit-image', $product->toArray());
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function test_update_image_view_guest(){
        $product = Product::first();
        $response = $this->get('/products/1/edit-image', $product->toArray());
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }


    public function test_delete_user(){
        $user = User::factory()->create(['role' => 'user']);
        $product = Product::first();
        $response = $this->actingAs($user)->delete('/products/' . $product->id, $product->toArray());
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function test_delete_guest(){
        $product = Product::first();
        $response = $this->delete('/products/' . $product->id, $product->toArray());
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }

}
