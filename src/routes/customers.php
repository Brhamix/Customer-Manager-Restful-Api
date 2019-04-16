<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// Get all customers
$app->get('/api/customers', function(Request $request, Response $reponse){
    
});