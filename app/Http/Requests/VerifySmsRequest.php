<?php

namespace App\Http\Requests;

use App\Models\Smsverify;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;



class VerifySmsRequest extends FormRequest
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
            'phone'=>['required','starts_with:+98','size:13'],

        ];
    }
    public function messages()
    {
        return [
            'phone.*'=>'your phone number should be 13 digits and start with +98'
        ];
    }


    public function authenticate(){
        $exist_model =(new Smsverify)->existNumberInDatabase($this->phone);
        if($exist_model){
            $this->limitVerificationRequest($exist_model);
            $this->checkVerfyBefore($exist_model);
        }
    }

    private function limitVerificationRequest($exist_model){
        $model_timestamp = $exist_model->updated_at->timestamp ?? $exist_model->created_at->timestamp;
        $now_timestamp = now()->timestamp;
        $remain_time = config('services.sms.sendAgainInSeconde')-($now_timestamp-$model_timestamp);
        if($remain_time>0){
            throw ValidationException::withMessages(['sms'=>"please try $remain_time second later"]);
        }
    }

    private function checkVerfyBefore($exist_model){
        if($exist_model->is_verified){
            throw ValidationException::withMessages(['sms'=>"your verified before"]);
        }
    }
}
