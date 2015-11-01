var gulp    = require('gulp');
var clean   = require('gulp-clean');

gulp.task(
    'build-dev',
    [
        'copy'
    ]
);
gulp.task(
    'build',
    [
        'copy',
        'clean'
    ]
);
gulp.task(
    'copy',
    [
        'copy-semantic',
        'copy-jquery',
        'copy-lodash'
    ]
);
gulp.task(
    'clean',
    [
        'clean-bower',
        'clean-node',
        'clean-tmp',
        'clean-cache',
        'clean-fotos'
    ]
);

gulp.task('copy-semantic', function () {
    return gulp.src(
        'bower_components/semantic-ui/dist/**'
    ).pipe(
        gulp.dest('www/assets/semantic')
    );
});

gulp.task('copy-jquery', function () {
    return gulp.src(
        'bower_components/jquery/dist/jquery.js'
    ).pipe(
        gulp.dest('www/assets/js')
    );
});

gulp.task('copy-lodash', function () {
    return gulp.src(
        'bower_components/lodash/lodash.js'
    ).pipe(
        gulp.dest('www/assets/js')
    );
});

gulp.task('clean-bower', ['copy'], function () {
    return gulp.src(
        'bower_components'
    ).pipe(
        clean()
    );
});

gulp.task('clean-node', ['copy'], function () {
    return gulp.src(
        'node_modules'
    ).pipe(
        clean()
    );
});

gulp.task('clean-tmp', ['copy'], function () {
    return gulp.src(
        'tmp/*'
    ).pipe(
        clean()
    );
});

gulp.task('clean-cache', ['copy'], function () {
    return gulp.src(
        'var/cache/*'
    ).pipe(
        clean()
    );
});

gulp.task('clean-fotos', ['copy'], function () {
    return gulp.src(
        'www/fotos/*'
    ).pipe(
        clean()
    );
});
