var path = require('../routes');

var gulp     = require('gulp'),
    imagemin = require('gulp-imagemin'),
    svgmin   = require('gulp-svgmin'),
    changed  = require('gulp-changed');


/*
 |--------------------------------------------------------------------------
 | Image Build
 |--------------------------------------------------------------------------
 */
gulp.task('images', function() {
  gulp.src(path.imageDevPath)
    .pipe(changed(path.imageDistPath))
    .pipe(imagemin())
    .pipe(gulp.dest(path.imageDistPath));
});

/*
 |--------------------------------------------------------------------------
 | Vector Build
 |--------------------------------------------------------------------------
 */
gulp.task('svg', function() {
  gulp.src(path.svgDevPath)
    .pipe(changed(path.svgDistPath))
    .pipe(svgmin())
    .pipe(gulp.dest(path.svgDistPath));
});
