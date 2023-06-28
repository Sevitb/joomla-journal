const { src, dest, watch } = require('gulp');
const compileSass = require('gulp-sass')(require('sass'));
const minifyCss = require('gulp-clean-css');
const sourceMaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const rename = require('gulp-rename');
const autoprefixer = require('gulp-autoprefixer');
const argv = require('yargs').argv;
const log = require("fancy-log");

const componentPage = argv.page ? argv.page : '*',
    componentSrcGlob = `media/${argv.component}/scss/pages/${componentPage}-page/${componentPage}-page.scss`,
    componentDestGlob = `media/${argv.component}/css`,
    componentWatchGlob = `media/${argv.component}/scss/**/*.scss`;

const moduleSrcGlob = `media/${argv.module}/scss/*.scss`,
    moduleDestGlob = `media/${argv.module}/css`,
    moduleWatchGlob = `media/${argv.module}/scss/**/*.scss`;

const layoutScrGlob = `media/layouts/scss/journal/${argv.componentLayout}/${argv.layout}/*.scss`,
    layoutDestGlob = `media/layouts/css/journal/${argv.componentLayout}/${argv.layout}`,
    layoutWatchGlob = `media/layouts/scss/journal/${argv.componentLayout}/${argv.layout}/*.scss`;

const templateSrcGlob = `media/templates/site/journal/scss/template.scss`,
    templateDestGlob = `media/templates/site/journal/css`,
    templateWatchGlob = `media/templates/site/journal/**/*.scss`;

const srcGlob = argv.component ? componentSrcGlob :
    (argv.module ? moduleSrcGlob :
        (argv.template ? templateSrcGlob :
            (argv.layout ? layoutScrGlob : ''))),
    destGlob = argv.component ? componentDestGlob :
        (argv.module ? moduleDestGlob :
            (argv.template ? templateDestGlob :
                (argv.layout ? layoutDestGlob : ''))),
    watchGlob = argv.component ? componentWatchGlob :
        (argv.module ? moduleWatchGlob :
            (argv.template ? templateWatchGlob : 
                (argv.layout ? layoutWatchGlob : '')));

function bundleSassCMTL(cb) {
    return src(
        [
            srcGlob,
        ],)
        .pipe(sourceMaps.init())
        .on("end", () => {
            log("Sourcemap Complete...");
        })
        .pipe(compileSass().on('error', compileSass.logError))
        .on('end', () => {
            log("SASS Compiled...")
        })
        .pipe(autoprefixer())
        .on("end", () => {
            log("Prefixes have been added...");
        })
        .pipe(minifyCss())
        .on("end", () => {
            log("CSS Minified...");
        })
        .pipe(sourceMaps.write())
        .pipe(rename(path => {
            path.dirname = "";
            path.basename;
        }))
        .pipe(dest(destGlob));
}


function bundleSassL(cb) {

}


function devWatch() {
    console.log(srcGlob);
    console.log(destGlob);
    console.log(watchGlob);
    watch(watchGlob, bundleSassCMTL);
}

function defaultTask(cb) {
    // place code for your default task here
    cb();
}

exports.bundleSassCMTL = bundleSassCMTL;
exports.devWatch = devWatch;
exports.default = defaultTask;