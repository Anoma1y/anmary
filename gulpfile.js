const gulp 			= require('gulp');
const sass 			= require('gulp-sass');
const concat 		= require('gulp-concat');
const uglify 		= require('gulp-uglifyjs');
const del 			= require('del');
const rename 		= require('gulp-rename');
const cleanCSS 		= require('gulp-clean-css');
const imageMin 		= require('gulp-imagemin');
const quantPNG 		= require('imagemin-pngquant');
const cache 		= require('gulp-cache');
const babel 		= require('gulp-babel');
const autoprefixer  = require('gulp-autoprefixer');
const browserSync 	= require('browser-sync');

gulp.task('styles', () => {
	return gulp.src('static/sass/*.+(sass|scss)')
	.pipe(sass({
		includePaths: require('node-bourbon').includePaths
	 }).on('error', sass.logError))
	.pipe(rename({suffix: '.min', prefix : ''}))
	.pipe(autoprefixer(['last 15 versions', 'ie 8', 'ie 7'], { cascade: true }))
	.pipe(cleanCSS())
	.pipe(gulp.dest('static/css/'))
	.pipe(browserSync.reload({stream: true}))
});

gulp.task('browser-sync', () => {
	browserSync.init({
		proxy: "site.loc/",
		notify: false
	});
});

gulp.task('libs', () => {
	return gulp.src([
		'./static/libs/modernizr/modernizr.js',
		'./static/libs/jquery/jquery-1.11.2.min.js',
		'./static/libs/animate/animate-css.js',
	])
	.pipe(concat('libs.min.js'))
	.pipe(uglify())
	.pipe(gulp.dest('./static/js/'));
});

gulp.task('script', () => {
	return gulp.src('static/js/index.js')
        .pipe(babel({
            presets: ['es2015']
        }))
        .pipe(gulp.dest('static/js/es5'));
})

gulp.task('watch', ['browser-sync', 'styles', 'libs', 'script'], () => {
	gulp.watch('static/sass/*.+(sass|scss)', ['styles']);
	gulp.watch('static/libs/**/*.js', ['libs']);
	gulp.watch('static/js/*.js').on("change", browserSync.reload);
	gulp.watch('views/**/*.php').on('change', browserSync.reload);
});

gulp.task('default', ['browser-sync', 'watch']);
