<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone'=>['required','string','starts_with:+98','size:13','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
 
    public function checkRegisterBefore(){
        if($this->modelRegisterBefore()){
            throw ValidationException::withMessages([
                'phone'=>'this number is registered before'
            ]);
        }
    }
    private function modelRegisterBefore(){
        $exits =DB::table('smsverifies')
        ->join('users', function ($join) {
            $join->on('users.phone', '=', 'smsverifies.phone')
            ->where('is_verified',1);
        })
        ->where('smsverifies.phone','=',$this->phone)
        ->select(['is_verified'])->first();
        return $exits;
    }
}
