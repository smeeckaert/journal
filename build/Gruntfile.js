module.exports = function (grunt) {

    grunt.initConfig({
        uglify: {
            build: {
                options: {
                    sourceMap    : true,
                    sourceMapName: '../htdocs/static/map/sourcemap.map'
                },
                files  : {
                    '../htdocs/static/js/build.min.js': [
                        '../htdocs/static/js/libs/*.js',
                        '../htdocs/static/js/**/*.js']
                }
            }
        },
        sass  : {
            options: {
                sourceMap: true
            },
            dist   : {
                files: {
                    '../htdocs/static/css/template.css': '../assets/scss/template.scss'
                }
            }
        },
        watch : {
            //js  : {
            //   files: ['../htdocs/static/js/**/*.js'],
            //   tasks: ['uglify']
            //},
            sass: {
                files: ['../assets/scss/**/*.scss'],
                tasks: ['sass']
            }
        }
    });
    grunt.loadNpmTasks("grunt-sass");
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-compass');

    grunt.registerTask('default', ['uglify', 'sass']);

};