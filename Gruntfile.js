module.exports = function(grunt) {
    'use strict';

    require('time-grunt')(grunt);

    require('load-grunt-config')(grunt, {
        jitGrunt:  {
            staticMappings: {
                
            }
        },
        data: {
            pkg: grunt.file.readJSON('package.json')
        }
    });

    grunt.task.registerTask('readpkg', 'Read in the package.json file', function() {
        grunt.config.set('pkg', grunt.file.readJSON('package.json'));
    });
};