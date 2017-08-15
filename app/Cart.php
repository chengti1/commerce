<?php

namespace App;

use Session;
use DB;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart){
    	if($oldCart){
    		$this->items = $oldCart->items;
    		$this->totalQty = $oldCart->totalQty;
    		$this->totalPrice = $oldCart->totalPrice;
    	}
    }

    public function add($item, $id, $ship_id){
      $cost = 0;
      $shipping = DB::table('seller_shippings')->where('id', $ship_id)->first();
      $cost = $item->weight*$shipping->cost;
    	$storedItem = ['qty' => 0, 'price' => $item->price_after_discount, 'item' => $item, 'shipping_cost'=>$cost];
    	if($this->items){
    		if(array_key_exists($id, $this->items)){
    			$storedItem = $this->items[$id];
    		}
    	}
    	$storedItem['qty']++;
    	$storedItem['price'] = $storedItem['qty'] * $item->price_after_discount;
      $storedItem['shipping_cost'] = $storedItem['shipping_cost']*$storedItem['qty'];
    	$this->items[$id] = $storedItem;
    	$this->totalQty++;
    	$this->totalPrice += $item->price_after_discount;
    }

    public function remove($item, $id){
        $storedItem = ['qty' => 0, 'price' => $item->price_after_discount, 'item' => $item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $cost = $storedItem['shipping_cost']/$storedItem['qty'];
        $storedItem['qty']--;
        $storedItem['price'] = $storedItem['qty'] * $item->price_after_discount;
        $storedItem['shipping_cost'] = $cost*$storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty--;
        $this->totalPrice -= $item->price_after_discount;
        if($storedItem['qty'] == 0){
            unset($this->items[$id]);
        }
        if($this->totalQty == 0){
            $this->totalPrice = 0;
            $this->totalQty = 0;
        }
    }

    public function removeFromCart($item, $id){
        $storedItem = ['qty' => 0, 'price' => $item->price_after_discount, 'item' => $item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        unset($this->items[$id]);
        $this->totalPrice -= $storedItem['price'];
        $this->totalQty -= $storedItem['qty'];
        if($this->totalQty == 0){
            unset($this->items[$id]);
            $this->totalPrice = 0;
            $this->totalQty = 0;
        }
    }
}
