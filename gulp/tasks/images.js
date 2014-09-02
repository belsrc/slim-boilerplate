// var gulp     = require('gulp'),
//     imagemin = require('gulp-imagemin'),
//     svgmin   = require('gulp-svgmin'),
//     changed  = require('gulp-changed');

// var path  = './app/assets/images';
// var imgSrc = [path + '/*.png', path + '/*.jpg', path + '/**/*.png', path + '/**/*.jpg'];
// var svgSrc = [path + '/*.svg', path + '/**/*.svg'];

// gulp.task('images', function() {
//   gulp.src(imgSrc)
//     .pipe(changed('./public/img/'))
//     .pipe(imagemin())
//     .pipe(gulp.dest('./public/img/'));
// });

// gulp.task('svg', function() {
//   gulp.src(svgSrc)
//     .pipe(changed('./public/img/'))
//     .pipe(svgmin())
//     .pipe(gulp.dest('./public/img/'));
// });
