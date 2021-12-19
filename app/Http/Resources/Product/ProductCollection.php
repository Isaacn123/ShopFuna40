<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            'name' =>$this->name,
            'price' =>$this->price,
            'category_id' => $this -> category_id,
            'total_price' => round((1 - ($this->discount/100)) * $this->price,2),
            'discount' => $this->discount,
            'ratings' =>$this->reviews->count() > 0 ? round($this->reviews->sum('star') / $this->reviews->count(),2) : 'no ratings',

            'href' => [
                'links' => route('products.show', $this->id)
            ]
    
        ];
    }
}
