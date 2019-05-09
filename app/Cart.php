<?php

namespace App;

use Illuminate\Support\Facades\Log;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $description = "";

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalPrice = $oldCart->totalPrice;
            $this->totalQty = $oldCart->totalQty;
        }
    }

    public function add($item, $id){
        try{
            $storedItem = [
                'qty' => 0,
                'price' => $item->price,
                'product_id' => $id,
                'description' => $item->description,
                'item' => $item
            ];

            if($this->items){
                if(array_key_exists($id, $this->items)){
                    if($this->items[$id]['description'] == $item->description){
                        $storedItem = $this->items[$id];
                    }
                }
            }
//            dd(count($this->items));
            $storedItem['qty']++;
            $storedItem['description'] = $item->description;
            $storedItem['price'] = $item->price * $storedItem['qty'];

            $this->items[$id] = $storedItem;
            $this->totalQty++;
            $this->totalPrice += $item->price;
        }
        catch(\Exception $ex){
//            dd($ex);
            Log::error("Cart.php > add = ".$ex);
        }
    }

    public function remove($id){
        try{
//            dd($id);
            $this->totalQty = $this->totalQty - $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['price'];
            unset($this->items[$id]);
        }
        catch(\Exception $ex){
//            dd($ex);
            Log::error("Cart.php > remove = ".$ex);
        }
    }

    public function update($id, $newQty, $voucher){
        try{
            $this->items[$id]['qty'] = $newQty;
            $this->items[$id]['price'] = $this->items[$id]['price'] * $this->items[$id]['qty'];
            $this->items[$id]['voucher_code'] = $voucher;
            $this->totalPrice = $this->items[$id]['price'] * $newQty;
        }
        catch(\Exception $ex){
//            dd($ex);
            Log::error("Cart.php > update = ".$ex);
        }
    }
}