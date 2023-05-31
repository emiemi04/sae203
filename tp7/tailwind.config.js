/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,php}"],
  theme: {
    colors: {
      'blue': '#1fb6ff',
    },
    extend: {
      spacing: {
        '8xl': '96rem',
        '9xl': '128rem',
    },
  },
  plugins: [],
}
}
