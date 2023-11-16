<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CartController extends Controller
{
    public function shop()
    {
        $productos = Producto::all();
       dd($productos);
        return view('shop')->withTitle('E-COMMERCE STORE | SHOP')->with(['productos' => $productos]);
    }

    public function cart()  {
        $cartCollection = \Cart::getContent();
        //dd($cartCollection);
        return view('cart')->withTitle('E-COMMERCE STORE | CART')->with(['cartCollection' => $cartCollection]);;
    }
    public function remove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('cart.blade')->with('success_msg', 'Item is removed!');
    }

    public function add(Request$request){
        \Cart::add(array(
            'id' => $request->id,
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->img,
                 
            )
        ));
        return redirect()->route('cart.blade')->with('success_msg', 'Item Agregado a sú Carrito!');
    }

    public function update(Request $request){
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
        ));
        return redirect()->route('cart.blade')->with('success_msg', 'El carrito está actualizado.!');
    }

    public function clear(){
        \Cart::clear();
        return redirect()->route('cart.blade')->with('success_msg', 'El carrito esta vacio!');
    }

 

}
