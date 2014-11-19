<?php


namespace Kata\Registration;

class UserBuilder{
    const SALT = 'tengeriShow';
    public function buildUser(Request $request, Generator $generator)
    {
        if (empty($request->userName))
        {
            throw new \InvalidArgumentException();
        }

        $password       = $request->password ?: $generator->generatePassword();
        $hashedPassword = md5(self::SALT . $password);

        return new User($request->userName, $password, $hashedPassword);
    }
}