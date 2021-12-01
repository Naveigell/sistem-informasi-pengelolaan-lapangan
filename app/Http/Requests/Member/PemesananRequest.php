<?php

namespace App\Http\Requests\Member;

use App\Traits\Request\HasTimeRules;
use Illuminate\Foundation\Http\FormRequest;

class PemesananRequest extends FormRequest
{
    use HasTimeRules;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "tanggal"    => "required|date_format:Y-m-d|date|after_or_equal:" . date('Y-m-d'),
            "id"         => "required|min:1",
            "jenis_sewa" => "required|in:event,reguler",
        ];

        if ($this->get('jenis_sewa') == 'reguler') {
            $rules['waktu']   = "required|array";
            $rules['waktu.*'] = "integer|in:8,10,12,14,16,18";
        }

        $this->createTimeRules($rules);

        return $rules;
    }

    protected function prepareForValidation()
    {
        if (!is_array($this->get('waktu')) && is_string($this->get('waktu'))) {
            $times = explode(',', $this->get('waktu'));
        }

        $this->merge([
            "booked" => $times ?? $this->get('waktu'),
            "waktu"  => $times ?? $this->get('waktu'),
        ]);
    }
}
