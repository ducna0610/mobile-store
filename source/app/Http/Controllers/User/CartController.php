<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\CheckoutRequest;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use DB;

class CartController extends Controller
{

    public function addToCart(Product $product, AddToCartRequest $request)
    {
        try {
            preg_match('/[\d]+/', $request->get('disk'), $disk);
            $disk = $disk[0];

            preg_match('/[\d]+/', $request->get('ram'), $ram);
            $ram = $ram[0];

            $color = $request->get('color');
            $quantity = $request->get('quantity');

            $type = $product->types()
                ->where('disk', $disk)
                ->where('ram', $ram)
                ->where('color', $color)
                ->first();

            $data = (session('cart') ?? collect())->all();

            if (empty($data[$product->id][$type->id])) {
                $data[$product->id][$type->id]['quantity'] = $quantity;
            } else {
                $data[$product->id][$type->id]['quantity'] = $data[$product->id][$type->id]['quantity'] + $quantity;
            }

            $data[$product->id][$type->id]['product_id'] = $product->id;
            $data[$product->id][$type->id]['image'] = $product->image;
            $data[$product->id][$type->id]['name'] = $product->name;

            $data[$product->id][$type->id]['type_id'] = $type->id;
            $data[$product->id][$type->id]['disk'] = $type->disk;
            $data[$product->id][$type->id]['ram'] = $type->ram;
            $data[$product->id][$type->id]['color'] = $type->color;
            $data[$product->id][$type->id]['pin'] = $type->pin;
            $data[$product->id][$type->id]['chip'] = $type->chip;
            $data[$product->id][$type->id]['price'] = $type->price;

            session()->put('cart', collect($data));

            return 1;
        } catch (\Throwable $th) {
            //throw $th;
            return 0;
            // DB::rollBack();
            // dd($th);

            // return $this->errorResponse();
        }
    }

    public function updateQuantityInCart(Type $type)
    {

        try {
            DB::beginTransaction();

            $data = session('cart')->toArray();

            if (request()->get('type') == 'decre') {
                if ($data[$type->product()->first('id')->id][$type->id]['quantity'] > 1) {
                    $data[$type->product()->first('id')->id][$type->id]['quantity']--;
                } else {
                    unset($data[$type->product()->first('id')->id][$type->id]);
                }
            } else {
                $data[$type->product()->first('id')->id][$type->id]['quantity']++;
            }

            if (count($data[$type->product()->first('id')->id]) == 0) {
                unset($data[$type->product()->first('id')->id]);
            }

            session()->put('cart', collect($data));

            return 1;
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
            dd($th);

            // return $this->errorResponse();
        }
    }

    public function deleteItemCart(Type $type)
    {
        try {
            DB::beginTransaction();
            $data = session('cart')->toArray();

            unset($data[$type->product()->first('id')->id][$type->id]);

            if (count($data[$type->product()->first('id')->id]) == 0) {
                unset($data[$type->product()->first('id')->id]);
            }

            session()->put('cart', collect($data));

            return 1;
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
            dd($th);

            // return $this->errorResponse();
        }
    }

    public function showCart()
    {
        if ((session('cart') ?? collect())->isEmpty()) {
            session()->forget('cart');
        }
        return view('user.cart.index');
    }

    public function order()
    {
        $user = auth()->user();

        return view('user.cart.form_order', [
            'user' => $user,
        ]);
    }

    public function totalQuantity()
    {
        $quantity = 0;

        if (session('cart')) {
            $quantity = session('cart')->reduce(function ($carry, $item) {
                return $carry + collect($item)->sum('quantity');
            });
        }

        return $quantity;
    }

    public function checkout(CheckoutRequest $request)
    {
        try {
            DB::beginTransaction();

            $total_price = 0;
            foreach (session('cart') as $product) {
                foreach ($product as $item) {
                    $total_price += $item['quantity'] * $item['price'];
                }
            }

            $data = $request->validated();
            $data['total_price'] = $total_price;

            $user = auth()->user();

            if ($user->phone == null) {
                $user->phone = $data['phone_receiver'];
            }

            if ($user->address == null) {
                $user->address = $data['address_receiver'];
            }

            $user->save();

            $bill = $user->bills()->create($data);

            foreach (session('cart') as $product) {
                foreach ($product as $item) {
                    $bill_detail['quantity'] = $item['quantity'];
                    $bill_detail['price'] = $item['price'];

                    $bill->types()->attach($item['type_id'], $bill_detail);

                    $type = Type::find($item['type_id']);

                    if ($type->quantity < $item['quantity']) {
                        return back()->with('error', $item['name'] . ' vượt quá số lượng cho phép.');
                    }

                    $type->sold += $item['quantity'];
                    $type->quantity -= $item['quantity'];
                    $type->save();
                }
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('bills.showBill')->with('success', 'Đặt hàng thành công.');
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
            dd($th);

            // return $this->errorResponse();
        }
    }
}
