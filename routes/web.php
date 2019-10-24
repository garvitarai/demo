<?php

/*All queries for local/production database*/

use App\Task;
use App\compProduct;
use App\compProductPics;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

# links to welcome / dashboard / login /analytics
Route::get('/', 'WelcomeController@WelcomeScreen');
Route::get('/home', 'DashboardController@DashboardScreen');
Route::get('/analytics', 'AnalyticsController@Analytics');
Route::get('login', 'Auth\LoginController@LoginPage')->name('login');


#confirm email
Route::get('/user/activation/{token}', 'Auth\RegisterController@userActivation')->name('user.activate');

#user profile
Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@update_avatar');
Route::get('pdfview/{date}/{department}/{status}','PDFController@pdfview');

# links to add product
Route::get('/upload', 'UploadController@view'); //TBD
Route::post('/upload', 'UploadController@uploadSubmit');
Route::resource('images', 'UploadController', ['only' => ['uploadSubmit', 'destroy']]);

# links to edit product
Route::get('/edit/{id}', 'EditController@EditForm');
Route::get('/editMain/{id}', 'EditController@EditMainForm');
Route::post('/edit/{id}','EditController@update');

# links to create report
Route::get('/createreport', 'CreateReportController@view');
Route::get('/createreport/{date}/{department}/{status}', 'CreateReportController@getProducts');
Route::post('/createreport/{date}/{department}', 'CreateReportController@submitAll');

/* Get all compProducts on add page */
Route::get('/add', 'UploadController@view');

# links to view report
Route::get('/reports', 'ReportController@view');
Route::get('/reports/{date}/{department}/{status}', 'ReportController@getProducts');
Route::post('/reports/{date}/{department}', 'ReportController@approveAll');

/* Get all compProducts on edit page */
Route::get('/edit', function () {
    error_log("INFO: get /edit");
    return view('editMain', [
        'products' => DB::table('compProducts')->whereIn('status', ['Not Submitted', 'Rejected'])->orderBy('created_at', 'desc')->get()
    ]);
});

/* Delete compProducts  on add page */
Route::delete('/add/{id}', function ($id) {
    error_log('INFO: delete /add/'.$id);
    compProduct::findOrFail($id)->delete();

    return redirect('/add');
});

/* Delete compProducts  on add page */
Route::delete('/edit/{id}', function ($id) {
    error_log('INFO: delete /edit/'.$id);
    compProduct::findOrFail($id)->delete();

    return Redirect::back()->with('message',' ');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
