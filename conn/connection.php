
<?php
require_once __DIR__ . "/../vendor/autoload.php";

$uri = 'mongodb+srv://dts_cluster:kHzNuZSPyD7fWbKD@dts.ovcm0.mongodb.net/?ssl=true&retryWrites=true&w=majority&appName=dts&connectTimeoutMS=30000&socketTimeoutMS=30000';

// Create a new client and connect to the server
$client = new MongoDB\Client($uri);

try {
    // Send a ping to confirm a successful connection
    $client->selectDatabase('admin')->command(['ping' => 1]);
    // echo "Pinged your deployment. You successfully connected to MongoDB!\n";
} catch (Exception $e) {
    printf($e->getMessage());
}
?>