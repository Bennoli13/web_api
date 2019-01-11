<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app = new \Slim\App;

//Get All Weather
$app->get('/api/weather', function(Request $request, Response $response){
    $sql = "SELECT * FROM weather";
    try{
        //Get DB Object
        $db = new db();
        //Connect
        $db=$db->connect();

        $stmt = $db->query($sql);
        $weathers = $stmt ->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($weathers);
    } catch(PDOException $e) {
        echo '{"error": {"text" : '.$e->getMessage().'}';
    }
});

//Get Single Weather from id 
$app->get('/api/weather/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM weather WHERE id = '$id'";
    try{
        //Get DB Object
        $db = new db();
        //Connect
        $db=$db->connect();

        $stmt = $db->query($sql);
        $wheater = $stmt ->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($wheater);

    } catch(PDOException $e) {
        echo '{"error": {"text" : '.$e->getMessage().'}';
    }
});

//Add Weathers
$app->post('/api/weather/add', function(Request $request, Response $response){
    $temperature = $request->getParam('temperature');
    $humadity = $request->getParam('humadity');
    $raining_chance = $request->getParam('raining_chance');

    $sql = "INSERT INTO weather (temperature, humadity, raining_chance) VALUES 
    (:temperature, :humadity, :raining_chance)";
    
    try{
        //Get DB Object
        $db = new db();
        //Connect
        $db=$db->connect();

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":temperature", $temperature);
        $stmt->bindParam(":humadity", $humadity);
        $stmt->bindParam(":raining_chance", $raining_chance);
        $stmt->execute();
        echo '{"notice":{"text": "Weather Added"}';

    } catch(PDOException $e) {
        echo '{"error": {"text" : '.$e->getMessage().'}';
    }
});

//Update Weatehrs by id
$app->put('/api/weather/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $temperature = $request->getParam('temperature');
    $humadity = $request->getParam('humadity');
    $raining_chance = $request->getParam('raining_chance');
    
    $sql = "UPDATE weather SET
            temperature       = :temperature,
            humadity          = :humadity,
            raining_chance    = :raining_chance,
            WHERE id = $id";
    
    try{
        //Get DB Object
        $db = new db();
        //Connect
        $db=$db->connect();

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":temperature", $temperature);
        $stmt->bindParam(":humadity", $humadity);
        $stmt->bindParam(":raining_chance", $raining_chance);
        $stmt->execute();
        echo '{"notice":{"text": "Weather Updated"}';

    } catch(PDOException $e) {
        echo '{"error": {"text" : '.$e->getMessage().'}';
    }
});

//Delete Weathers by id
$app->delete('/api/weather/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM weather WHERE id = $id";
    try{
        //Get DB Object
        $db = new db();
        //Connect
        $db=$db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Weather Deleted"}';
        
    } catch(PDOException $e) {
        echo '{"error": {"text" : '.$e->getMessage().'}';
    }
});