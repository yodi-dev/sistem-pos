/** @type {import('tailwindcss').Config} */

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/masmerise/livewire-toaster/resources/views/*.blade.php',
        "./vendor/robsontenorio/mary/src/View/Components/**/*.php"
    ],

    plugins: [
        require("daisyui")
    ],
    daisyui: {
        themes: ["pastel", "dim"],
    },
    darkMode: ['class', '[data-theme="dim"]']
};
