/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',
    './assets/src/**/*.css',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        'ct-blue': '#173a6a',
        'ct-dark': '#58606d',
      },
    },
  },
  plugins: [],
};
