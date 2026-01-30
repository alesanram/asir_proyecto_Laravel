<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with('category');

        if ($request->filled('search') && $request->filled('filter_field')) {
            $field = $request->get('filter_field');
            $search = $request->get('search');

            if ($field === 'category') {
                $query->whereHas('category', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            } else {
                $query->where($field, 'like', "%{$search}%");
            }
        }

        $products = $query->paginate(15)->appends($request->query());

        return view('products.index', compact('products'));
    }

    public function indexPublic(Request $request)
    {
        $query = Product::query()->with('category');

        if ($request->filled('search') && $request->filled('filter_field')) {
            $field = $request->get('filter_field');
            $search = $request->get('search');

            if ($field === 'category') {
                $query->whereHas('category', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            } else {
                $query->where($field, 'like', "%{$search}%");
            }
        }

        $products = $query->paginate(8)->appends($request->query());

        return view('products.index_public', compact('products'));
    }

    public function indexLastFive()
    {
        $query = Product::with('category')->orderBy('id', 'desc');

        $products = $query->limit(8)->get();

        return view('client_welcome', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath,  // Guardar la ruta de la imagen
        ]);

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'  // El campo 'image' es opcional al editar
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath,  // Guardar la ruta de la imagen
        ]);

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index');
    }
}
