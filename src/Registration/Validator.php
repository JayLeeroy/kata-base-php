<?php


namespace Kata\Registration;

class Validator{
    const USERNAME_REGEXP = '/(^[0-9a-z]{4,128}$)/';

    public function isValidUserName(Request $request)
    {
        return (bool)preg_match(self::USERNAME_REGEXP, $request->userName);
    }

    public function isValidPassword(Request $request)
    {
        return (strlen($request->password) >= 6) && ($request->password == $request->passwordConfirm);
    }
}