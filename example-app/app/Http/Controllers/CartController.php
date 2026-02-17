<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;
use Cart;

class CartController extends Controller
{
    public function shop()
    {
        $productos = Producto::all();
        return view('shop')->withTitle('E-COMMERCE STORE | SHOP')->with(['productos' => $productos]);
    }

    public function cart()  {
        $cartCollection = Cart::getContent();
        return view('Carrito.cart')->withTitle('E-COMMERCE STORE | CART')->with(['cartCollection' => $cartCollection]);
    }

    public function remove(Request $request){
        Cart::remove($request->id);
       
        return redirect()->route('cart.list')->with('success_msg', 'Producto eliminado!');
    }

    public function add(Request $request){
        Cart::add(array(
            'id' => $request->id,
            'name' => $request->nombre,
            'price' => $request->precio,
            'qty'      => $request->quantity ?? 1, 
            'quantity' => $request->quantity,
            'weight'   => 0,
             'attributes' => array (
            'image' => $request->img 
             )
        ));
        return redirect()->route('cart.list')->with('success_msg', '¡Item Agregado a su Carrito!');
    }

    public function update(Request $request){
        Cart::update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity
            ),
        ));
        return redirect()->route('cart.list')->with('success_msg', 'El carrito está actualizado!');
    }

    public function checkout() {
    $cartCollection = \Cart::getContent();
    
    if (\Cart::getTotalQuantity() == 0) {
        return redirect()->route('productos.index')->with('success_msg', 'Tu carrito está vacío');
    }

    return view('Carrito.checkout', compact('cartCollection'));
}

  public function processOrder(Request $request) {
    try {
        $user = \Auth::user();


        
        $persona = \DB::table('personas')->where('user_id', $user->id)->first();
        if (!$persona) {
            return "Error: El usuario no tiene una Persona asociada en la tabla 'persona'";
        }

        $cliente = \DB::table('clientes')->where('persona_id', $persona->id)->first();
        if (!$cliente) {
            return "Error: La persona no está registrada como Cliente en la tabla 'cliente'";
        }

        $cartCollection = \Cart::getContent();
        if ($cartCollection->isEmpty()) {
            return "Error: El carrito está vacío antes de guardar";
        }

        foreach($cartCollection as $item) {
            \App\Models\Pedido::create([
                'user_id'     => $user->id,
                'cliente_id'  => $cliente->id,
                'producto_id' => $item->id,
                'vendedor_id' => 1,
                'fecha'       => now(),
                'cantidad'    => $item->quantity,
                'total'       => $item->price * $item->quantity,
            ]);
        }

        \Cart::clear();

        return redirect()->route('pedidos.index')->with('success_msg', '¡Pedido guardado!');

    } catch (\Exception $e) {
       
        return "Error crítico: " . $e->getMessage();
    }
}
    public function clear(){
        Cart::clear();
        return redirect()->route('cart.list')->with('success_msg', 'El carrito está vacío!');
    }
}
