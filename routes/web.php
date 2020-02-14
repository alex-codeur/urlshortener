<?php

use App\Url;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/', function () {
    // valider l'url
    $url = request('url');

    Validator::make(compact('url'), ['url' => 'required|url'])->validate();

    // vérifier si l'url a déjà été raccourcie et la retourner si tel est le cas
    $record = Url::where('url', $url)->first();

    if ($record) {
        $shortened = $record->shortened;
        return view('result', compact('shortened'));
    }
    
    // créer une nouvelle short url et la retourner
    function get_unique_short_url() {
        $shortened = str_shuffle('QwErT');

        if(Url::whereShortened($shortened)->count() > 0) {
            return get_unique_short_url();
        }

        return $shortened;
    }

    $row = Url::create([
        'url' => request('url'),
        'shortened' => get_unique_short_url()
    ]);

    if($row) {
        return view('result')->withShortened($row->shortened);
    }

    // félicitation voiçi l'url raccourcie
});

Route::get('/{shortened}', function ($shortened) {
    $url = Url::where('shortened', $shortened)->first();
    if(! $url) {
        return redirect('/');
    } else {
        return redirect($url->url);
    }
});