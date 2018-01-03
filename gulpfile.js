const gulp = require('gulp');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const uglify = require('gulp-uglifyjs');
const del = require('del');
const rename = require('gulp-rename');
const cleanCSS = require('gulp-clean-css');
const imageMin = require('gulp-imagemin');
const quantPNG = require('imagemin-pngquant');
const cache = require('gulp-cache');
const babel = require('gulp-babel');
const autoprefixer = require('gulp-autoprefixer');
const browserSync = require('browser-sync');
const errorHandler = require('gulp-error-handle');
const pug = require('gulp-pug');
const minify = require('gulp-minify');
gulp.task('styles', () => {
	return gulp.src('static/sass/**/*.+(sass|scss)')
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
		proxy: "anmary/",
		notify: false
	});
});

gulp.task('libs', () => {
	return gulp.src([
		'./static/libs/jquery-3.2.1.min.js',
		'./static/libs/jquery.simplePagination.js',
		'./static/libs/jquery.zoom.min.js',
		'./static/libs/responsiveslides.min.js',
		'./static/libs/polyfill.object-fit.min.js',
		'./static/libs/aos.js'
	])
	.pipe(concat('libs.min.js'))
	.pipe(uglify())
	.pipe(gulp.dest('./static/js/'));
});

gulp.task('script', () => {
	return gulp.src(['static/js/dev/**/*.js', '!static/js/dev/libs.min.js'])
		.pipe(errorHandler())
        .pipe(babel({
            presets: ['es2015']
        }))
	    .pipe(minify({
	    	ext:{
            	min:'.js'
        	},
	    	noSource: true
	    }))
        .pipe(gulp.dest('static/js/'));
})

gulp.task('watch', ['browser-sync', 'styles', 'libs', 'script'], () => {
	gulp.watch('static/sass/**/*.+(sass|scss)', ['styles']);
	gulp.watch('static/libs/**/*.js', ['libs']);
	gulp.watch('static/js/dev/*.js', ['script']);
	gulp.watch('views/**/*.php').on('change', browserSync.reload);
});

gulp.task('default', ['browser-sync', 'watch']);
