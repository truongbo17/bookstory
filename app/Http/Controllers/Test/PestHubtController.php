<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PestHubtController extends Controller
{

    public function pesthubt()
    {
        $sql = "SELECT * FROM quizs";
        $db = new \PDO ( "mysql:$dbname", $user, $password) ;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        file_put_contents("output.txt", json_encode($result));
    }
}
