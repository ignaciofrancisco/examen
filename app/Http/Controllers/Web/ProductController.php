<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Listar productos con búsqueda
    public function index(Request $request)
    {
        try {
            $products = Product::query()
                ->when($request->search, function($q, $search) {
                    $q->where('sku', 'like', "%{$search}%")
                      ->orWhere('nombre', 'like', "%{$search}%");
                })
                ->orderBy('id', 'desc')
                ->paginate(15);

            return view('products.index', compact('products'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar los productos: ' . $e->getMessage());
        }
    }

    // Formulario crear producto
    public function create()
    {
        return view('products.create');
    }

    // Guardar producto
    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|string|max:100|unique:products,sku',
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:255',
            'descripcion_larga' => 'required|string',
            'precio_neto' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'nullable|integer|min:0',
            'stock_alto' => 'nullable|integer|min:0',
            'imagen' => 'nullable|image|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $product = new Product($request->only([
                'sku','nombre','descripcion_corta','descripcion_larga',
                'precio_neto','stock_actual','stock_minimo','stock_bajo','stock_alto'
            ]));

            $product->precio_venta = round($product->precio_neto * 1.19, 2);

            if ($request->hasFile('imagen')) {
                $path = $request->file('imagen')->store('products', 'public');
                $product->imagen = $path;
            }

            $product->save();
            DB::commit();

            return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error al crear el producto: ' . $e->getMessage());
        }
    }

    // Formulario editar producto
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Actualizar producto
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:255',
            'descripcion_larga' => 'required|string',
            'precio_neto' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'nullable|integer|min:0',
            'stock_alto' => 'nullable|integer|min:0',
            'imagen' => 'nullable|image|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->only([
                'sku','nombre','descripcion_corta','descripcion_larga',
                'precio_neto','stock_actual','stock_minimo','stock_bajo','stock_alto'
            ]);

            $data['precio_venta'] = round($data['precio_neto'] * 1.19, 2);

            if ($request->hasFile('imagen')) {
                if ($product->imagen) {
                    Storage::disk('public')->delete($product->imagen);
                }
                $path = $request->file('imagen')->store('products', 'public');
                $data['imagen'] = $path;
            }

            $product->update($data);
            DB::commit();

            return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error al actualizar el producto: ' . $e->getMessage());
        }
    }

    // Eliminar producto
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            if ($product->imagen) {
                Storage::disk('public')->delete($product->imagen);
            }

            $product->delete();
            DB::commit();

            return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al eliminar el producto: ' . $e->getMessage());
        }
    }
}
