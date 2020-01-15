<?php
namespace App;
class Cart
{
   public $items;
   public $totalQty=0;
   public $totalAmount=0;

   public function __construct($oldCart)
   {
       if($oldCart){
           $this->items=$oldCart->items;
           $this->totalQty=$oldCart->totalQty;
           $this->totalAmount=$oldCart->totalAmount;
       }else{
           $this->items=null;
       }
   }
   public function decrease($id){
       $this->items[$id]['qty']--;
       $this->items[$id]['amount'] -= $this->items[$id]['item']['price'];
       $this->totalQty--;
       $this->totalAmount -= $this->items[$id]['item']['price'];
       if($this->items[$id]['qty'] < 1){
           unset($this->items[$id]);
       }
   }
   public function increase($id){
       $this->items[$id]['qty']++;
       $this->items[$id]['amount'] += $this->items[$id]['item']['price'];
       $this->totalQty++;
       $this->totalAmount += $this->items[$id]['item']['price'];
   }
   public function add($post){
       $storeItem=['qty'=>0, 'item'=>$post, 'amount'=>$post->price];
       if($this->items){
           if(array_key_exists($post->id, $this->items)){
               $storeItem=$this->items[$post->id];
           }
       }
       $storeItem['qty']++;
       $storeItem['amount']= $post->price * $storeItem['qty'];
       $this->items[$post->id] = $storeItem;
       $this->totalQty++;
       $this->totalAmount += $post->price;
   }
}
