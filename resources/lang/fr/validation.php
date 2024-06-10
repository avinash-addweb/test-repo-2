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

    'accepted' => "le :attribute Il faut l'accepter.",
    'accepted_if' => "le :attribute doit être accepté lorsque :other est :value.",
    'active_url' => "le :attribute n'est pas une URL valide",
    'after' => "le :attribute doit être une date postérieure à :date.",
    'after_or_equal' => "le :attribut doit être une date postérieure ou égale à :date.",
    'alpha' => "le :attribute ne doit contenir que des lettres.",
    'alpha_dash' => "le :attribute ne doit contenir que des lettres, des chiffres, des tirets et des traits de soulignement.",
    'alpha_num' => "le :attribute ne doit contenir que des lettres et des chiffres.",
    'array' => "le :attribute doit être un tableau.",
    'ascii' => "le :attribute ne doit contenir que des caractères alphanumériques et des symboles à un octet.",
    'before' => "le :attribute doit être une date antérieure à :date.",
    'before_or_equal' => "le :attribute doit être une date antérieure ou égale à :date.",
    'between' => [
        'array' => "le :attribute doit avoir entre :min et :max éléments.",
        'file' => "le :attribute doit être compris entre :min et :max kilo-octets.",
        'numeric' => "le :attribute doit être compris entre :min et :max.",
        'string' => "le :attribute doit être compris entre les caractères :min et :max.",
    ],
    'boolean' => "le :attribute champ doit être vrai ou faux.",
    'confirmed' => "le :attribute confirmation ne correspond pas.",
    'current_password' => "Le mot de passe est incorrect.",
    'date' => "le :attribute Ce n'est pas une date valide.",
    'date_equals' => "le :attribute doit être une date égale à :date.",
    'date_format' => "le :attribute ne correspond pas au format :format.",
    'decimal' => "le :attribute doit avoir :decimal décimales.",
    'declined' => "le :attribute doit être refusée.",
    'declined_if' => "le :attribute doit être refusé lorsque :other est :value.",
    'different' => "le :attribute et :other doivent être différents.",
    'digits' => "le :attribute doit être :digits chiffres.",
    'digits_between' => "le :attribute doit être compris entre les chiffres :min et :max.",
    'dimensions' => "le :attribut a des dimensions d'image non valides.",
    'distinct' => "le :attribute champ a une valeur en double.",
    'doesnt_end_with' => "le :attribute ne peut pas se terminer par l'un des éléments suivants: :values.",
    'doesnt_start_with' => "le :attribute ne peut pas commencer par l'un des éléments suivants: :values.",
    'email' => "le :attribute doit être une adresse e-mail valide.",
    'ends_with' => "le :attributedoit se terminer par l'un des éléments suivants: :values.",
    'enum' => "le sélectionné :attribute n'est pas valide.",
    'exists' => "le sélectionné :attribute n'est pas valide.",
    'file' => "le :attribute doit être un fichier.",
    'filled' => "le :attribute champ doit avoir une valeur.",
    'gt' => [
        'array' => "le :attribute must have more than :value items.",
        'file' => "le :attribute must be greater than :value kilobytes.",
        'numeric' => "le :attribute must be greater than :value.",
        'string' => "le :attribute must be greater than :value characters.",
    ],
    'gte' => [
        'array' => "le :attribute doit avoir des éléments :value ou plus.",
        'file' => "le :attribute doit être supérieur ou égal à :value kilobytes.",
        'numeric' => "le :attribute doit être supérieur ou égal à :value.",
        'string' => "le :attribute doit être supérieur ou égal aux caractères :value.",
    ],
    'image' => "le :attribute doit être une image.",
    'in' => "le sélectionné :attribute n'est pas valide.",
    'in_array' => "le :attribute champ n'existe pas dans :other.",
    'integer' => "le :attribute doit être un entier",
    'ip' => "le :attribute doit être une adresse IP valide.",
    'ipv4' => "le :attribute doit être une adresse IPv4 valide.",
    'ipv6' => "le :attribute doit être une adresse IPv6 valide.",
    'json' => "le :attribute doit être une chaîne JSON valide.",
    'lowercase' => "le :attribute doit être en minuscule.",
    'lt' => [
        'array' => "le :attribute doit avoir moins de :value éléments.",
        'file' => "le :attribute doit être inférieur à :value kilobytes.",
        'numeric' => "le :attribute doit être inférieur à :value.",
        'string' => "le :attribute doit être inférieur à :value caractères.",
    ],
    'lte' => [
        'array' => "le :attribute ne doit pas avoir plus de :value éléments.",
        'file' => "le :attribute doit être inférieur ou égal à :value kilobytes.",
        'numeric' => "le :attribute doit être inférieur ou égal à :value.",
        'string' => "le :attribute doit être inférieur ou égal aux caractères :value.",
    ],
    'mac_address' => "le :attribute doit être une adresse MAC valide.",
    'max' => [
        'array' => "le :attribute ne doit pas contenir plus de :max éléments.",
        'file' => "le :attribute ne doit pas être supérieur à:max kilo-octets.",
        'numeric' => "le :attribute ne doit pas être supérieur à :max.",
        'string' => "le :attribute ne doit pas être supérieur à :max caractères.",
    ],
    'max_digits' => "le :attribute ne doit pas contenir plus de :max chiffres.",
    'mimes' => "le :attribute doit être un fichier de type :values.",
    'mimetypes' => "le :attribute doit être un fichier de type :values.",
    'min' => [
        'array' => "le :attribute doit avoir au moins :min d'éléments.",
        'file' => "le :attribute doit être d'au moins :min kilo-octets.",
        'numeric' => "le :attribute doit être au moins :min.",
        'string' => "le :attribute doit contenir au moins :min aractères.",
    ],
    'min_digits' => "le :attribute doit avoir au moins :min chiffres.",
    'missing' => "le :attribute champ doit être manquant.",
    'missing_if' => "le :attribute champ doit être manquant lorsque :other est :value.",
    'missing_unless' => "le :attribute champ doit être manquant sauf si :other est :value.",
    'missing_with' => "le :attribute champ doit être manquant lorsque :values est présent.",
    'missing_with_all' => "le :attribute champ doit être manquant lorsque :values sont présentes.",
    'multiple_of' => "le :attribute doit être un multiple de :value.",
    'not_in' => "le sélectionné  :attribute est invalide.",
    'not_regex' => "le :attribute format n'est pas valide.",
    'numeric' => "le :attribute doit être un nombre.",
    'password' => [
        'letters' => "le :attribute doit contenir au moins une lettre.",
        'mixed' => "le :attribute must contenir au moins une lettre majuscule et une lettre minuscule.",
        'numbers' => "le :attribute doit contenir au moins un chiffre.",
        'symbols' => "le :attribute doit contenir au moins un symbole.",
        'uncompromised' => "le déterminé :attribute est apparu dans une fuite de données. Veuillez choisir un autre :attribute .",
    ],
    'present' => "le :attribute champ doit être présent.",
    'prohibited' => "le :attribute champ est interdit.",
    'prohibited_if' => "le :attribute champ est interdit lorsque :other est :value.",
    'prohibited_unless' => "le :attribute champ est interdit sauf si :other est dans :values.",
    'prohibits' => "le :attribute champ interdit à :other d'être présent.",
    'regex' => "le :attribute format n'est pas valide.",
    'required' => "le :attribute champ requis",
    'required_array_keys' => "le :attribute champ doit contenir des entrées pour :values.",
    'required_if' => "le :attribute champ est obligatoire lorsque :other est :value.",
    'required_if_accepted' => "le :attribute champ est obligatoire lorsque :other est accepté.",
    'required_unless' => "le :attribute champ est obligatoire sauf si :other est dans :values.",
    'required_with' => "le :attribute champ est obligatoire lorsque :values est présent.",
    'required_with_all' => "le :attribute champ est obligatoire lorsque :values sont présentes.",
    'required_without' => "le :attribute champ est obligatoire lorsque :values n'est pas présent.",
    'required_without_all' => "le :attribute champ est obligatoire lorsqu'aucune des :values n'est présente.",
    'same' => "le :attribute et :other doit correspondre.",
    'size' => [
        'array' => "le :attribute doit contenir éléments de :size.",
        'file' => "le :attribute doit être :size kilo-octets.",
        'numeric' => "le :attribute doit être :size.",
        'string' => "le :attribute doit être constitué de caractères :size.",
    ],
    'starts_with' => "le :attribute doit commencer par l'un des éléments suivants: :values.",
    'string' => "le :attribute doit être une chaîne.",
    'timezone' => "le :attribute doit être un fuseau horaire valide.",
    'unique' => "le :attribute a déjà été pris.",
    'uploaded' => "le :attribute échec du téléchargement.",
    'uppercase' => "le :attribute doit être en majuscule.",
    'url' => "le :attribute doit être une URL valide.",
    'ulid' => "le :attribute doit être un ULID valide.",
    'uuid' => "le :attribute doit être un UUID valide.",

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