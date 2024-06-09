<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class CategpriesController
 *
 * La clase CategoriesController es responsable de manejar las operaciones relacionadas con las categorias.
 *
 * @package App\Http\Controllers
 * @author Joselyn Carolina Obando Fernandez <cariharvey@hotmail.com>
 */
class CategoriesController extends Controller{

    /**
     * Muestra una lista paginada de categorias.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP.
     * @return \Illuminate\View\View La vista que muestra la lista de categorias.
     */
    public function index(Request $request){
        $categories = Category::search($request->search)->orderBy('id', 'asc')->paginate(3);
        return view('categories.index')->with('categories', $categories);
    }

    /**
     * Muestra los detalles de una categoria especifica.
     *
     * @param int $id El ID de la categoria.
     * @return \Illuminate\View\View La vista que muestra los detalles de la categoria.
     */
    public function show($id){
        $category = $this->getCategory($id);
        Cache::put('category' . $id, $category, 300);
        return view('categories.show')->with('category', $category);
    }

    /**
     * Muestra el formulario para crear una nueva categoria.
     *
     * @return \Illuminate\View\View La vista del formulario de creacion de categorias.
     */
    public function create(){
        return view('categories.create');
    }

    /**
     * Almacena una nueva categoria en la base de datos.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene los datos de la categoria a crear.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de categorias despues de crear una nueva categoria.
     */
    public function store(Request $request){
        $request->validate([
            'name' => 'min:4|max:120|required|unique:categories,name',
        ]);
        try {
            $category = new Category();
            $category->name = strtoupper($request->name);
            $category->save();
            flash('Category ' . $category->name . ' successfully created.')->success()->important();
            return redirect()->route('categories.index');
        } catch (Exception $e) {
            flash('There is already another category with the same name')->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Muestra el formulario para editar una categoria existente.
     *
     * @param int $id El ID de la categoria a editar.
     * @return \Illuminate\View\View La vista del formulario de edicion de categorias.
     */
    public function edit($id){
        try {
            $category = $this->getCategory($id);
            if ($category && $id != 0) {
                Cache::put('category' . $id, $category, 300);
                return view('categories.edit')->with('category', $category);
            } else {
                flash('Invalid route')->error()->important();
                return redirect()->route('categories.index');
            }
        } catch (Exception $e) {
            flash('Invalid route')->error()->important();
            return redirect()->route('categories.index');
        }
    }

    /**
     * Actualiza una categoria existente en la base de datos.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene los datos actualizados de la categoria.
     * @param int $id El ID de la categoria a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de categorias despues de actualizar la categoria.
     */
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'min:4|max:120|required|unique:categories,name,' . $id,
        ]);
        try {
            $category = $this->getCategory($id);
            $category->name = strtoupper($request->name);
            $category->save();
            Cache::forget('category' . $id);
            flash('Category ' . $category->name . ' successfully updated')->success()->important();
            return redirect()->route('categories.index');
        } catch (Exception $e) {
            flash('There is already another category with the same name')->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Muestra el formulario para editar la imagen de una categoria existente.
     *
     * @param int $id El ID de la categoria cuya imagen se va a editar.
     * @return \Illuminate\View\View La vista del formulario de edicion de imagen de categorias.
     */
    public function editImage($id){
        try {
            $category = $this->getCategory($id);
            if ($category) {
                Cache::put('category' . $id, $category, 300);
                return view('categories.image')->with('category', $category);
            } else {
                flash('Invalid route')->error()->important();
                return redirect()->route('categories.index');
            }
        } catch (Exception $e) {
            flash('Invalid route')->error()->important();
            return redirect()->route('categories.index');
        }
    }


    /**
     * Actualiza la imagen de una categoria existente en la base de datos.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene la nueva imagen de la categoria.
     * @param int $id El ID de la categoria cuya imagen se va a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de categorias despues de actualizar la imagen.
     */
    public function updateImage(Request $request, $id){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            $category = $this->getCategory($id);
            if ($category->image != Category::$IMAGE_DEFAULT && Storage::exists('public/' . $category->image)) {
                Storage::delete('public/' . $category->image);
            }

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileToSave = Str::uuid() . '.' . $extension;
            $category->image = $image->storeAs('category', $fileToSave, 'public');
            $category->save();
            Cache::forget('category' . $id);
            flash('Category ' . $category->name . ' successfully updated')->warning()->important();
            return redirect()->route('categories.index');
        } catch (Exception $e) {
            flash('Error updating Category ' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Elimina una categoria existente de la base de datos.
     *
     * @param int $id El ID de la categoria que se va a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de categorias despues de eliminar la categoria.
     */
    public function destroy($id){
        if ($id != 1) {
            try {
                $category = $this->getCategory($id);
                $category->updateProductWithOutCategory($id);
                $category->delete();
                Cache::forget('category' . $id);
                flash('Category ' . $category->name . ' successfully removed')->success()->important();
                return redirect()->route('categories.index');
            } catch (Exception $e) {
                flash('Error when deleting Category' . $e->getMessage())->error()->important();
                return redirect()->back();
            }
        } else {
            flash('Invalid route')->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Recupera una categoria que fue marcada como eliminada en la base de datos.
     *
     * @param int $id El ID de la categoria que se va a recuperar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de categorias despues de recuperar la categoria.
     */
    public function recover($id){
        $category = $this->getCategory($id);
        $category->isDelete = false;
        $category->save();
        Cache::forget('category' . $id);
        return redirect()->route('categories.index');
    }

    /**
     * Obtiene una categoria de la cache si está disponible; de lo contrario, la recupera de la base de datos.
     *
     * @param int $id El ID de la categoria que se va a obtener.
     * @return \App\Models\Category|null La categoria recuperada de la cache o de la base de datos.
     */
    private function getCategory($id){
        return Cache::has('category' . $id) ? Cache::get('category' . $id) : Category::find($id);
    }
}
