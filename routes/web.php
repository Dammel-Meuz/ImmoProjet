<?php

use App\Models\User;
use App\Models\Contact;
use App\Models\Favorite;
use App\Models\Propertie;
use App\Models\TypeProperty;
use App\Models\ProgramerVisite;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CiteController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ImageBienController;
use App\Http\Controllers\PropertieController;
use App\Http\Controllers\TypePropertyController;
use App\Http\Controllers\ProgramerVisiteController;

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
Route::get('/',[AccueilController::class,'index'])->name('accueil.index');
// Route::get('/', function () {
//     return view('Accueil.accueil' , compact('nom'));
// })->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard12');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard12');
//     });
// });
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard12',
        [
        'disponibles' => Propertie::where('status', 'disponible')->count(),
        'contactsEnAttente' => Contact::where('status', 'en_attente')->count(),
        'lastContacts' => Contact::latest()->take(5)->get(),
        'visitesAVenir' => ProgramerVisite::where('visit_date', '>', now())->count(),
        'nextVisites' => ProgramerVisite::where('visit_date', '>', now())->orderBy('visit_date')->take(5)->get(),
        'totalFavoris' => Favorite::count(),
        'agents' => User::where('role', 'agent')->count(),
        'typesActifs' => TypeProperty::where('is_active', true)->count(),
        'lastProperties' => Propertie::latest()->take(5)->get()
    ]
    );

   

    })->name('dashboard.admin');
    Route::resource('type_properties', TypePropertyController::class);
    Route::resource('properties', PropertieController::class);
    Route::resource('images', ImageBienController::class);
});


Route::resource('contacts', ContactController::class);
Route::resource('programer_visites', ProgramerVisiteController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/favoris', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favoris', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favoris/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});



Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent', function () {
        return view('agent.dashboard12');
    });
});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard12');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// client routes
Route::view('/client/register', 'client.register')->name('client.register');
Route::view('/client/login', 'client.login')->name('client.login');

require __DIR__.'/auth.php';
