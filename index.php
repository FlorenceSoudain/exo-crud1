<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 14/01/2019
 * Time: 10:04
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "colyseum";

$connection = new mysqli($servername, $username, $password);

if ($connection->connect_error) {
    die("connection failed : " . $connection->connect_error);
} else {
    $connection->select_db($dbname);
}

//exercice 1
echo "Exercice 1 <br><br>";
$clients = "SELECT * FROM clients WHERE 1";
$result = $connection->query($clients);
while ($row = $result->fetch_assoc()) {
    echo " Nom : " . $row['lastName'] . ", Prenom : " . $row['firstName'] . ", Date de naissance : " . $row['birthDate'] . ", Cartes : " .
        $row ['card'] . ", Nombre de cartes : " . $row['cardNumber'] . "<br>";
}

echo "<br><br>";

//exercice 2
echo "Exercice 2 <br><br>";
function a()
{
    global $connection;
    $shows = "SELECT type FROM showTypes WHERE 1";
    $resultShows = $connection->query($shows);
    while ($row = $resultShows->fetch_assoc()) {
        echo " " . $row['type'] . ", ";
    }
}

a();

echo "<br><br>";

//exercice 3
echo "Exercice 3 <br><br>";
function b()
{
    global $connection;
    $clients20 = "SELECT id, lastName FROM clients LIMIT 20";
    $result = $connection->query($clients20);
    while ($row = $result->fetch_assoc()) {
        echo $row['id'] . " " . $row['lastName'] . " ";
    }
}

b();

echo "<br><br>";

//exercice 4
echo "Exercice 4 <br><br>";
function c()
{
    global $connection;
    $sql = "SELECT lastName FROM `cardtypes`, `clients`, `cards`  WHERE `cards`.`cardTypesId` = 1 AND `cards`.`cardTypesId` = `cardtypes`.`id` AND `cards`.`cardNumber` = `clients`.`cardNumber`";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo " " . $row['lastName'] . " ";
    }
}

c();
echo "<br><br>";

//exercice 5
echo "Exercice 5 <br><br>";
function d()
{
    global $connection;
    $sql = "SELECT firstName, lastName FROM clients WHERE lastName LIKE 'm%' ORDER BY lastName ASC";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo " Nom : " . $row['lastName'] . " Prenom : " . $row['firstName'];
    }
}

d();

echo "<br><br>";

//exercice 6
echo "Exercice 6 <br><br>";
function e()
{
    global $connection;
    $sql = "SELECT title, performer, date, startTime FROM shows WHERE 1";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo $row['title'] . " par " . $row['performer'] . ", le " . $row['date'] . " à " . $row['startTime'] . "<br> ";
    }
}

e();
echo "<br><br>";

//exercice 7
echo "Exercice 7 <br><br>";
//affiche les clients qui ont une carte
function f()
{
    global $connection;
    $sql = "SELECT lastName, firstName, birthDate, card, cardNumber FROM clients WHERE 1";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "Nom : " . $row['lastName'] . " Prenom : " . $row['firstName'] . " Date de Naissance : " . $row['birthDate'];
        if ($row['card'] == 1) {
            echo " Carte de Fidélité : Oui";
        }
        if ($row['card'] == 0) {
            echo " Carte de Fidélité : Non";
        }
        if ($row['cardNumber'] !== NULL) {
            echo " Numéro de carte : " . $row['cardNumber'];
        }
        echo "<br>";
    }
}

f();

echo "<br><br>";

function g()
{
    global $connection;
    $sql = "SELECT * FROM clients LEFT JOIN cards ON cards.cardNumber = clients.cardNumber";
    $result = $connection->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "Nom : " . $row['lastName'] . " Prenom : " . $row['firstName'] . " Date de Naissance : " . $row['birthDate'];
        if ($row['cardTypesId'] == 1) {
            echo " Carte de Fidélité : Oui Numéro de carte : " . $row['cardNumber'];
        }
        else {
            echo " Carte de Fidélité : Non";
        }
        echo "<br>";
    }
}

g();