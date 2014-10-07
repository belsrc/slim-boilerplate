var gulp = require('gulp');
var path = require('../routes');


gulp.task('watch', function() {
  gulp.watch(path.sassWatchPath, ['styles.build']);
  gulp.watch(path.jsWatchPath, ['scripts.dev']);
  gulp.watch(path.svgWatchPath, ['svg']);
  gulp.watch(path.imagesWatchPath, ['images']);
});
