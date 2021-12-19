<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' =>$this->name,
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'stock' => $this->stock == 0 ? 'Out of Stock' : $this->stock,
            'total_price' => round((1 - ($this->discount/100)) * $this->price,2),
            'category_id' => $this -> category_id,
            'subCategory_id' => $this->subCategory_id,
            // 'ratings' => $this->reviews->sum('star'),
            'ratings' =>$this->reviews->count() > 0 ? round($this->reviews->sum('star') / $this->reviews->count()) : 'no ratings',
            'href' => [
                'reviews' => route('reviews.index', $this->id)
            ]
        ];
    }
}
