var gulp = require('gulp');

gulp.task( 'build', ['styles.build', 'scripts.build'] );
gulp.task( 'default', ['styles.dev', 'scripts.dev', 'watch'] );
