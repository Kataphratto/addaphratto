require('es6-promise').polyfill();

module.exports = function(grunt) {
	'use strict';

	var devPath = 'modules/';
	var distPath = 'assets/';

	var devConfigPath = {
		css: devPath + '/css',
		js:  devPath + '/js',
	};

	var distConfigPath = {
		css: distPath + '/css',
		js:  distPath + '/js',
	};

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        webpack: {

            dist: require('./webpack.config.js')

        },

        postcss: {

            default: {

                options: {
                    processors: [
                        require('postcss-import')({
                            path:[
                                devConfigPath.css + '/'
                            ]
                        }),
                        require('postcss-mixins')(),
                        require('postcss-simple-vars')({
                            silent: true
                        }),
                        require('postcss-conditionals')(),
                        require('postcss-nested')(),
                        require('postcss-extend')(),
                        require('postcss-sass-colors')(),
                        require('postcss-object-fit-images')(),
                        require('autoprefixer')({})
                    ]
                },
                src:    devConfigPath.css + '/styles.css',
                dest:   distConfigPath.css + '/styles.css'
            }

        },

        watch: {
            scripts: {
                files: [devConfigPath.css + '/**/*.css'],
                tasks: ['postcss'],
                options: {
                    interrupt: false,
                    livereload: true
                }
            }
        }

    });

    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-webpack-without-server');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['postcss']);

}
