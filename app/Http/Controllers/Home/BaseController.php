<?php
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CarController;

class BaseController extends Controller
{
	public function __construct(){
		//$this->word();
    	$countCar = CarController::countCar();
    	$_SESSION['num'] = $countCar;
    	view()->share('countCar', $countCar);
    	//$this->assign(['countCar'=>$countCar]);
	}
}