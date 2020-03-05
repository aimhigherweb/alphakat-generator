//Variables
const gulp = require('gulp'),
sass = require('gulp-sass'),
sourcemaps = require('gulp-sourcemaps')

//File Paths
const sassFiles = 'source/scss/**/*.scss',
	mainSassFile = 'source/scss/style.scss',
	cssFiles = 'styles/'
//Compile main sass into css
function sassy() {
	return gulp
		.src(mainSassFile)
		.pipe(sass().on('error', sass.logError)) //Using gulp-sass
		.pipe(gulp.dest(cssFiles))
}

//Watch for changes in sass files and running sass compile

function watch() {
	gulp.watch(sassFiles, sassy)
	gulp.watch([
		'./source/scss/**/*.scss',
	])
}

exports.sassy = sassy
exports.watch = watch
