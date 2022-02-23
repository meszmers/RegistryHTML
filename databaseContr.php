<?php
require_once 'vendor/autoload.php';

$connection = [
    'dbname' => 'registry',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
try {
    $conn = \Doctrine\DBAL\DriverManager::getConnection($connection);
} catch(Exception $e){
    $this->error->add($e->getMessage());
}
//======================================================================================

$dataBase = new DataBase($conn->fetchAllAssociative('SELECT * FROM persons'));


class DataBase {

    private array $dataBase;

    public function __construct(array $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function displayInfo() {
        foreach ($this->dataBase as$i=>$show) {
            if($i % 2 == 0) {
                echo "<tr class='firstGroup'>";
                echo "<td>" .$show["id"] . "</td>";
                echo "<td>" .$show["name"] . "</td>";
                echo "<td>" .$show["surname"] . "</td>";
                echo "<td>" .$show["personCode"] . "</td>";
                echo "</tr>";
            } else {
            echo "<tr class='secondGroup'>";
            echo "<td >" .$show["id"] . "</td>";
            echo "<td>" .$show["name"] . "</td>";
            echo "<td>" .$show["surname"] . "</td>";
            echo "<td>" .$show["personCode"] . "</td>";
            echo "</tr>";
        }
        }
    }
    public function checkIfUniquePersonCode($personCode):bool {
        $x = true;
        foreach ($this->dataBase as $check) {
            if($check["personCode"] == $personCode) {
                $x = false;
                break;
            }
        }
        return $x;
    }
    public function checkIfIdExists($id):bool {
        $x = false;
        foreach ($this->dataBase as $check) {
            if($check["id"] == $id) {
                $x = true;
                break;
            }
        }
        return $x;
    }
}


if (!empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["personCode"]) && $dataBase->checkIfUniquePersonCode($_POST["personCode"])) {
    $conn->insert('persons', array('name' => $_POST["name"], "surname" => $_POST["surname"], "personCode" => $_POST["personCode"]));
    header("Refresh:0");
}

if (!empty($_POST["id"]) && $dataBase->checkIfIdExists($_POST["id"])) {
    $conn->delete('persons', ['id' => $_POST["id"]]);
    header("Refresh:0");
}
