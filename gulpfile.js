const { src, dest, watch , series, parallel } = require('gulp');

// CSS
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('autoprefixer');
const postcss    = require('gulp-postcss')
const sourcemaps = require('gulp-sourcemaps')
const cssnano = require('cssnano');

// Javascript
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');
const rename = require('gulp-rename');

// Imagenes
const imagemin = require('gulp-imagemin'); // Minificar imagenes 
const notify = require('gulp-notify');
const cache = require('gulp-cache');
const clean = require('gulp-clean');
const webp = require('gulp-webp');
const avif = require('gulp-avif');

// Webpack
const webpack = require('webpack-stream');

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*'
}

// css es una función que se puede llamar automaticamente
function css() {
    return src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        // .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write('.'))
        .pipe( dest('public/build/css') );
}


function javascript() {
    return src(paths.js)
      .pipe(webpack({
        mode: 'production',
        entry: './src/js/app.js'
      }))
      .pipe(terser())
      .pipe(sourcemaps.write('.'))
      .pipe(rename({ suffix: '.min' }))
      .pipe(dest('public/build/js'));
}

function imagenes() {
    return src(paths.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3})))
        .pipe(dest('public/build/img'))
        .pipe(notify({ message: 'Imagen Completada'}));
}

function versionWebp() {
    return src(paths.imagenes)
        .pipe( webp() )
        .pipe(dest('public/build/img'))
        .pipe(notify({ message: 'Imagen Completada'}));
}

function versionAvif() {
    const opciones = {
        quality: 50
    };
    return src('src/img/**/*.{png,jpg}')
        .pipe( avif(opciones) )
        .pipe( dest('public/build/img') );
}


function watchArchivos() {
    watch( paths.scss, css );
    watch( paths.js, javascript );
    watch( paths.imagenes, imagenes );
    watch( paths.imagenes, versionWebp );
    watch( paths.imagenes, versionAvif );
}
  
exports.css = css;
exports.watchArchivos = watchArchivos;
exports.default = parallel(css, javascript,  imagenes, versionWebp, versionAvif, watchArchivos ); 