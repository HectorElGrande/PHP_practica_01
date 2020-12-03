<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\Entity\Result;
use MiW\Results\Entity\User;
use MiW\Results\Utility\Utils;

// Carga las variables de entorno
Utils::loadEnv(dirname(__DIR__, 2));

$entityManager = Utils::getEntityManager();
$resultRepository = $entityManager->getRepository(Result::class);
if ($argc == 5 || $argc == 4) {
    /** @var User $user */
    $user = $entityManager
        ->getRepository(User::class)
        ->findOneBy(['id' => $argv[2]]);
    if (null === $user) {
        echo "Usuario $argv[2] no encontrado" . PHP_EOL;
        exit(0);
    }
    try {
        $result = $resultRepository->find($argv[1]);
        if ($result != null) {
            $result->setUser($user);
            $result->setResult($argv[3]);
            ($argc==4)?$result->setTime(new DateTime('now')):$result->setTime(new DateTime($argv[4]));
            $entityManager->flush();
            echo 'Result with ID #' . $result->getId() . ' UPDATED.' . PHP_EOL;
        }else {
            echo 'Result no encontrado';
        }
    } catch (Throwable $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }

} else {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <ResultID> <userID> <result> [<time>]

MARCA_FIN;
    exit(0);
}
