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

    'accepted' => ':Attribute harus diterima.',
    'accepted_if' => ':Attribute harus diterima jika :other adalah :value.',
    'active_url' => ':Attribute harus berupa URL yang valid.',
    'after' => ':Attribute harus berisi tanggal setelah :date.',
    'after_or_equal' => ':Attribute harus berisi tanggal setelah atau sama dengan :date.',
    'alpha' => ':Attribute hanya boleh berisi huruf.',
    'alpha_dash' => ':Attribute hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
    'alpha_num' => ':Attribute hanya boleh berisi huruf dan angka.',
    'array' => ':Attribute harus berupa array.',
    'ascii' => ':Attribute hanya boleh berisi karakter dan simbol alfanumerik byte tunggal.',
    'before' => ':Attribute harus berupa tanggal sebelum :date.',
    'before_or_equal' => ':Attribute harus berupa tanggal sebelum atau sama dengan :date.',
    'between' => [
        'array' => ':Attribute harus memiliki antara :min dan :max item.',
        'file' => ':Attribute harus antara :min dan :max kilobyte.',
        'numeric' => ':Attribute harus antara :min dan :max.',
        'string' => ':Attribute harus antara :min dan :max karakter.',
    ],
    'boolean' => ':Attribute harus benar atau salah.',
    'can' => ':Attribute berisi nilai yang tidak sah.',
    'confirmed' => ':Attribute konfirmasi tidak cocok.',
    'current_password' => 'Kata sandi salah.',
    'date' => ':Attribute harus berupa tanggal yang valid.',
    'date_equals' => ':Attribute harus sama dengan tanggal :date.',
    'date_format' => ':Attribute harus sesuai dengan format :format.',
    'decimal' => ':Attribute harus memiliki :decimal tempat desimal.',
    'declined' => ':Attribute harus ditolak.',
    'declined_if' => ':Attribute harus ditolak jika :other adalah :value.',
    'different' => ':Attribute dan :other harus berbeda.',
    'digits' => ':Attribute harus berisi :digits digit.',
    'digits_between' => ':Attribute harus berisi antara :min dan :max digit.',
    'dimensions' => ':Attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => ':Attribute memiliki nilai duplikat.',
    'doesnt_end_with' => ':Attribute tidak boleh diakhiri dengan: :values.',
    'doesnt_start_with' => ':Attribute tidak boleh dimulai dengan: :values.',
    'email' => ':Attribute harus berupa alamat email yang valid.',
    'ends_with' => ':Attribute harus diakhiri dengan salah satu dari: :values.',
    'enum' => ':Attribute yang dipilih tidak valid.',
    'exists' => ':Attribute yang dipilih tidak valid.',
    'extensions' => ':Attribute harus memiliki salah satu ekstensi berikut: :values.',
    'file' => ':Attribute harus berupa file.',
    'filled' => ':Attribute harus memiliki nilai.',
    'gt' => [
        'array' => ':Attribute harus memiliki lebih dari :value item.',
        'file' => ':Attribute harus lebih besar dari :value kilobyte.',
        'numeric' => ':Attribute harus lebih besar dari :value.',
        'string' => ':Attribute harus lebih besar dari :value karakter.',
    ],
    'gte' => [
        'array' => ':Attribute harus memiliki :value item atau lebih.',
        'file' => ':Attribute harus lebih besar dari atau sama dengan :value kilobyte.',
        'numeric' => ':Attribute harus lebih besar dari atau sama dengan :value.',
        'string' => ':Attribute harus lebih besar dari atau sama dengan :value karakter.',
    ],
    'hex_color' => ':Attribute harus berupa warna heksadesimal yang valid.',
    'image' => ':Attribute harus berupa gambar.',
    'in' => ':Attribute yang dipilih tidak valid.',
    'in_array' => ':Attribute tidak ada dalam :other.',
    'integer' => ':Attribute harus berupa bilangan bulat.',
    'ip' => ':Attribute harus berupa alamat IP yang valid.',
    'ipv4' => ':Attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => ':Attribute harus berupa alamat IPv6 yang valid.',
    'json' => ':Attribute harus berupa JSON yang valid.',
    'lowercase' => ':Attribute harus berupa huruf kecil.',
    'lt' => [
        'array' => ':Attribute harus memiliki kurang dari :value item.',
        'file' => ':Attribute harus kurang dari :value kilobyte.',
        'numeric' => ':Attribute harus kurang dari :value.',
        'string' => ':Attribute harus kurang dari :value karakter.',
    ],
    'lte' => [
        'array' => ':Attribute tidak boleh memiliki lebih dari :value item.',
        'file' => ':Attribute harus kurang dari atau sama dengan :value kilobyte.',
        'numeric' => ':Attribute harus kurang dari atau sama dengan :value.',
        'string' => ':Attribute harus kurang dari atau sama dengan :value karakter.',
    ],
    'mac_address' => ':Attribute harus berupa alamat MAC yang valid.',
    'max' => [
        'array' => ':Attribute tidak boleh memiliki lebih dari :max item.',
        'file' => ':Attribute tidak boleh lebih besar dari :max kilobyte.',
        'numeric' => ':Attribute tidak boleh lebih besar dari :max.',
        'string' => ':Attribute tidak boleh lebih besar dari :max karakter.',
    ],
    'max_digits' => ':Attribute tidak boleh lebih dari :max digit.',
    'mimes' => ':Attribute harus berupa file dengan tipe: :values.',
    'mimetypes' => ':Attribute harus berupa file dengan tipe: :values.',
    'min' => [
        'array' => ':Attribute harus memiliki setidaknya :min item.',
        'file' => ':Attribute harus setidaknya :min kilobyte.',
        'numeric' => ':Attribute harus setidaknya :min.',
        'string' => ':Attribute harus setidaknya :min karakter.',
    ],
    'min_digits' => ':Attribute harus memiliki setidaknya :min digit.',
    'missing' => ':Attribute harus tidak ada.',
    'missing_if' => ':Attribute harus tidak ada jika :other adalah :value.',
    'missing_unless' => ':Attribute harus tidak ada kecuali :other adalah :value.',
    'missing_with' => ':Attribute harus tidak ada jika :values hadir.',
    'missing_with_all' => ':Attribute harus tidak ada jika semua :values hadir.',
    'multiple_of' => ':Attribute harus merupakan kelipatan dari :value.',
    'not_in' => ':Attribute yang dipilih tidak valid.',
    'not_regex' => 'Format :attribute tidak valid.',
    'numeric' => ':Attribute harus berupa angka.',
    'password' => [
        'letters' => ':Attribute harus mengandung setidaknya satu huruf.',
        'mixed' => ':Attribute harus mengandung setidaknya satu huruf besar dan satu huruf kecil.',
        'numbers' => ':Attribute harus mengandung setidaknya satu angka.',
        'symbols' => ':Attribute harus mengandung setidaknya satu simbol.',
        'uncompromised' => ':Attribute telah muncul dalam kebocoran data. Harap pilih :attribute lainnya.',
    ],
    'present' => ':Attribute harus hadir.',
    'present_if' => ':Attribute harus hadir jika :other adalah :value.',
    'present_unless' => ':Attribute harus hadir kecuali :other adalah :value.',
    'present_with' => ':Attribute harus hadir jika :values hadir.',
    'present_with_all' => ':Attribute harus hadir jika semua :values hadir.',
    'prohibited' => ':Attribute dilarang.',
    'prohibited_if' => ':Attribute dilarang jika :other adalah :value.',
    'prohibited_unless' => ':Attribute dilarang kecuali :other adalah dalam :values.',
    'prohibits' => ':Attribute melarang :other dari hadir.',
    'regex' => 'Format :attribute tidak valid.',
    'required' => ':Attribute wajib diisi.',
    'required_array_keys' => ':Attribute harus memiliki entri untuk: :values.',
    'required_if' => ':Attribute wajib diisi jika :other adalah :value.',
    'required_if_accepted' => ':Attribute wajib diisi jika :other diterima.',
    'required_unless' => ':Attribute wajib diisi kecuali :other berada dalam :values.',
    'required_with' => ':Attribute wajib diisi jika :values hadir.',
    'required_with_all' => ':Attribute wajib diisi jika semua :values hadir.',
    'required_without' => ':Attribute wajib diisi jika :values tidak hadir.',
    'required_without_all' => ':Attribute harus diisi jika tidak ada dari :values hadir.',
    'same' => ':Attribute harus sama dengan :other.',
    'size' => [
        'array' => ':Attribute harus berisi :size item.',
        'file' => ':Attribute harus berukuran :size kilobyte.',
        'numeric' => ':Attribute harus berukuran :size.',
        'string' => ':Attribute harus berukuran :size karakter.',
    ],
    'starts_with' => ':Attribute harus dimulai dengan salah satu dari: :values.',
    'string' => ':Attribute harus berupa string.',
    'timezone' => ':Attribute harus berupa zona waktu yang valid.',
    'unique' => ':Attribute sudah ada.',
    'uploaded' => ':Attribute gagal diunggah.',
    'uppercase' => ':Attribute harus berupa huruf kapital.',
    'url' => ':Attribute harus berupa URL yang valid.',
    'ulid' => ':Attribute harus berupa ULID yang valid.',
    'uuid' => ':Attribute harus berupa UUID yang valid.',

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
