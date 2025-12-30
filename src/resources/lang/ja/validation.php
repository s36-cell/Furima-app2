<?php



return [

    'required' => ':attribute は必須です。',

    'email'    => ':attribute は正しいメールアドレス形式で入力してください。',

    'min' => [

        'string' => ':attribute は :min 文字以上で入力してください。',

    ],

    'confirmed' => ':attribute が一致しません。',



    'attributes' => [

        'name'                  => 'ユーザー名',

        'email'                 => 'メールアドレス',

        'password'              => 'パスワード',

        'password_confirmation' => '確認用パスワード',

    ],

];