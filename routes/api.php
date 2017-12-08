<?php

use Illuminate\Http\Request;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/class',function(Faker $faker){
    $classVar = array();
    $avatar = array(
        '/images/class_images/class1.png', 
        '/images/class_images/class2.png', 
        '/images/class_images/class3.png', 
        '/images/class_images/class4.png', 
        '/images/class_images/class5.png', 
        '/images/class_images/class6.png', 
        '/images/class_images/class7.png', 
        '/images/class_images/class8.png', 
        '/images/class_images/class9.png', 
        '/images/class_images/class10.png');
    
    for ($i=0; $i < 10; $i++) {
        $classVar[] =[
            'íd'=>$faker->uuid,
            'className'=>$faker->company,
            'email'=>$faker->safeEmail,
            'studentCount'=> '4 Students',
            'icon' => '/images/class_images/settings_icon.png',
            'avatar' => $avatar[$i],
            'clicked' => false
        ];
    }
    return response()->json(['status'=>'OK','data'=>$classVar]);
});

Route::get('/groupclass',function(Faker $faker){
    $groupClassVar = array();
    for ($i=1; $i <= 7; $i++) {
        $groupClassVar[] =[
            'id'=>$faker->uuid,
            'className'=>$faker->company,
            'icon'=> '/images/class_images/settings_icon.png',
            'avatar' => '/images/class_group_icon.png'
        ];
    }
    return response()->json(['status'=>'OK','data'=>$groupClassVar]);
});

Route::get('/staffs',function(Faker $faker){
    $staffVar = array();
    for ($i=1; $i <= 4; $i++) {
        $staffVar[] =[
            'id'=>$faker->uuid,
            'staffName'=>$faker->company,
            'icon'=> '/images/class_images/settings_icon.png',
            'avatar' => '/images/staff_icon.png',
            'clicked' => false
        ];
    }
    return response()->json(['status'=>'OK','data'=>$staffVar]);
});

Route::get('/staffgroup',function(Faker $faker){
    $staffGroupVar = array();
    for ($i=1; $i <= 3; $i++) {
        $staffGroupVar[] =[
            'id'=>$faker->uuid,
            'staffGroupName'=>$faker->company,
            'icon'=> '/images/class_images/settings_icon.png',
            'avatar' => '/images/group_icon.png'
        ];
    }
    return response()->json(['status'=>'OK','data'=>$staffGroupVar]);
});

Route::get('/students',function(Faker $faker){
    $studentVar = array();
    $studentImages[] = glob('images/student_images/cute*');
    for ($i=1; $i <= 10; $i++) {
        $studentVar[] =[
            'id'=>$faker->uuid,
            'studentName'=>$faker->name,
            'studentPoint'=> 0,
            'avatar' => $studentImages[0][$i],
            'pointsAwarded' => false
        ];
    }
    return response()->json(['status'=>'OK','data'=>$studentVar]);
});

Route::get('/studentgroups',function(Faker $faker){
    $studentGroupVar = array();
    $studentGroupImages = glob('images/student_images/cute*');
    $random_keys = array_rand($studentGroupImages, 4);

    for($j=1; $j <= 4; $j++) {
      $studentRandomAvatars = [
        'avatar1' => $studentGroupImages[$random_keys[0]],
        'avatar2' => $studentGroupImages[$random_keys[1]],
        'avatar3' => $studentGroupImages[$random_keys[2]],
        'avatar4' => $studentGroupImages[$random_keys[3]]
      ];
    }

    for ($i=1; $i <= 3; $i++) {
      $studentGroupVar[] =[
        'id'=>$faker->uuid,
        'studentGroupName'=>$faker->name,
        'studentGroupPoint'=> 0,
        'avatar' => $studentRandomAvatars,
        'pointsAwarded' => false
      ];
    }
    return response()->json(['status'=>'OK','data'=>$studentGroupVar]);
});

Route::get('/classimages', function() {
    $classImages = array();
    $listOfImages[] = glob('images/class_images/*');
    for ($i = 1; $i < 19; $i++) {
        $classImages[] = [
            'avatar' => $listOfImages[0][$i]
        ];
    }
    return response()->json(['status'=>'OK','data'=>$classImages]);
});

/*,
      {
        'menuName': 'Connect parents',
        'menuUrl': ''
      },
      {
        'menuName': 'Connect students',
        'menuUrl': ''
      },
      {
        'menuName': 'Add co-teachers',
        'menuUrl': ''
      },
      {
        'menuName': 'Archive class',
        'menuUrl': ''
      }*/