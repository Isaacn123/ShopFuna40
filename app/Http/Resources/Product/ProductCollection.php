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
            'user_id' =>$this->user_id,
            'category_id' => $this -> category_id,
            'total_price' => round((1 - ($this->discount/100)) * $this->price,2),
            'discount' => $this->discount,
            'imagePath' => $this->imagePath,
            'qty' => $this->qty,
            'description' =>$this->description,
            'subCategory_id' => $this->subCategory_id,
            'companyName' => $this->companyName,
            'featured_image' => $this ->featured_image,
            'created_at' => $this->created_at,
            // 'no ratings'
            'ratings' =>$this->reviews->count() > 0 ? round($this->reviews->sum('star') / $this->reviews->count(),2) : 0,

            'href' => [
                'links' => route('products.show', $this->id)
            ]
    
        ];
    }
}
