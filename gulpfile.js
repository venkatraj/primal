var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');   
var autoprefixer = require('gulp-autoprefixer');
var uglify = require('gulp-uglify');
var imagemin = require('gulp-imagemin');
var cssnano = require('gulp-cssnano');   
var rename = require('gulp-rename'); 
var cache = require('gulp-cache');
var del = require('del');
var wpPot = require('gulp-wp-pot'); // For generating the .pot file.
var sort = require('gulp-sort'); // Recommended to prevent unnecessary changes in pot-file.  
var zip = require('gulp-zip'); 
var rtlcss = require('gulp-rtlcss'); // RTL Support  
var stripCssComments = require('gulp-strip-css-comments'); //remove comments in css file
var plumber = require('gulp-plumber'); //sass error(if sass error occurs start Gulp again to continue working. )
var gutil = require('gulp-util');  //(add color & beep)add beep sound once the error occurred, plus adding colors to the error message which is useful identifying the error.   
var browserSync = require('browser-sync').create(); // automatic browser sync 
var reload = browserSync.reload; 
   
 
/* zip file */
gulp.task('zip', function () { 
  return gulp.src(['./**','!./{node_modules,node_modules/**}','!./{dist,dist/**}','!./{sass,sass/**}','!./{.git,.git/**}','!gulpfile.js','!package.json','!package-lock.json','!.gitignore'])
    .pipe(zip('primal.zip')) 
    .pipe(gulp.dest('./dist'));  
}); 
        
    
/* Translate .pot file */ 
gulp.task( 'translate', function () {   
     return gulp.src( './**/*.php')
       .pipe(sort())
       .pipe(wpPot( {
           domain        : 'primal',
           destFile      : 'primal.pot',
           package       : 'primal'
       } ))
      .pipe(gulp.dest('languages/primal.pot'))
});  

/* RTL Support */
gulp.task('rtl', ['styles'], function () { 
    return gulp.src('style.css')
      .pipe(rtlcss())  
      .pipe(rename({  basename: "rtl" })) // Base(file) name "rtl" 
      .pipe(stripCssComments())
      .pipe(gulp.dest(''));  
});   
    
/* //Script task
gulp.task('scripts',function(){  
   gulp.src('dist/js/*.js')
   //.pipe(concat('all.min.js'))
   .pipe(uglify())
   .pipe(gulp.dest('js'));   
});  */


  
//styles task
gulp.task('styles',function(){  
    gulp.src(['sass/**/*.scss'])
   .pipe(sass())  
   .pipe(autoprefixer())
   .pipe(gulp.dest(''));      
}); 
   
// Optimizing Images   
gulp.task('images', function() {
   gulp.src('dist/images/**/*.+(png|jpg|jpeg|gif|svg)')
    // Caching images that ran through imagemin
    .pipe(cache(imagemin({      
      interlaced: true, 
    })))  
    .pipe(gulp.dest('images'));  
});
     


// Clean
gulp.task('clean', function() {
  return del(['images','languages/tech-literacy.pot','rtl.css']);      
}); 


// Default task
gulp.task('default',['clean'] , function() {
  gulp.start('styles', 'images', 'translate','rtl');
});   


//watch task
gulp.task('watch',function(){  
   gulp.watch('sass/**/*.scss',['styles','rtl']);    
   gulp.watch('dist/images/**/*.+(png|jpg|jpeg|gif|svg)',['images']);
});




