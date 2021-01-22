<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
{
    public function rules() {
        return [
            'title' => 'required',
            'url' => 'required',
            'thumbnail_url' => 'required'
        ];
    }
}
