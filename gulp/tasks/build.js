var gulp = require('gulp');

gulp.task( 'build', ['styles.build', 'scripts.build', 'images', 'svg'] );
gulp.task( 'default', ['styles.dev', 'scripts.dev', 'images', 'svg', 'watch'] );
