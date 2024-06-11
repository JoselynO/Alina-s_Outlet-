<?php

namespace Tests\Feature;

use App\Http\Controllers\CategoriesController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class CategoriesControllerTest extends TestCase
{
    use RefreshDatabase;

    private $categoriesController;

    public function setUp(): void
    {
        parent::setUp();
        $this->categoriesController = new CategoriesController();
    }

    public function testIndex(){
        $request = new Request();
        $request->search = null;
        $categories = $this->categoriesController->index($request);
        $this->assertIsObject($categories);
    }

    public function testIndex_search_watches(){
        $request = new Request();
        $request->search = "watches";
        $categories = $this->categoriesController->index($request);
        $this->assertIsObject($categories);

        foreach ($categories as $category) {
            $this->assertStringContainsString('watches', strtolower($category->name));
        }
    }

    public function testIndex_view_admin(){
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get('/categories');
        $response->assertOk();
        $response->assertViewIs('categories.index');
        $response->assertViewHas('categories');
    }

    public function testIndex_view_user(){
        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user)->get('/categories');
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function testIndex_view_guest(){
        $response = $this->get('/categories');
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }

    public function testCreate_view_admin(){
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get('/categories/create');
        $response->assertOk();
        $response->assertViewIs('categories.create');
    }

    public function testCreate_view_user(){
        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user)->get('/categories/create');
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function testCreate_view_guest(){
        $response = $this->get('/categories/create');
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }

    public function testStore(){
        $request = new Request();
        $request->name = 'BAGS';
        $categories = $this->categoriesController->create($request);
        $this->assertIsObject($categories);
    }


    public function testStore_admin(){
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->post('/categories', ['name' => 'BAGS']);
        $response->assertRedirect('/categories');
    }

    public function testStore_user(){
        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user)->post('/categories', ['name' => 'BAGS']);
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function testStore_guest(){
        $response = $this->post('/categories', ['name' => 'BAGS']);
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }


    public function testEdit_view_user(){
        $user = User::factory()->create(['role' => 'user']);
        $category = Category::factory()->make();
        $response = $this->actingAs($user)->get('/categories/' . $category->id, $category->toArray());
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function testEdit_view_guest(){
        $category = Category::factory()->make();
        $response = $this->get('/categories/' . $category->id, $category->toArray());
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }

    public function testUpdate(){
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $categoryUpdate = ['name' => 'CLOTHES'];
        $response = $this->actingAs($user)->put('/categories/' . $category->id, $categoryUpdate);
        $response->assertRedirect('/categories');
    }

    public function testDestroy_admin(){
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $response = $this->actingAs($user)->delete('/categories/' . $category->id);
        $response->assertRedirect('/categories');
    }

    public function testDestroy_user(){
        $user = User::factory()->create(['role' => 'user']);
        $category = Category::factory()->create();
        $response = $this->actingAs($user)->delete('/categories/' . $category->id);
        $response->assertRedirect('/home');
        $response->assertStatus(302);
    }

    public function testDestroy_guest(){
        $category = Category::factory()->create();
        $response = $this->delete('/categories/' . $category->id);
        $response->assertRedirect('/login');
        $response->assertStatus(302);
    }

}
