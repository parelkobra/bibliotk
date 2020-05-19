
var gulp = require('gulp');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var del = require('del');
var chokidar = require('chokidar');

function clean(cb) {
    del(['public/css', 'public/font', 'public/js', 'public/images'], cb);
}

gulp.task('styles', function() {
    return gulp.src('resources/assets/sass/app.scss')
        .pipe(sass())
        .pipe(gulp.dest('public/css'));
});

gulp.task('scripts', function() {
    return gulp.src('resources/assets/js/*.js')
        .pipe(uglify())
        .pipe(gulp.dest('public/js'));
});

gulp.task('images', function() {
    return gulp.src('resources/assets/images/**/*')
        .pipe(gulp.dest('public/images'));
});

gulp.task('fonts', function() {
    return gulp.src('resources/assets/fonts/**/*')
        .pipe(gulp.dest('public/fonts'));
});

function watch() {
    gulp.watch('resources/assets/js/*.js', gulp.parallel('scripts'));
    gulp.watch('resources/assets/sass/*.scss', gulp.parallel('styles'));
}

var all = gulp.parallel('styles', 'scripts', 'images', 'fonts');

gulp.task('default', gulp.series(clean, all));
gulp.task('watch', gulp.series(clean, all, watch));
