
<?php
require_once __DIR__ . "/../vendor/autoload.php";

// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
// $dotenv = Dotenv\Dotenv::createImmutable('/app');
// $dotenv->load();
// $mongoDbPassword = $_ENV['MONGO_DB_PASSWORD'];
// $uri = 'mongodb+srv://dts_cluster:kHzNuZSPyD7fWbKD@dts.ovcm0.mongodb.net/?ssl=true&retryWrites=true&w=majority&appName=dts&connectTimeoutMS=30000&socketTimeoutMS=30000';
$uri = "mongodb://dts_cluster:kHzNuZSPyD7fWbKD@dts-shard-00-00.ovcm0.mongodb.net:27017,dts-shard-00-01.ovcm0.mongodb.net:27017,dts-shard-00-02.ovcm0.mongodb.net:27017/?ssl=true&replicaSet=atlas-130y3x-shard-0&authSource=admin&retryWrites=true&w=majority&appName=dts";

// Create a new client and connect to the server
$client = new MongoDB\Client($uri);

try {
    // Send a ping to confirm a successful connection
    $client->selectDatabase('admin')->command(['ping' => 1]);
    // echo "Pinged your deployment. You successfully connected to MongoDB!\n";
} catch (Exception $e) {
    printf($e->$getMessage);
}
?>