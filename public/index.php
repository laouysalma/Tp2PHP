<?php

declare(strict_types = 1);

spl_autoload_register(function (string $class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../src/';

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

use App\Entity\Filiere;
use App\Entity\Etudiant;
use App\Repository\FakeEtudiantRepository;

$f = new Filiere(null, "SVT");
echo $f->getLibelle() . "<br>";


$f = new Filiere(1, "Informatique");

$e = new Etudiant(null, "Salma", "salma@test.com", $f) ;
$e3 = new Etudiant(null, "hind", "hind@gmail.com", $f) ;

$rep = new FakeEtudiantRepository();

$rep->save($e);
$rep->save($e3);


echo $e->getName() . " - " . $e->getFiliere()->getLibelle() ."<br>"."<br>";
try {
    $bad = new Etudiant(null, "", "notmail", $f);
} catch (\InvalidArgumentException $ex) {
    echo " DETECTION D'ERREUR " . $ex->getMessage()."<br>";
}

echo " ------ Insertion -------"   ."<br>";
foreach ($rep->findAll() as $e) {
    echo $e->getId() . " - " . $e->getName() . " (" . $e->getFiliere()->getLibelle() . ")" ."<br>" ."<br>";
}

$e->setName("Asma Laouy");
$rep->save($e);

echo " ------ Modification -------" ."<br>";
echo $rep->findById($e->getId())->getName() . "\n"."<br>"."<br>";

$rep->delete($e3->getId());

echo "---------------Suppression-------------"."<br>";
foreach ($rep->findAll() as $e) {
    echo $e->getName() . "\n";
}
