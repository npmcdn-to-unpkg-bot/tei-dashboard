var gulp = require('gulp');
var gutil = require('gulp-util');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');


gulp.task('styles', function() {
    
    gulp.src('./assets/sass/*.scss')
        .pipe(sourcemaps.init())  // Process the original sources
            .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write()) // Add the map to modified source.
        .pipe(gulp.dest('./assets/css/'));
        return gutil.log('processing SCSS');
});
//Watch task
gulp.task('default', function() {
    
    gulp.watch('./assets/sass/*.scss', ['styles']);
    return gutil.log('Gulp is watching!');
});
