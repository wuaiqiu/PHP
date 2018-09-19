# Lumen

>Lumen是一个基于Laravel的微框架，主要用于小型应用和微服务，专注于性能和速度的优化，该框架一个重要的应用就是构建 REST API。


**一.安装&配置**

```
#安装
composer create-project laravel/lumen rest_api

#配置数据库.env
DB_DATABASE=student
DB_USERNAME=root
DB_PASSWORD=car

#取消注释(bootstrap/app.php)
$app->withFacades();
$app->withEloquent();
```

<br>

**二.数据迁移**

```
#创建迁移文件create_table_cars
php artisan make:migration create_table_cars --create=cars

#修改create_table_cars迁移文件
Schema::create('cars', function (Blueprint $table) {
    $table->increments('id');
    $table->string('make');
    $table->string('model');
    $table->string('year');
});

#执行迁移
php artisan migrate
```

<br>

**三.创建模型与控制器**

```
namespace App;
use Illuminate\Database\Eloquent\Model;

class Car extends Model{
    protected $fillable = ['make', 'model', 'year'];
    public $timestamps = false;
}
```

```
namespace App\Http\Controllers;
use App\Car;
use Illuminate\Http\Request;

class CarController extends Controller{

    //创建car
    public function createCar(Request $request){
        $car = Car::create($request->all());
        return response()->json($car);
    }

    //更新car
    public function updateCar(Request $request, $id){
        $car = Car::find($id);
        $car->make = $request->input('make');
        $car->model = $request->input('model');
        $car->year = $request->input('year');
        $car->save();
        return response()->json($car);
    }

    //删除car
    public function deleteCar($id){
        $car = Car::find($id);
        $car->delete();
        return response()->json('删除成功');
    }

    //查询所有
    public function index(){
        $cars = Car::all();
        return response()->json($cars);
    }
}
```

<br>

**四.定义路由**

```
Route::group(['prefix' => 'api/v1'],function(){
    Route::post('car','CarController@createCar');
    Route::put('car/{id}','CarController@updateCar');
    Route::delete('car/{id}','CarController@deleteCar');
    Route::get('car','CarController@index');
});
```

<br>

**五.API测试**

```
#创建car
curl -i -X POST -H "Content-Type:application/json" http://localhost/api/v1/car -d '{"make":"audi","model":"tt","year":"2016"}'

#更新car
curl -H "Content-Type:application/json" http://localhost/api/v1/car/1 -X PUT -d '{"make":"bmw","model":"x6","year":"2016"}'

#查询car
curl -H "Content-Type:application/json" http://localhost/api/v1/car -X GET

#删除car
curl -X DELETE http://localhost/api/v1/car/1
```
