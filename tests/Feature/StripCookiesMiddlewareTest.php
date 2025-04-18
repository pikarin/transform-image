<?php

use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

it('strips set-cookie from the response', function () {
    Route::any('/_test/images', fn () => response('Image Content'))
        ->name('images.show')
        ->middleware(['web']);

    $response = get('/_test/images');

    $response->assertOk();

    $response->assertHeaderMissing('Set-Cookie');
});

it('does not strip set-cookie from other routes', function () {
    Route::any('/_test/other', fn () => response('Success'))
        ->name('test.other')
        ->middleware(['web']);

    $response = get('/_test/other');

    $response->assertOk();

    $response->assertHeader('Set-Cookie');
});
