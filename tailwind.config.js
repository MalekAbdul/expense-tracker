/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                glass: "rgba(255, 255, 255, 0.1)",
            },
        },
    },
    plugins: [],
}
