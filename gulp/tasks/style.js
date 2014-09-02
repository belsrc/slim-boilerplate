var gulp    = require('gulp'),
    sass    = require('gulp-sass'),
    prefix  = require('gulp-autoprefixer'),
    rename  = require('gulp-rename'),
    csslint = require('gulp-csslint'),
    cssmin  = require('gulp-minify-css');

var path = './assets/sass';
var scss = [path + '/app.scss'];

gulp.task('styles.dev', function() {
  gulp.src(scss)
    .pipe(sass({
      errLogToConsole: true,
      outputStyle: 'compressed'
    }))
    .pipe(prefix("last 4 version", "ie 8"))
    // .pipe(csslint('./app/assets/styles/csslintrc.json'))
    // .pipe(csslint.reporter())
    // .pipe(cssmin())
    .pipe(rename('app.min.css'))
    .pipe(gulp.dest('./public/css/'));
});

gulp.task('styles.build', function() {
  gulp.src(scss)
    .pipe(sass({
      errLogToConsole: false,
      outputStyle: 'compressed'
    }))
    .pipe(prefix("last 4 version", "ie 8"))
    .pipe(cssmin())
    .pipe(rename('app.min.css'))
    .pipe(gulp.dest('./public/css/'));
});
