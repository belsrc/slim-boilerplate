var path = require('../routes');

var gulp    = require('gulp'),
    sass    = require('gulp-sass'),
    prefix  = require('gulp-autoprefixer'),
    rename  = require('gulp-rename'),
    csslint = require('gulp-csslint'),
    cssmin  = require('gulp-minify-css');


/*
 |--------------------------------------------------------------------------
 | Development Build
 |--------------------------------------------------------------------------
 */
gulp.task('styles.dev', function() {
  gulp.src(path.sassDevPath)
    .pipe(sass({
      errLogToConsole: true,
      outputStyle: 'expanded'
    }))
    .pipe(prefix("last 4 version", "ie 8"))
    .pipe(csslint('./assets/sass/csslintrc.json'))
    .pipe(csslint.reporter())
    .pipe(rename('app.min.css'))
    .pipe(gulp.dest(path.sassDistPath));
});

/*
 |--------------------------------------------------------------------------
 | Production Build
 |--------------------------------------------------------------------------
 */
gulp.task('styles.build', function() {
  gulp.src(path.sassDevPath)
    .pipe(sass({
      errLogToConsole: false,
      outputStyle: 'compressed'
    }))
    .pipe(prefix("last 4 version", "ie 8"))
    .pipe(cssmin())
    .pipe(rename('app.min.css'))
    .pipe(gulp.dest(path.sassDistPath));
});
