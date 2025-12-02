/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
      "./storage/framework/views/*.php",
      "./resources/views/**/*.blade.php",
    ],
  theme: {
    extend: {}, animation: {
    'ping-slow': 'ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite',
},

  },
  plugins: [],
}
