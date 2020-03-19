//Variables
const gulp = require('gulp'),
sass = require('gulp-sass'),
zip = require('gulp-zip')

//File Paths
const sassFiles = 'source/scss/**/*.scss',
	mainSassFile = 'source/scss/style.scss',
	cssFiles = 'styles/',
	buildFiles = ['functions', 'styles', 'includes', 'img', 'scripts']


//Compile main sass into css
function sassy() {
	return gulp
		.src(mainSassFile)
		.pipe(sass().on('error', sass.logError)) //Using gulp-sass
		.pipe(gulp.dest(cssFiles))
}

//Watch for changes in sass files and running sass compile

function watch() {
	sassy();

	gulp.watch(sassFiles, sassy)
	gulp.watch([
		'./source/scss/**/*.scss',
	])
}

function build() {
	sassy();

	buildFiles.forEach(file => {
		gulp.src(`${file}/*`)
	.pipe(gulp.dest(`./dist/${file}`))
	})

	gulp.src('./index.php')
		.pipe(gulp.dest('./dist/'))

	return gulp.src('./dist/**')
		.pipe(zip('alphakat.zip'))
		.pipe(gulp.dest('.'))
}

exports.sassy = sassy
exports.watch = watch
exports.build = build