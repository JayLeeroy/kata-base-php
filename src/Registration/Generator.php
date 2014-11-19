<?php


namespace Kata\Registration;

class Generator{
    public function generatePassword()
    {
        $length = rand(8, 16);

        return substr(str_shuffle(base64_encode(rand(1, 900000) . time())), 0, $length );
    }
}