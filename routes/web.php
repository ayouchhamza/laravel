<?php
use App\Http\Controllers\OffreController;





// Route pour afficher le formulaire
Route::get('/recherche', [OffreController::class, 'showForm'])->name('offres.formulaire');

// Route pour effectuer la recherche d'offres par adresse
Route::post('/recherche/adresse', [OffreController::class, 'search'])->name('offres.adresse');


