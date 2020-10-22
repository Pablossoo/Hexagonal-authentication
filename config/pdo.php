<?php
declare(strict_types=1);

require_once 'parameters.php';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=school', $params['db']['user'], $params['db']['password']);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print 'Error!: ' . $e->getMessage() . '<br/>';
    die();
}
