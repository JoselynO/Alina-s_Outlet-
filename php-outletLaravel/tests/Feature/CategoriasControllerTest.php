<?php

namespace Tests\Feature;

use App\Http\Controllers\CategoriesController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class CategoriasControllerTest extends TestCase
{
    use RefreshDatabase;

    private $categoriaController;

    public function setUp(): void
    {
        parent::setUp();
        $this->categoriaController = new CategoriesController();
    }

    public function testIndex(){
        $request = new Request();
        $request->search = null;
        $categorias = $this->categoriaController->index($request);
        $this->assertIsObject($categorias);
    }

    public function testStore(){
        $request = new Request();
        $request->nombre = 'Category 1';
        $categoria = $this->categoriaController->create($request);
        $this->assertIsObject($categoria);
    }

    public function testCreate(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($usuario)->get('/categorias/create');
        $response->assertOk();
        $response->assertViewIs('categorias.create');
    }

    public function testCreate_error(){
        $usuario = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($usuario)->get('/categorias/create');
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function testEdit(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $categoria = Category::factory()->make();
        $response = $this->actingAs($usuario)->post('/categorias', $categoria->toArray());
        $response->assertRedirect('/categorias');
    }

    public function testUpdate(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $categoria = Category::factory()->create();
        $categoriaActualizada = ['nombre' => 'Nombre nuevo'];
        $response = $this->actingAs($usuario)->put('/categorias/' . $categoria->id, $categoriaActualizada);
        $response->assertRedirect('/categorias');
    }

    public function testDestroy(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $categoria = Category::factory()->create();
        $response = $this->actingAs($usuario)->delete('/categorias/' . $categoria->id);
        $response->assertRedirect('/categorias');
    }

}
