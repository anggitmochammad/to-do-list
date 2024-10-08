<?php

namespace App\Http\Requests;

use App\Enums\ItemStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CheckListItemUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->checklist['user_id'] == Auth::user()['id']) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function passedValidation()
    {
       
        if ($this->route()->getName() == 'updateStatus') {
            $this['status'] = $this->checklistItem['status'] == ItemStatus::TODO ? ItemStatus::PROGRESS : ItemStatus::DONE;
        }
        
    }
}
