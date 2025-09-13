<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::paginate(15));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        // manejar imagen
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('products', 'public');
            $data['imagen_url'] = asset('storage/' . $path);
        }

        $product = Product::create($data);

        return response()->json(['message' => 'Producto creado', 'data' => $product], 201);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            // eliminar imagen anterior si existe (opcional: solo si es storage local)
            try {
                $oldUrl = $product->imagen_url;
                if ($oldUrl && str_contains($oldUrl, '/storage/')) {
                    $oldPath = str_replace(asset('storage/'), '', $oldUrl);
                    Storage::disk('public')->delete($oldPath);
                }
            } catch (\Throwable $e) {
                // no bloquear si falla borrado
            }

            $path = $request->file('imagen')->store('products', 'public');
            $data['imagen_url'] = asset('storage/' . $path);
        }

        $product->update($data);
        return response()->json(['message' => 'Producto actualizado', 'data' => $product]);
    }

    public function destroy(Product $product)
    {
        // eliminar imagen si corresponde
        try {
            $oldUrl = $product->imagen_url;
            if ($oldUrl && str_contains($oldUrl, '/storage/')) {
                $oldPath = str_replace(asset('storage/'), '', $oldUrl);
                Storage::disk('public')->delete($oldPath);
            }
        } catch (\Throwable $e) {}

        $product->delete();
        return response()->json(['message' => 'Producto eliminado']);
    }
}
