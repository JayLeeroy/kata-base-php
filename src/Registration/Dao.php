<?php
namespace Kata\Registration;
use SebastianBergmann\Exporter\Exception;

class Dao {
    public function storeUserData(\PDO $pdo, User $user)
    {
        try {
            $sth = $pdo->prepare("
              INSERT INTO users (username, password_hash)
              VALUES
              (:userName, :passwordHash)
            ");

            $sth->execute(
                array(
                    ':userName' => $user->getUserName(),
                    ':passwordHash' => $user->getPasswordHash(),
                )
            );

            return $pdo->lastInsertId();
        }
        catch (\PDOException $e)
        {
            return 0;
        }
    }
}