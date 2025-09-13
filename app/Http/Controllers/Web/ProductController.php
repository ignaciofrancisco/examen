<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(15);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|unique:products,sku',
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:255',
            'descripcion_larga' => 'required|string',
            'precio_neto' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'imagen' => 'required|image|max:2048',
        ]);

        $data = $request->all();
        $data['precio_venta'] = $data['precio_neto'] * 1.19;

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('products', 'public');
            $data['imagen'] = $path;
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success','Producto creado correctamente.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'sku' => 'required|unique:products,sku,'.$product->id,
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:255',
            'descripcion_larga' => 'required|string',
            'precio_neto' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['precio_venta'] = $data['precio_neto'] * 1.19;

        if ($request->hasFile('imagen')) {
            if ($product->imagen) {
                Storage::disk('public')->delete($product->imagen);
            }
            $path = $request->file('imagen')->store('products', 'public');
            $data['imagen'] = $path;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success','Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        if ($product->imagen) {
            Storage::disk('public')->delete($product->imagen);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success','Producto eliminado correctamente.');
    }
}
