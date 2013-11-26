module.exports = function(grunt) {

  grunt.initConfig({
    coffee: {
      app: {
        expand: true,
        cwd: 'src/js',
        src: ['**/*.coffee'],
        dest: '.tmp/js',
        ext: '.js'
      }
    },
    uglify: {
      options: {
        banner: '/*! Built with Grunt */',
        compress: false
      },
      app: {
        src: ['.tmp/**/*.js'],
        dest: 'app/js/application.js',
      }
    },
    less: {
      production: {
        options: {
          yuicompress: true,
          concat: false
        },
        src: 'src/css/*.less',
        dest: 'app/css',
      }
    },
    concurrent: {
      build: ['coffee', 'less']
    },
    clean: ['.tmp']
  });

  grunt.loadNpmTasks('grunt-concurrent');
  grunt.loadNpmTasks('grunt-contrib-coffee');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-clean');

  grunt.registerTask('default', ['concurrent', 'uglify', 'clean']);

};