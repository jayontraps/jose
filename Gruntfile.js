module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),

    jshint: {
      options: {
        eqeqeq: true,
        curly: true,
        undef: false,
        unused: false
      },
      target: {
        src: ['dev_scripts/main.js']               
      }
    },    
  
    concat: {
      dist: {
        src: ['dev_scripts/jquery.cookie.js', 'dev_scripts/jquery.fitvids.js', 'dev_scripts/scripts.js', 'dev_scripts/main.js'],
        dest: 'build_scripts/built.js',
      },
    },

    uglify: {
      build: {
        src: ['build_scripts/built.js'],
        dest: 'build_scripts/built.min.js'
      }
    },

  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-jshint');   
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-concat');


  // Default task(s).
  grunt.registerTask('default', ['jshint', 'concat', 'uglify']);

};