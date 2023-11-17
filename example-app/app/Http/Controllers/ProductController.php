<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;


class ProductController extends Controller

    {
        public function index(){
            $product = DB::select('SELECT * FROM producto ');
            return view('Carrito.index',  ['cartItems' => $product]);
           
        }
    public function addToCart(Product $product, User $user)
    {
        // Obtenemos el producto desde la base de datos utilizando el ID del producto
        $product = Product::findOrFail($product);
    
        // Comprobamos si el producto ya está en el carrito
        $cart = session()->get('cart', []);
    
        if(isset($cart[$product->id])) {
            // Si el producto ya está en el carrito, actualizamos la cantidad
            $cart[$product->id]['quantity']++;
        } else {
            // Si el producto no está en el carrito, lo agregamos con una cantidad de 1
            $cart[$product->id] = [
                'name' => $product->nombre,
                'price' => $product->precio,
                'quantity' => 1,
            ];
        }
    
        // Guardamos el carrito en la sesión
        session()->put('cart', $cart);
    
        // Redirigimos al usuario de vuelta a la página de productos
        return redirect()->route('index');
    }
    }
    

