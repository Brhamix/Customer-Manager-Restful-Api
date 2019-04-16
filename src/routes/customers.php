<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// Get all customers
$app->get('/api/customers', function(Request $request, Response $reponse){
    
    $sql = "SELECT * FROM customers";

    try {
        
        // Get DB object
        $db = new db();

        // make connection
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customers);

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}'; 
    }
});

// Get Single Customer
$app->get('/api/customer/{id}', function(Request $request, Response $reponse){
    
    // get customer id
    $id = $request->getAttribute('id') ;

    // get specific customer
    $sql = "SELECT * FROM customers WHERE id = $id";

    try {
        
        // Get DB object
        $db = new db();

        // make connection
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customer);

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}'; 
    }
});

// Add new customer
$app->post('/api/customer/add', function(Request $request, Response $reponse){
    
    // get customer information
    $fullname = $request->getParam('fullname') ;
    $phone = $request->getParam('phone');
    $email = $request->getParam('email');
    $country = $request->getParam('country');
    $state = $request->getParam('state');
    $city = $request->getParam('city');
    $address = $request->getParam('address');

    // get specific customer
    $sql = "INSERT INTO customers (fullname, phone, email, country, state, city, address) VALUES (:fullname,:phone,:email,:country,:state,:city,:address)";

    try {
        
        // Get DB object
        $db = new db();

        // make connection
        $db = $db->connect();

        // prepare statement
        $stmt = $db->prepare($sql);

        // bind parameters
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':address', $address);

        // execute query
        $stmt->execute();

        // message
        echo '{"message": {"text": "Customer Added Successfully."}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Update customer Information
$app->put('/api/customer/update/{id}', function(Request $request, Response $reponse){

    $id = $request->getAttribute('id');
    
    // get customer information
    $fullname = $request->getParam('fullname') ;
    $phone = $request->getParam('phone');
    $email = $request->getParam('email');
    $country = $request->getParam('country');
    $state = $request->getParam('state');
    $city = $request->getParam('city');
    $address = $request->getParam('address');

    // get specific customer
    $sql = "UPDATE customers SET fullname = :fullname, phone = :phone, email = :email, country = :country, state = :state, city = :city, address = :address WHERE id = $id";

    try {
        
        // Get DB object
        $db = new db();

        // make connection
        $db = $db->connect();

        // prepare statement
        $stmt = $db->prepare($sql);

        // bind parameters
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':address', $address);

        // execute query
        $stmt->execute();

        // message
        echo '{"message": {"text": "Customer Updated Successfully."}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Delete customer
$app->delete('/api/customer/delete/{id}', function(Request $request, Response $reponse){
    
    // get customer identity
    $id = $request->getAttribute('id');

    // get specific customer
    $sql = "DELETE FROM customers WHERE id = $id";

    try {
        
        // Get DB object
        $db = new db();

        // make connection
        $db = $db->connect();

        // prepare and execute query
        $stmt = $db->prepare($sql);
        $stmt->execute();
        
        // message
        echo '{"message": {"text": "Customer Deleted Successfully."}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});