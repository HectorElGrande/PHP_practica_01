<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\Entity\User;
use MiW\Results\Utility\Utils;

// Carga las variables de entorno
Utils::loadEnv(dirname(__DIR__, 2));

$entityManager = Utils::getEntityManager();
$userRepository = $entityManager->getRepository(User::class);
if ($argc == 2) {
    /** @var User $user */
    $user = $userRepository->find($argv[1]);
    if ($user != null) {
        try {
            $entityManager->remove($user);
            $entityManager->flush();
            echo 'Removed User ' . $user->getUsername() . PHP_EOL;
        } catch (Throwable $exception) {
            echo $exception->getMessage() . PHP_EOL;
        }
    } else {
        echo 'No existe un usuario con el id pasado como argumento';
    }
} else {
    echo 'Debes pasar el id del usuario como parámetro por consola';
}
