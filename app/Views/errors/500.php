<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error</title>

    <!-- Tailwind CDN (Dev only) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

    <div class="max-w-lg w-full bg-white rounded-2xl shadow-lg p-8 text-center">

        <!-- Icon -->
        <div class="text-red-500 text-6xl mb-4">
            ⚠️
        </div>

        <!-- Error Code -->
        <h1 class="text-6xl font-extrabold text-gray-800 mb-2">
            500
        </h1>

        <!-- Title -->
        <h2 class="text-2xl font-semibold text-gray-700 mb-3">
            Internal Server Error
        </h2>

        <!-- Message -->
        <p class="text-gray-600 mb-6 leading-relaxed">
            Oops! Something went wrong on our side.
            Our team has been notified and is working to fix the issue.
            Please try again later.
        </p>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-3 justify-center">

            <!-- Home -->
            <a href="/"
                class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-medium
                    hover:bg-indigo-700 transition shadow-md">

                Go Home
            </a>

            <!-- Reload -->
            <button onclick="location.reload()"
                    class="border border-gray-300 text-gray-700 px-6 py-3 rounded-lg
                        hover:bg-gray-100 transition">

                Try Again
            </button>

        </div>

    </div>

</body>
</html>
