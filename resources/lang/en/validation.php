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

    'accepted' => 'Šim laukam ir jābūt apstiprinātam',
    'active_url' => 'Šajā laukā URL nav derīgs.',
    'after' => 'Šī lauka datumam ir jābūt pēc :date.',
    'after_or_equal' => 'Šī lauka datumam ir jābūt pēc vai vienādam ar :date.',
    'alpha' => 'Šajā laukā var būt tikai burti.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'Šajā laukā drīkst būt tikai masīvs.',
    'before' => 'Šī lauka datumam ir jābūt pirms :date.',
    'before_or_equal' => 'Šī lauka datumam ir jābūt pirms vai vienādam ar :date.',
    'between' => [
        'numeric' => 'Šajā laukā skaitlim jābūt starp :min un :max.',
        'file' => 'Šajā laukā faila liemuma ir jābūt starp :min un :max kilobaitiem.',
        'string' => 'Šajā laukā simbolu skaitam ir jābūt starp :min un :max simboliem.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'Lauka dati nesakrīt ar apstiprināšanas lauka datiem',
    'date' => 'Šajā laukā nav derīgs datums.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'Šajā laukā datums neatbilst :format formātam.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'Šajā laukā jābūt :digits ciparu.',
    'digits_between' => 'Šajā laukā ir jābūt starp :min un :max cipariem.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'Šajā laukā ir jābūt derīgai epasta adresei.',
    'ends_with' => 'Šajā laukā datiem jābeizas ar :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'Šajā laukā vērtībai jābūt lielākai par :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'Šajā laukā simbolu skaitam ir jābūt lielākam par :value simboliem.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'Šajā laukā drīkt būt tikai veseli skaitļi.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'Šajā laukā vērtībai jābūt mazākai par :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'Laukam nedrīkst būt vairāk par :max cipariem.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'Laukam nedrīkst būt vairāk par :max simboliem.',
        'array' => 'Laukam nedrīkst būt vairāk par :max simboliem.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'Laukam nedrīkst būt mazāk par :min cipariem.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'Laukam nedrīkst būt mazāk par :min simboliem.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'Šajā laukā dati drīkst būt tikai skaitļi.',
    'password' => 'Parole ir nepareiza.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'Šo lauku ir obligāti jāizpilda',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'Šī lauka datiem ir jābūt unikāliem datubāzē.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

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
        'assign_till' => [
            'after' => 'Pieteikties līdz datumam ir jābūt pēc rītdienas',
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

    'attributes' => [
        'start_date'=>'Sākuma datums', 'end_date'=>'Beigu datums', 'assign_till'=> 'Pieteikties līdz',
    ],

];
