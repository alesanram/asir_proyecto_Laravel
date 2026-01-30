<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    private function getCartId()
    {
        return session()->get('cart_id', session()->getId());
    }

    public function index(Request $request)
    {
        $cartId = $this->getCartId();
        $cart = session()->get($cartId, []);

        return view('cart', compact('cart'));
    }

    public function add($productId)
    {
        $product = Product::findOrFail($productId);

        if (! $product) {
            return redirect()->back()->with('error', 'No existe el producto.');
        }

        $cartId = $this->getCartId();
        $cart = session()->get($cartId, []);

        if ($product->stock == 0) {
            return redirect()->back()->with('error', 'No hay suficiente stock disponible para agregar más unidades de este producto.');
        }

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']+=1;
            $product->stock -= 1;
            $product->save();
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image,
                'stock' => $product->stock
            ];
            $product->stock -= 1;
            $product->save();
        }

        session()->put($cartId, $cart);

        return redirect()->back()->with('message', 'Producto agregado al carrito.');
    }

    public function remove($productId)
    {
        $cartId = $this->getCartId();
        $cart = session()->get($cartId, []);

        if (isset($cart[$productId])) {
            $product = Product::find($productId);
            if ($product) {
                if ($cart[$productId]['quantity'] > 1) {
                    $cart[$productId]['quantity']-=1;

                    $product->stock+=1;
                    $product->save();
                } else {
                    unset($cart[$productId]);

                    $product->stock++;
                    $product->save();
                }
            }

            session()->put($cartId, $cart);
        }

        return redirect()->route('cart')->with('message', 'Una unidad del producto ha sido eliminada del carrito y el stock ha sido actualizado.');
    }


    public function clear()
    {
        $cartId = $this->getCartId();
        $cart = session()->get($cartId, []);

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $product->stock += $item['quantity'];
                $product->save();
            }
        }

        // Vaciar el carrito
        session()->forget($cartId);

        return redirect()->route('cart')->with('message', 'Carrito vaciado y stock devuelto.');
    }


    public function end()
    {
        $cartId = $this->getCartId();
        session()->forget($cartId);

        return redirect()->route('cart')->with('message', 'Carrito vaciado.');
    }
}
