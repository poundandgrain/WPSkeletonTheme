/*global module:false*/
module.exports = function (grunt) {

    // Project configuration.
    grunt.initConfig({

        // Metadata.
        pkg: grunt.file.readJSON('package.json'),
        banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
            '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
            '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
            '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
            ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',

        concat: {
            options: {},
            dist: {
                src: ['assets/js/*.js', '!assets/js/scripts.min.js'],
                dest: 'assets/js/scripts.min.js'
            }

        },

        uglify: {
            options: {},
            dist: {
                src: '<%= concat.dist.dest %>',
                dest: '<%= concat.dist.dest %>'
            },
            home: {
                src: '<%= concat.home.dest %>',
                dest: '<%= concat.home.dest %>'
            }
        },

        cssmin: {
            css: {
                src: 'assets/css/main.css',
                dest: 'assets/css/main.css'
            }
        },

        jshint: {
            options: {
                curly: true,
                eqeqeq: true,
                immed: true,
                latedef: true,
                newcap: true,
                noarg: true,
                sub: true,
                undef: true,
                unused: true,
                boss: true,
                eqnull: true,
                browser: true,
                devel: true,
                globals: {}
            },
            gruntfile: {
                src: 'Gruntfile.js'
            },
            lib_test: {
                src: ['assets/js/*.js']
            },
            ignore: []


        },

        watch: {
            scripts: {
                files: ['assets/sass/*.scss', 'assets/js/*.js', '!assets/js/scripts.min.js', 'Gruntfile.js'],
                tasks: ['sass', 'concat']
            }
        },

        sass: {                                                         // Task
            dist: {                                                     // Target
                options: {                                              // Target options
                    style: 'expanded'
                },
                files: {                                                // Dictionary of files
                    'assets/css/main.min.css': 'assets/sass/app.scss'  // 'destination': 'source'
                }
            }
        },

        svgmin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: 'assets/icons',
                    src: ['*.svg'],
                    dest: 'assets/icons'
                }]
            }
        },

        // Put svg icons into assets/icons and the css will be generated e.g logo.svg will get a class of .icon-logo
        // Uses image fallbacks for IE8!
        grunticon: {
            pov: {
                files: [{
                    expand: true,
                    cwd: 'assets/icons',
                    src: ['*.svg', '*.png'],
                    dest: "assets/img/icons"
                }],
                options: {
                }
            }
        },

        pngmin: {
            compile: {
                options: {
                    ext: '.png'
                    //binary: '/usr/local/Cellar/pngquant/2.2.0/bin/pngquant'
                },
                files: [
                    {
                        expand: true,
                        cwd: 'assets/pngs',
                        src: ['*.png'],
                        dest: 'assets/img'
                    }
                ]
            }
        }
    });

    // These plugins provide necessary tasks.
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-svgmin');
    grunt.loadNpmTasks('grunt-grunticon');
    grunt.loadNpmTasks('grunt-pngmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-qunit');
    grunt.loadNpmTasks('grunt-contrib-watch');


    // Default task.
    grunt.registerTask('default', ['sass', 'svgmin', 'grunticon:pov', 'pngmin', 'concat' ]);

    // Uglify
    grunt.registerTask('deploy', ['sass', 'svgmin', 'grunticon:pov', 'pngmin', 'concat', 'uglify', 'cssmin' ]);

};
