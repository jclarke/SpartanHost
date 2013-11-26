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
        files: [{
          expand: true,
          cwd: '.tmp/js',
          src: ['*.js'],
          dest: 'app/js',
          ext: '.js'
        }, {
          src: ['bower_components/bootstrap/dist/js/bootstrap.js'],
          dest: 'app/js/bootstrap.js'
        }]
      }
    },
    less: {
      app: {
        options: {
          yuicompress: true,
          concat: false
        },
        files: [{
          expand: true,
          cwd: 'src/css',
          src: ['*.less'],
          dest: 'app/css',
          ext: '.css'
        }]
      }
    },
    copy: {
      template: {
        files: [{
          expand: true,
          src: ['src/*.mustache'],
          dest: 'app/template'
        }]
      },
      php: {
        files: [{
          expand: true,
          cwd: 'php',
          src: ['**'],
          dest: 'app'
        }]
      }
    },
    imagemin: {
      app: {
        options: {
          removeComments: true
        },
        files: [{
          expand: true,
          cwd: 'src/img',
          src: ['{,*/}*.{png,jpg,jpeg}'],
          dest: 'app/img',
        }]
      }
    },
    concurrent: {
      build: ['coffee', 'less', 'copy:template', 'imagemin'],
      postbuild: ['copy:php', 'uglify']
    },
    clean: {
      pre: ['app'],
      post: ['.tmp']
    }
  });

  grunt.loadNpmTasks('grunt-concurrent');
  grunt.loadNpmTasks('grunt-contrib-coffee');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-imagemin');

  grunt.registerTask('default', ['clean:pre', 'concurrent:build', 'concurrent:postbuild', 'clean:post']);

};