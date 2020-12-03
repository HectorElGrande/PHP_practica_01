<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\Entity\User;
use MiW\Results\Utility\Utils;

// Carga las variables de entorno
Utils::loadEnv(dirname(__DIR__, 2));

$entityManager = Utils::getEntityManager();
$userRepository = $entityManager->getRepository(User::class);
if ($argc == 6) {
    try {
        $user = $userRepository->find($argv[1]);
        if ($user != null) {
            $user->setUsername($argv[2]);
            $user->setEmail($argv[3]);
            $user->setPassword($argv[4]);
            $user->setEnabled($argv[5]);
            $entityManager->flush();
            echo 'User with ID #' . $user->getId() . ' UPDATED.' . PHP_EOL;
        }else {
            echo 'Usuario no encontrado';
        }
    } catch (Throwable $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }

} else {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <UserId> <username> <email> <password> <enable>

MARCA_FIN;
    exit(0);
}
