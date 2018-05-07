//define gulp and other packages
const gulp = require("gulp");
const runSequence = require("run-sequence");
const sass = require("gulp-sass");
const autoprefixer = require("gulp-autoprefixer");
const cssnano = require("gulp-cssnano");
const size = require("gulp-size");
const uglify = require("gulp-uglify");
const concat = require("gulp-concat");

//supported browsers for autoprefixer
const supportedBrowsers = [">0.5%"];
//compile scss style
gulp.task("styles", function() {
   return gulp.src("assets/css/main.scss")
       .pipe(sass().on("error",sass.logError))
       .pipe(autoprefixer({
           browsers: supportedBrowsers, grid: true
       }))
       .pipe(cssnano())
       .pipe(gulp.dest("www/css"))
       .pipe(size({ title: "Style file size:"}))
});

//compile javascripts
gulp.task("scripts", function() {
   return gulp.src(["assets/js/**/*.js","node_modules/bootstrap/dist/js/bootstrap.js"])
       .pipe(concat("main.js"))
       .pipe(uglify())
       .pipe(gulp.dest("www/js"))
});

gulp.task("default", function() {
   runSequence("styles","scripts");
   // runSequence("styles");
});

// Watch Files For Changes & Reload
gulp.task('serve', function (cb){
    runSequence('styles','scripts', cb);
    // runSequence('styles', cb);
    gulp.watch(['assets/css/**/*.scss'], ['styles']);
    gulp.watch(['assets/js/**/*.js'], ['scripts']);
    // gulp.watch(['assets/front/css/**/*.css'], ['styles','manifest']);
    // gulp.watch(['assets/front/js/*.js', 'public/asset/js/**/*.js'], ['scripts','manifest']);
});