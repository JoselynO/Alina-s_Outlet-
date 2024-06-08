<?php

namespace Tests\Feature;

use App\Http\Controllers\ProductsController;
use App\Models\Category;
use App\Models\Funko;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class FunkosControllerTest extends TestCase{
    use RefreshDatabase;

    private $funkoController;

    public function setUp(): void{
        parent::setUp();
        $this->funkoController = new ProductsController();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');

    }

    public function testIndex(){
        $request = new Request();
        $request->search = null;
        $funkos = $this->funkoController->index($request);
        $this->assertIsObject($funkos);
    }

    public function testCreate()
    {
        $usuario = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($usuario)->get('/funkos/create');
        $response->assertOk();
        $response->assertViewIs('funkos.create');
    }

    public function testEdit(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $funko = Funko::factory()->create();
        $response = $this->actingAs($usuario)->get('/funkos/' . $funko->id  . '/edit', $funko->toArray());
        $response->assertViewIs('funkos.edit');
        $response->assertViewHas('funko', $funko);
    }

    public function testDestroy(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $funko = Funko::factory()->create();
        $response = $this->actingAs($usuario)->delete('/funkos/' . $funko->id);
        $response->assertRedirect('/funkos');
    }

    public function testUpdate(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $funko = Funko::factory()->create();
        $funkoActualizada = ['nombre' => 'Nombre nuevo',
        'precio' => 13.99, 'cantidad' => 5, 'categoria_id' => $funko->categoria_id];
        $response = $this->actingAs($usuario)->put('/funkos/' . $funko->id, $funkoActualizada);
        $this->assertIsObject($funko);
    }

}

