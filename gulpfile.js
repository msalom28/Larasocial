var gulp 	= require('gulp'),
	uglify	= require('gulp-uglify'),
	sass	= require('gulp-ruby-sass'),
	concat	= require('gulp-concat'),
	minify	= require('gulp-clean-css');


//Display error messages 
function errorLog(error)
{
	console.error.bind(error);
	this.emit('end');
}


//scriptLibs Task
//Concat and uglify script libraries
gulp.task('scriptLibs', function(){
	gulp.src([
		'bower_components/jquery/dist/jquery.js',
		'bower_components/jqueryui/jquery-ui.js', 
		'bower_components/bootstrap/dist/js/bootstrap.js',
		'bower_components/bootstrap-switch/dist/js/bootstrap-switch.js',
		'bower_components/jquery-timeago/jquery.timeago.js'])
	.pipe(uglify())
	.pipe(concat('libs.js'))
	.pipe(gulp.dest('public/js'));

});

//script Task
//uglify main js
gulp.task('script', function(){
	gulp.src('main.js')
	.pipe(uglify())
	.pipe(gulp.dest('public/js'));

});

//cssLibs Task
//concat and uglify css libraries
gulp.task('cssLibs', function(){
	gulp.src([
		'bower_components/bootstrap/dist/css/bootstrap.css',
		'bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css',
		'public/css/fonts/registration.css'])
	.pipe(minify())
	.pipe(concat('libs.css'))
	.pipe(gulp.dest('public/css'));

});

//saas Task
//Updates main css when saas changes
gulp.task('sass', function(){
	return sass('public/scss/main.scss', { style: 'compressed' })
	.pipe(gulp.dest('public/css/'));
});


gulp.task('watch', function(){
	gulp.watch('public/scss/main.scss', ['sass']);
	gulp.watch('main.js', ['script']);
});


//Default Task
//gulp
gulp.task('default', ['scriptLibs','cssLibs', 'watch']);
