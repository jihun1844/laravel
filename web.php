<?php

use App\Http\Controllers\TestController;
use App\Http\Middleware\TestMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
get 방식의 '/' 요청이 오면, 두번째 인자로 전달되는 클러저 함수를 실행 하라
두번째 인자로 전달된 클로저 함수를 실행하면 
welcome blade 파일을 실행하고 그 결과로 생성되는 HTML을 클라이언트에게 전달한다
*/

Route::get('/', function () {
    return view('welcome');
});


/*
get 방식의 '/test1' 요청이 오면, test blade 파일을 실행하고
그 결과로 생성되는 HTML을 클라이언트에게 전달하기 위한 
라우팅 정보를 기술해라
*/
Route::get('/test1', function () {
    return view('test', ['name'=> 'tom']);
});
//                {}안에 넣는값이 변수값이 됨
Route::get('/user/{id}', function (string $id) {
    return 'User'.$id;
});

Route::get(
    '/posts/{post}/comments/{comment}',
    function (string $postId, string $commentId) {
        return view('test2', ['postName' => $postId, 'comment' => $commentId]); 
});
//Request 객체를 사용 하려면
//use Illuminate/Http/Request;
//위 구문을 사용해 Request 클래스를 임포트 해야 한다
Route::post('/create', function (Request $req) {
    return "생성 요청이 처리 되었습니다[".$req->input('email').','.$req->input('name');
   
});

// Route::post('/create', function () {
//     return response()->json(['message' => 'success'], 200);
// });

// Route::get('/create', function(Request $req) {
//     return view('member.create',['middleware'=>$req->middleware]); //views/member/create.blade.php 실행
// })->middleware(App\Http\Middleware\TestMiddleware::class);

Route::get('/create', [TestController::class, 'create']);
