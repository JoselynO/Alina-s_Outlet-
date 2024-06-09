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

    public function testStore(){
        $request = new Request();
        $request->name = 'BAGS';
        $categories = $this->categoriesController->create($request);
        $this->assertIsObject($categories);
    }

    public function testCreate(){
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get('/categories/create');
        $response->assertOk();
        $response->assertViewIs('categories.create');
    }

    public function testCreate_error(){
        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user)->get('/categories/create');
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function testEdit(){
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->make();
        $response = $this->actingAs($user)->post('/categories', $category->toArray());
        $response->assertRedirect('/categories');
    }

    public function testUpdate(){
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $categoryUpdate = ['name' => 'CLOTHES'];
        $response = $this->actingAs($user)->put('/categories/' . $category->id, $categoryUpdate);
        $response->assertRedirect('/categories');
    }

    public function testDestroy(){
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $response = $this->actingAs($user)->delete('/categories/' . $category->id);
        $response->assertRedirect('/categories');
    }

}
