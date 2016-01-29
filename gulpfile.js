var gulp = require('gulp');
var gutil = require('gulp-util');
var sass = require('gulp-sass');

gulp.task('styles', function() {
    
    gulp.src('./assets/sass/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./assets/css/'));
        return gutil.log('processing SCSS');
});
//Watch task
gulp.task('default', function() {
    
    gulp.watch('./assets/sass/*.scss', ['styles']);
    return gutil.log('Gulp is watching!');
});
