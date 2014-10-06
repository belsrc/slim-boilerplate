var root = './assets/';

module.exports = {
  jsDevPath:   [root + 'js/lib/*.js', root + 'js/modules/*.js', root + 'js/*.js'],
  jsWatchPath: root + 'js/**/*.js',
  jsDistPath:  './public/js/',

  sassDevPath:   root + 'sass/app.scss',
  sassWatchPath: root + 'sass/**/*.scss',
  sassDistPath:  './public/css',

  imageDevPath:   root + 'img/**/*.{jpg,png}',
  imageWatchPath: root + 'img/**/*.{jpg,png}',
  imageDistPath:  './public/img',

  svgDevPath:   root + 'img/**/*.svg',
  svgWatchPath: root + 'img/**/*.svg',
  svgDistPath:  './public/img',
};
