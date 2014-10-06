var path = require('../routes');

var gulp   = require('gulp'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    jshint = require('gulp-jshint');


/*
 |--------------------------------------------------------------------------
 | Development Build
 |--------------------------------------------------------------------------
 */
gulp.task('scripts.dev', function() {
  gulp.src(path.jsDevPath)
    .pipe(concat('app.min.js'))
    .pipe(jshint('./assets/js/.jshintrc'))
    .pipe(gulp.dest(path.jsDistPath));
});

/*
 |--------------------------------------------------------------------------
 | Production Build
 |--------------------------------------------------------------------------
 */
gulp.task('scripts.build', function() {
  gulp.src(path.jsDevPath)
    .pipe(concat('app.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest(path.jsDistPath));
});
