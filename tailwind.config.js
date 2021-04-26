const colors = require('tailwindcss/colors')
module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
    colors:{
      "primary":"#6CFBA9",
      "secondary":"#1E2036",
      "lightblue":"#2FA2F7",
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      green: colors.green,
      gray: colors.trueGray,
      indigo: colors.indigo,
      red: colors.rose,
      yellow: colors.amber,
    }
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
