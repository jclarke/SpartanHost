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
          cwd: 'src',
          src: ['*.mustache'],
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
      },
      post: {
        src: 'app/css/style.css',
        dest: 'whmcs/spartan.css'
      },
      packageout: {
        files: [{
          expand: true,
          cwd: 'app',
          src: ['**'],
          dest: 'package/main'
        }, {
          expand: true,
          cwd: 'whmcs',
          src: ['**'],
          dest: 'package/whmcs/templates/spartan'
        }, {
          expand: true,
          cwd: 'multicraft',
          src: ['**'],
          dest: 'package/multicraft'
        }]
      }
    },
    shell: {
      composer: {
        command: 'composer update',
        options: {
          stdout: true,
          execOptions: {
            cwd: 'package/main'
          }
        }
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
  grunt.loadNpmTasks('grunt-shell');

  grunt.registerTask('default', ['clean:pre', 'concurrent:build', 'concurrent:postbuild', 'copy:post', 'clean:post']);
  grunt.registerTask('package', ['default', 'copy:packageout', 'shell:composer']);

};