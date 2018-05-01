<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\Resource;
class Article extends Resource
{


 public function toArray($request)
  {
    // return parent::toArray($request);
    return [
        'id' => $this->id,
        'title' => $this->title,
        'body' => $this->body
    ];
  }

}    