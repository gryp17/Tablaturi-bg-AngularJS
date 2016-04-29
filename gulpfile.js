"use strict";

var gulp = require("gulp");
var del = require("del");
var concat = require("gulp-concat");
var sass = require("gulp-sass");
var autoprefixer = require("gulp-autoprefixer");
var sourcemaps = require("gulp-sourcemaps");
var replace = require("gulp-replace");
var debug = require("gulp-debug");
var notify = require("gulp-notify");
var uglify = require("gulp-uglify");

var AutoPrefixerOptions = {
	browsers: ["> 10%", "last 3 versions"],
	cascade: false
};

var cssAppSource = "./static/stylesheets/scss/**/*.scss";
var cssDestination = "./static/stylesheets";
var jsAppSource = "./app/**/*.js";
var jsDestination = "./static/scripts";

//build-dev task
gulp.task("build-dev", function() {
	del([
		"./static/stylesheets/style.min.css",
		"./static/stylesheets/style.css.map"
	]);

	gulp.start("styles-min");
	gulp.start("move-icons");
	gulp.start("scripts");
	gulp.start("watch");
});

//styles task
gulp.task("styles-min", function() {
	return gulp.src([
		cssAppSource
	]).pipe(sass({
		precision: 4,
		outputStyle: "compressed",
		includePaths: [
			"./bower_components/bootstrap-sass/assets/stylesheets"
		]
	})
	.on('error', notify.onError(function (e) {
		return e;
	})))
	.pipe(autoprefixer(AutoPrefixerOptions))
	.pipe(concat("./style.min.css"))
	.pipe(replace("\n", ""))
	.pipe(gulp.dest(cssDestination));
});

//icons task
gulp.task('move-icons', function() {
	return gulp.src([
		'./bower_components/bootstrap-sass/assets/fonts/**/*',
	]).pipe(gulp.dest('static/fonts/'));
});

//scripts task
gulp.task('scripts', function() {
	return gulp.src([
		"./bower_components/jquery/dist/jquery.min.js",
		"./bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js",
		"./bower_components/angular/angular.min.js",
		"./bower_components/angular-route/angular-route.min.js",
		"./bower_components/angular-sanitize/angular-sanitize.min.js",
		jsAppSource
	])
		.pipe(concat('app.js'))
		.pipe(uglify({
			mangle: false
		}))
		.pipe(gulp.dest(jsDestination));
});

//watch task
gulp.task("watch", function() {
	gulp.watch(cssAppSource, ["styles-min"]);
	gulp.watch(jsAppSource, ["scripts"]);
});