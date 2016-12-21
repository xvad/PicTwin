<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

/**
 * Class Pic
 * modelo de la base de datos pic
 */
class Pic extends Illuminate\Database\Eloquent\Model {

    protected $table = 'pic';
    protected $fillable = ['id','idDevice','date','url','latitude','longitude','positive','negative','warning','imagen'];
    public $timestamps = false;
}

/**
 * Class Twin
 * modelo de la base de datos twin
 */
class Twin extends Illuminate\Database\Eloquent\Model {

    protected $table = 'twin';
    protected $fillable = ['servidor','android'];
    public $timestamps = false;
}



/**
 * Inserccion de un pic
 */

$app->post('/insertar/pic',function(){
    $data = json_decode('php://input');
    //Creacion de un nuevo pic
    $pic  = new Pic;
    //Asinacion
    $pic->deviceid = $data['idDevice'];
    $pic->date = $data['date'];
    $pic->url = $data['url'];
    $pic->latitude = $data['latitude'];
    $pic->longitude = $data['longitude'];
    $pic->positive = $data['positive'];
    $pic->negative = $data['negative'];
    $pic->warning = $data['warning'];
    $pic->imagen = $data['imagen'];
    $pic->save();

});

