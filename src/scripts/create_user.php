<?php
/**
 * PHP version 7.4
 * src/create_user_admin.php
 *
 * @category Utils
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\Entity\User;
use MiW\Results\Utility\Utils;

// Carga las variables de entorno
Utils::loadEnv(dirname(__DIR__, 2));

$entityManager = Utils::getEntityManager();
$userRepository = $entityManager->getRepository(User::class);
$user = new User();
if ($argc == 4) {
    $user->setUsername($argv[1]);
    $user->setEmail($argv[2]);
    $user->setPassword($argv[3]);
    $user->setEnabled(true);
    $user->setIsAdmin(false);
    try {
        if ($user != null) {
            $entityManager->persist($user);
            $entityManager->flush();
            echo 'Created User with ID #' . $user->getId() . PHP_EOL;
        }
    } catch (Throwable $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
} else {
    echo 'Debes pasar 3 parámetros: 1º->username/2º->email/3º->password';
}
