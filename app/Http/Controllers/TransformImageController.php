<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

class TransformImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $options, string $path)
    {
        $path = public_path($path);

        abort_unless(File::exists($path), 404);

        $options = $this->parseOptions($options);

        $image = Image::read($path);
    }

    protected function parseOptions(string $options): array
    {
        return collect(explode(',', $options))
            ->mapWithKeys(function ($option) {
                [$key, $value] = explode('=', $option);

                return [$key => $value];
            })
            ->toArray();
    }
}
