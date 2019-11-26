<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tendetaithinghiem' => 'required',
            'loaicaytrong' => 'required|gt:0',
            'vusanxuat' => 'required',
            // 'ngaythuhoach' => 'required',
            'ngaynhapkho' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'tendetaithinghiem.required' => 'Nhập tên đề tài/thí nghiệm',
            'loaicaytrong.required' => 'Chọn loại cây trồng',
            'loaicaytrong.gt' => 'Chọn loại cây trồng',
            'vusanxuat.required' => 'Chọn vụ sản xuất',
            'ngaythuhoach.required' => 'Chọn ngày thu hoạch',
            'ngaynhapkho.required' => 'Chọn ngày nhập kho'
        ];
    }
}
