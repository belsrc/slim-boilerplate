var root = './assets/';

module.exports = {
  jsDevPath: [root + 'assets/js/lib/*.js', root + 'assets/js/modules/*.js'],
  jsWatchPath: root + 'js/**/*.js',
  jsDistPath: './public/js/',

  sassDevPath: root + 'sass/app.scss',
  sassWatchPath: [root + 'sass/app.scss', root + 'sass/**/*.scss'],
  sassDistPath: './public/css',
};