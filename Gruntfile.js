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
    htmlmin: {
      app: {
        options: {
          removeComments: true
        },
        files: [{
          expand: true,
          cwd: 'src',
          src: ['**/*.html'],
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
      build: ['coffee', 'less', 'htmlmin', 'imagemin']
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
  grunt.loadNpmTasks('grunt-contrib-htmlmin');
  grunt.loadNpmTasks('grunt-contrib-imagemin');

  grunt.registerTask('default', ['clean:pre', 'concurrent', 'uglify', 'clean:post']);

};