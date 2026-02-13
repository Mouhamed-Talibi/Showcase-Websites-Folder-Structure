<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>

    <!-- Tailwind CDN (for dev, use build in production) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">

    <div class="max-w-lg text-center bg-white p-8 rounded-2xl shadow-lg">

        <!-- Error Code -->
        <h1 class="text-7xl font-extrabold text-indigo-600 mb-4">
            404
        </h1>

        <!-- Title -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">
            Page Not Found
        </h2>

        <!-- Description -->
        <p class="text-gray-600 mb-6">
            Sorry, the page you are looking for doesn’t exist or has been moved.
        </p>

        <!-- Back Button -->
        <a href="<?php echo PUBLIC_PATH ?>"
            class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg font-medium
                hover:bg-indigo-700 transition duration-200 shadow-md">

            ← Back to Home
        </a>

    </div>

</body>
</html>
