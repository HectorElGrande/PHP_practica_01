<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\Entity\Result;
use MiW\Results\Utility\Utils;

// Carga las variables de entorno
Utils::loadEnv(dirname(__DIR__, 2));

$entityManager = Utils::getEntityManager();
$resultRepository = $entityManager->getRepository(Result::class);
if ($argc == 2) {
    /** @var Result $result */
    $result = $resultRepository->find($argv[1]);
    if ($result != null) {
        try {
            $entityManager->remove($result);
            $entityManager->flush();
            echo 'Removed Resultado' . PHP_EOL;
        } catch (Throwable $exception) {
            echo $exception->getMessage() . PHP_EOL;
        }
    } else {
        echo 'No existe un resultado con el id pasado como argumento';
    }
} else {
    echo 'Debes pasar el id del resultado como parámetro por consola';
}
