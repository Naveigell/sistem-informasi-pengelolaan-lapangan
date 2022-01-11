<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :atribut diterima',
    'accepted_if' => 'The :atribut harus diterima ketika :lainnya adalah :nilai.',
    'active_url' => 'The :atribut bukan URL yang valid',
    'after' => 'The :atribut harus berupa tanggal setelah :tanggal',
    'after_or_equal' => 'The :atribut harus tanggal setelah atau sama dengan :tanggal.',
    'alpha' => 'The :atribut hanya boleh berisi huruf',
    'alpha_dash' => 'The :atribut hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah',
    'alpha_num' => 'The :atribut hanya boleh berisi huruf dan angka',
    'array' => 'The :atribut harus berupa array .',
    'before' => 'The :attribute harus tanggal sebelum :date.',
    'before_or_equal' => 'The :attribute harus tanggal sebelum atau sama dengan :date.',
    'antara' => [
        'numeric' => 'The :attribute harus antara :min dan :max.',
        'file' => 'The :attribute harus antara :min dan :max kilobytes.',
        'string' => 'The :attribute harus antara :min dan :max karakter.',
        'array' => 'The :attribute harus memiliki antara :min dan :max item.',
    ],
    'boolean' => 'Bidang :attribute harus benar atau salah.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'current_password' => 'Kata sandi salah.',
    'date' => 'The :attribute bukan tanggal yang valid.',
    'date_equals' => 'The :attribute harus berupa tanggal yang sama dengan :date.',
    'date_format' => 'The :attribute tidak cocok dengan format :format.',
    'declined' => 'The :attribute harus ditolak.',
    'declined_if' => 'The :attribute harus ditolak ketika :other adalah :value.',
    'different' => 'The :attribute dan :other harus berbeda.',
    'digits' => 'The :attribute harus :digits digits.',
    'digits_between' => 'Atribut :attribute harus antara :min dan :max digit.',
    'dimensions' => 'The :attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => 'Bidang :attribute memiliki nilai duplikat.',
    'email' => 'The :attribute harus berupa alamat email yang valid.',
    'ends_with' => 'The :attribute harus diakhiri dengan salah satu dari berikut ini: :values.',
    'exists' => 'Yang dipilih :attribute tidak valid.',
    'file' => 'The :attribute harus berupa file.',
    'filled' => 'Bidang :attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => 'The :attribute harus lebih besar dari :value.',
        'file' => 'The :attribute harus lebih besar dari :value kilobytes.',
        'string' => 'The :attribute harus lebih besar dari :value karakter.',
        'array' => 'The :attribute harus memiliki lebih dari :value item.',
    ],
    'gte' => [
        'numeric' => 'The :attribute harus lebih besar dari atau sama dengan :value.',
        'file' => 'The :attribute harus lebih besar dari atau sama dengan :value kilobytes.',
        'string' => 'The :attribute harus lebih besar dari atau sama dengan :value karakter.',
        'array' => 'The :attribute harus memiliki :value item atau lebih.',
    ],
    'image' => 'The :attribute harus berupa gambar.',
    'in' => 'Yang dipilih :attribute tidak valid.',
    'in_array' => 'Bidang :attribute tidak ada di :other.',
    'integer' => 'The :attribute harus bilangan bulat.',
    'ip' => 'The :attribute harus berupa alamat IP yang valid.',
    'ipv4' => 'The :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => 'The :attribute harus berupa alamat IPv6 yang valid.',
    'json' => 'The :attribute harus berupa string JSON yang valid.',
    'lt' => [
        'numeric' => 'The attribute harus lebih kecil dari :value.',
        'file' => 'The :attribute harus kurang dari :value kilobytes.',
        'string' => 'The :attribute harus kurang dari :value karakter.',
        'array' => 'The :attribute harus memiliki kurang dari :value item.',
    ],
    'lte' => [
        'numeric' => 'The :attribute harus lebih kecil dari atau sama dengan :value.',
        'file' => 'The :attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string' => 'The :attribute harus kurang dari atau sama dengan :value karakter.',
        'array' => 'The :attribute tidak boleh lebih dari :value item.',
    ],
    'maks' => [
        'numeric' => 'The :attribute tidak boleh lebih besar dari :max.',
        'file' => 'The :attribute tidak boleh lebih besar dari :max kilobytes.',
        'string' => 'The :attribute tidak boleh lebih besar dari :max karakter.',
        'array' => 'The :attribute tidak boleh lebih dari :max item.',
    ],
    'mimes' => 'The :attribute harus berupa file dengan tipe: :values.',
    'mimetypes' => 'The :attribute harus berupa file dengan tipe: :values.',
    'min' => [
        'numeric' => 'The :attribute setidaknya harus :min.',
        'file' => 'The :attribute minimal :min kilobytes.',
        'string' => 'The :attribute harus minimal :min karakter.',
        'array' => 'The :attribute harus memiliki setidaknya :min item.',
    ],
    'multiple_of' => ' :attribute harus kelipatan dari :value.',
    'not_in' => 'Atribut yang dipilih tidak valid.',
    'not_regex' => 'Format :attribute tidak valid.',
    'numeric' => 'The :attribute harus b',
    'password' => 'Password salah.',
    'present' => 'Bidang :attribute harus ada.',
    'prohibited' => 'Bidang :attribute dilarang.',
    'prohibited_if' => 'Bidang :attribute dilarang jika :other adalah :value.',
    'prohibited_unless' => 'Bidang :attribute dilarang kecuali :other ada di :values.',
    'prohibits' => 'Bidang :attribute melarang :other hadir.',
    'regex' => 'Format :attribute tidak valid.',
    'required' => 'Bidang :attribute wajib diisi.',
    'required_if' => 'Bidang :attribute diperlukan ketika :other adalah :value.',
    'required_unless' => 'Bidang :attribute wajib diisi kecuali :other ada di :values.',
    'required_with' => 'Bidang :attribute diperlukan bila :nilai ada.',
    'required_with_all' => 'Bidang :attribute diperlukan bila :nilai ada.',
    'required_without' => 'Bidang :attribute diperlukan bila :nilai tidak ada.',
    'required_without_all' => 'Bidang :attribute diperlukan bila tidak ada :nilai yang ada.',
    'same' => 'The :attribute dan :other harus cocok.',
    'size' => [
        'numeric' => 'The :attribute harus :size.',
        'file' => 'The :attribute harus :size kilobytes.',
        'string' => 'The :attribute harus :size karakter.',
        'array' => 'The :attribute harus berisi :size item.',
    ],
    'starts_with' => ' :attribute harus dimulai dengan salah satu dari berikut ini: :values.',
    'string' => 'The :attribute harus berupa string.',
    'timezone' => 'The :attribute harus berupa zona waktu yang valid.',
    'unique' => 'The :attribute telah diambil.',
    'uploaded' => 'The :attribute gagal diupload.',
    'url' => 'The :attribute harus berupa URL yang valid.',
    'uuid' => 'The :attribute harus berupa UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
