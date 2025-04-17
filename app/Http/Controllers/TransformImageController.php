<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\Encoders\WebpEncoder;
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

        if (Arr::hasAny($options, ['width', 'height'])) {
            $width = $options['width'] ?? null;
            $height = $options['height'] ?? null;

            $image->scaleDown($width, $height);
        }

        $format = Arr::get($options, 'format', File::extension($path));
        $quality = (int) Arr::get($options, 'quality', 100);

        $encoder = match (strtolower($format)) {
            'png' => new PngEncoder,
            'webp' => new WebpEncoder($quality),
            default => new JpegEncoder($quality),
        };

        $encoded = $image->encode($encoder);

        return response($encoded, 200)
            ->header('Content-Type', $encoded->mimetype())
            ->header('Cache-Control', 'public, max-age=2592000, s-maxage=2592000, immutable');
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
