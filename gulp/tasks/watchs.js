var gulp = require('gulp');
var path = require('../routes');


gulp.task('watch', function() {
  gulp.watch(path.sassWatchPath, ['styles.build']);
  gulp.watch(path.jsWatchPath, ['scripts.dev']);
});