var gulp   = require('gulp'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    jshint = require('gulp-jshint');

var path = './assets/js/';
var js = [path + 'lib/*.js', path + '*.js'];

gulp.task('scripts.dev', function() {
  gulp.src(js)
    .pipe(concat('app.min.js'))
    // .pipe(jshint('./app/assets/scripts/.jshintrc'))
    .pipe(gulp.dest('./public/js/'));
});

gulp.task('scripts.build', function() {
  gulp.src(js)
    .pipe(concat('app.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./public/js/'));
});
