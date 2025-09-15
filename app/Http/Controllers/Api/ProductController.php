<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProductController extends Controller
{
    // Listar productos con paginación
    public function index()
    {
        try {
            $products = Product::paginate(15);
            return response()->json(['success' => true, 'data' => $products], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al listar productos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Crear producto
    public function store(StoreProductRequest $request)
    {
        try {
            $data = $request->validated();

            // manejar imagen si existe
            if ($request->hasFile('imagen')) {
                $path = $request->file('imagen')->store('products', 'public');
                $data['imagen_url'] = asset('storage/' . $path);
            }

            $product = Product::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Producto creado',
                'data' => $product
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear producto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Mostrar producto
    public function show(Product $product)
    {
        try {
            return response()->json(['success' => true, 'data' => $product], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener producto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Actualizar producto
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('imagen')) {
                // eliminar imagen anterior si existe
                try {
                    $oldUrl = $product->imagen_url;
                    if ($oldUrl && str_contains($oldUrl, '/storage/')) {
                        $oldPath = str_replace(asset('storage/'), '', $oldUrl);
                        Storage::disk('public')->delete($oldPath);
                    }
                } catch (\Throwable $e) {
                    // no bloquear si falla el borrado
                }

                $path = $request->file('imagen')->store('products', 'public');
                $data['imagen_url'] = asset('storage/' . $path);
            }

            $product->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Producto actualizado',
                'data' => $product
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar producto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Eliminar producto
    public function destroy(Product $product)
    {
        try {
            // eliminar imagen si corresponde
            try {
                $oldUrl = $product->imagen_url;
                if ($oldUrl && str_contains($oldUrl, '/storage/')) {
                    $oldPath = str_replace(asset('storage/'), '', $oldUrl);
                    Storage::disk('public')->delete($oldPath);
                }
            } catch (\Throwable $e) {
                // ignorar error de borrado
            }

            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Producto eliminado'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar producto',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
