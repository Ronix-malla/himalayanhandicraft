<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Category filter
        if ($request->filled('cat') && $request->cat !== 'all') {
            $query->where('category', $request->cat);
        }

        // Metal filter
        if ($request->filled('metal') && $request->metal !== 'all') {
            $query->where('metal_key', $request->metal);
        }

        // Search query
        if ($request->filled('q')) {
            $term = '%' . $request->q . '%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                  ->orWhere('description', 'like', $term)
                  ->orWhere('metal', 'like', $term);
            });
        }

        // Sorting
        $sort = $request->get('sort', 'featured');
        switch ($sort) {
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'featured':
            default:
                $query->orderBy('is_featured', 'desc')->orderBy('id', 'asc');
                break;
        }

        $products = $query->get();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($products);
        }

        $allProducts = Product::all();

        return view('products', [
            'products' => $products,
            'allProducts' => $allProducts,
            'activeCategory' => $request->get('cat', 'all'),
            'activeMetal' => $request->get('metal', 'all'),
            'searchQuery' => $request->get('q', ''),
            'currentSort' => $sort,
        ]);
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->orWhere('code', $id)->firstOrFail();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json($product);
        }

        return view('products.show', compact('product'));
    }

    public function apiList()
    {
        return response()->json(Product::all());
    }
}
