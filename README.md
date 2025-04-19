# Transform Image Web App

This web application provides a single endpoint for transforming images. Below is a guide on how to use the application.

## Usage

### Endpoint
The application exposes the following endpoint:

```
GET /images/{options}/{path}
```

### Parameters
- **options**: A comma-separated list of key-value pairs specifying the transformation options. For example, `width=300,height=200`.
- **path**: The relative path to the image file. This should include the file name and extension (e.g., `sample.jpg`).

### Example Request
To resize an image to a width of 300 pixels and a height of 200 pixels, you can make a request like this:

```
GET /images/width=300,height=200/sample.jpg
```

### Notes
- Ensure the image file exists in the `public/images/` directory.
- The application uses the `Intervention Image` library for image transformations.

## Development

### Prerequisites
- PHP
- Composer
- Laravel Framework

### Running the Application
1. Clone the repository.
2. Install dependencies using Composer:
   ```
   composer install
   ```
3. Start the development server:
   ```
   php artisan serve
   ```
4. Access the application at `http://localhost:8000`.

## License
This project is open-source and available under the [MIT License](LICENSE).

## Credits

This repository is inspired by the blog post [A Cookieless Cache-Friendly Image Proxy in Laravel Inspired by Cloudflare](https://aaronfrancis.com/2025/a-cookieless-cache-friendly-image-proxy-in-laravel-inspired-by-cloudflare-9e95f7e0) by Aaron Francis.
