/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,php}"],
  theme: {
    extend: {
      colors: {
        primary: '#FC972F',
        secondary: '#1C83DD',
        white: '#FFFFFF',
        red: '#e74c3c',     // Rojo Vivo
        yellow: '#f1c40f',  // Amarillo Suave
        gray: '#34495e',    // Gris Oscuro
    },
    fontFamily: {
        sans: ['Poppins', 'sans-serif'],
    },
    fontSize: {
        'title': '2.5rem',       // Tamaño para títulos principales
        'subtitle': '1.875rem',  // Tamaño para subtítulos
        'heading': '1.5rem',     // Tamaño para encabezados
        'body': '1rem',          // Tamaño para texto del cuerpo
        'small': '0.875rem',
      },
      },
    },
  plugins: [],
}

