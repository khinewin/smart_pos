<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[
    'uses'=>'HomeController@getWelcome',
    'as'=>'/'
]);

Route::get('/post-image-front/{img_name}',[
    'uses'=>'HomeController@getPostImage',
    'as'=>'post.image.front'
]);

Route::get('/shopping/cart',[
    'uses'=>'HomeController@getShoppingCart',
    'as'=>'shopping.cart'
]);
Route::get('/increase/cart/{id}',[
    'uses'=>'HomeController@getIncreaseCart',
    'as'=>'increase.cart'
]);
Route::get('/decrease/cart/{id}',[
    'uses'=>'HomeController@getDecreaseCart',
    'as'=>'decrease.cart'
]);
Route::get('/clear/cart',[
    'uses'=>'HomeController@getClearCart',
    'as'=>'clear.cart'
]);

Route::get('/post/category/{id}',[
    'uses'=>'HomeController@getPostByCategory',
    'as'=>'post.category'
]);
Route::get('/post/search',[
    'uses'=>'HomeController@getPostSearch',
    'as'=>'search.post'
]);
Route::get('/add/to/cart/{id}',[
    'uses'=>'HomeController@getAddToCart',
    'as'=>"add.to.cart"
]);
Route::post('/checkout',[
    'uses'=>'HomeController@postCheckout',
    'as'=>'checkout'
]);

Route::group(['prefix'=>'auth'], function (){
    Route::get('/logout',[
        'uses'=>'AuthController@getLogout',
        'as'=>'logout'
    ]);
    Route::get('/login',[
        'uses'=>'AuthController@getLogin',
        'as'=>'login'
    ]);
    Route::post('/login',[
        'uses'=>'AuthController@postLogin',
        'as'=>'login'
    ]);
    Route::get('/register',[
        'uses'=>'AuthController@getRegister',
        'as'=>'register'
    ]);
    Route::post('/register',[
        'uses'=>'AuthController@postRegister',
        'as'=>'register'
    ]);
});


Route::group(['prefix'=>'admin','middleware'=>'auth'], function (){
    Route::get('/dashboard',[
        'uses'=>'AdminController@getDashboard',
        'as'=>'dashboard'
    ]);//->middleware('auth');
    Route::get('/profile',[
        'uses'=>'AdminController@getProfile',
        'as'=>'profile'
    ]);
    Route::post('/profile/upload',[
        'uses'=>'AdminController@uploadProfile',
        'as'=>'profile.upload'
    ]);



});



Route::group(['prefix'=>'admin','middleware'=>'auth'], function (){
    Route::group(['prefix'=>'users','middleware'=>'role:Administrator'], function (){
        Route::get('/filter/orders',[
            'uses'=>'OrderController@filterOrders',
            'as'=>'filter.orders'
        ]);

        Route::get('/orders',[
            'uses'=>'OrderController@getOrders',
            'as'=>'orders'
        ]);

       Route::get('/all',[
           'uses'=>'UserController@allUsers',
           'as'=>'users'
       ]);
       Route::get('/new',[
           'uses'=>'UserController@newUser',
           'as'=>'user.new'
       ]);
       Route::get('/id/{id}/delete',[
           'uses'=>'UserController@deleteUser',
           'as'=>'user.delete'
       ]);
       Route::post('/update',[
           'uses'=>'UserController@updateUser',
           'as'=>'user.update'
       ]);
    });

    Route::group(['prefix'=>'posts', 'middleware'=>'role:Administrator|Cashier'], function (){
        Route::post('/update/post',[
            'uses'=>'PostController@updatePost',
            'as'=>'post.update'
        ]);

        Route::get('/delete/post/image/{id}',[
            'uses'=>'PostController@getDeletePostImage',
            'as'=>'delete.post.image'
        ]);
        Route::get('/edit/post/{id}',[
            'uses'=>'PostController@getEditPost',
            'as'=>'edit.post'
        ]);

        Route::get('/delete/post/{id}',[
            'uses'=>'PostController@getDeletePost',
            'as'=>'post.delete'
        ]);
        Route::get('/post-image/{img_name}',[
            'uses'=>'PostController@getPostImage',
            'as'=>'post.image'
        ]);
        Route::get('/all',[
            'uses'=>'PostController@allPosts',
            'as'=>'posts'
        ]);
        Route::post('/new/post',[
            'uses'=>'PostController@postNewPost',
            'as'=>'post.new'
        ]);
        Route::get('/new/post',[
            'uses'=>'PostController@getNewPost',
            'as'=>'post.new'
        ]);

        Route::get('/categories',[
            'uses'=>'PostController@getCategories',
            'as'=>'categories'
        ]);
        Route::post('/new/category',[
            'uses'=>'PostController@newCategory',
            'as'=>'category.new'
        ]);
        Route::get('/remove/category/{id}',[
            'uses'=>'PostController@removeCategory',
            'as'=>'category.remove'
        ]);
        Route::post('/update/category',[
            'uses'=>'PostController@updateCategory',
            'as'=>'category.update'
        ]);
    });

});

