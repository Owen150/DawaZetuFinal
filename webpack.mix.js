const mix = require('laravel-mix');
// let RtlCssPlugin = require('rtlcss-webpack-plugin');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .sourceMaps(true, 'source-map')
  .webpackConfig({
    plugins: [
      // new RtlCssPlugin()
    ]
  })
  .browserSync({
    proxy: '127.0.0.1:8000',
    port: 3100,
    ghostMode: false,
    notify: false
  })



  /*
  |--------------------------------------------------------------------------
  | Copy 3rd party plugin files to public folder
  |--------------------------------------------------------------------------
  */

  // Feather icons
  .copyDirectory('node_modules/feather-icons/dist', 'public/assets/plugins/feather-icons')
  
  // Mdi icons
  .copyDirectory('node_modules/@mdi/font', 'public/assets/plugins/@mdi')

  // Perfect scrollbar
  .copyDirectory(['node_modules/perfect-scrollbar/dist', 'node_modules/perfect-scrollbar/css'] , 
    'public/assets/plugins/perfect-scrollbar')

  // PrimsJs
  .copyDirectory(['node_modules/prismjs/prism.js', 'node_modules/prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.min.js', 'node_modules/prismjs/themes/prism.css'] , 
    'public/assets/plugins/prismjs')

  // Clipboard
  .copyDirectory('node_modules/clipboard/dist/clipboard.min.js', 'public/assets/plugins/clipboard')

  // Cropper
  .copyDirectory(['node_modules/cropperjs/dist/cropper.min.js', 'node_modules/cropperjs/dist/cropper.min.css'] , 
    'public/assets/plugins/cropperjs')

  // Owl carousel
  .copyDirectory('node_modules/owl.carousel/dist', 'public/assets/plugins/owl-carousel')

  // Jquery mousewheel
  .copyDirectory('node_modules/jquery-mousewheel/jquery.mousewheel.js', 'public/assets/plugins/jquery-mousewheel')

  // Animate.css
  .copyDirectory('node_modules/animate.css/animate.min.css', 'public/assets/plugins/animate-css')

  // SortableJs
  .copyDirectory('node_modules/sortablejs/Sortable.min.js', 'public/assets/plugins/sortablejs')

  // SweetAlert2
  .copyDirectory(['node_modules/sweetalert2/dist/sweetalert2.min.js', 'node_modules/sweetalert2/dist/sweetalert2.min.css'] , 
    'public/assets/plugins/sweetalert2')

  // ChartJs
  .copyDirectory('node_modules/chart.js/dist/chart.umd.js', 'public/assets/plugins/chartjs')

  // Jquery flot
  .copyDirectory('node_modules/jquery.flot', 'public/assets/plugins/jquery.flot')
  
  // Apexcharts
  .copyDirectory('node_modules/apexcharts/dist/apexcharts.min.js', 'public/assets/plugins/apexcharts')

  // Peity
  .copyDirectory('node_modules/peity/jquery.peity.min.js', 'public/assets/plugins/peity')

  // Jquery sparkline
  .copyDirectory('node_modules/jquery-sparkline/jquery.sparkline.min.js', 'public/assets/plugins/jquery-sparkline')

  // datatables
  .copyDirectory('node_modules/datatables.net/js/jquery.dataTables.js', 'public/assets/plugins/datatables-net')

  // Datatables.net-bs5
  .copyDirectory(['node_modules/datatables.net-bs5/js/dataTables.bootstrap5.js', 'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.css'], 
  'public/assets/plugins/datatables-net-bs5')

  // Select2
  // .copyDirectory('node_modules/select2/dist', 'public/assets/plugins/select2')
  .copyDirectory(['node_modules/select2/dist/js/select2.min.js', 'node_modules/select2/dist/css/select2.min.css'] , 
    'public/assets/plugins/select2')

  // Easymde
  .copyDirectory(['node_modules/easymde/dist/easymde.min.js', 'node_modules/easymde/dist/easymde.min.css'] , 
    'public/assets/plugins/easymde')

  // Jquery tags input
  .copyDirectory('node_modules/jquery-tags-input/dist', 'public/assets/plugins/jquery-tags-input')

  // Dropzone
  .copyDirectory(['node_modules/dropzone/dist/min/dropzone.min.js', 'node_modules/dropzone/dist/min/dropzone.min.css'] , 
    'public/assets/plugins/dropzone')

  // Dropify
  .copyDirectory('node_modules/dropify/dist', 'public/assets/plugins/dropify')

  // Color picker
  .copyDirectory('node_modules/@simonwep/pickr/dist', 'public/assets/plugins/pickr')

  // FlatPickr
  .copyDirectory(['node_modules/flatpickr/dist/flatpickr.min.js', 'node_modules/flatpickr/dist/flatpickr.min.css'] , 
    'public/assets/plugins/flatpickr')

  // Jquery validation
  .copyDirectory('node_modules/jquery-validation/dist/jquery.validate.min.js', 'public/assets/plugins/jquery-validation')

  // Bootstrap maxlength
  .copyDirectory('node_modules/bootstrap-maxlength/dist/bootstrap-maxlength.min.js', 'public/assets/plugins/bootstrap-maxlength')

  // Inputmask
  .copyDirectory('node_modules/inputmask/dist/jquery.inputmask.min.js', 'public/assets/plugins/inputmask')

  // Typeahead.js
  .copyDirectory('node_modules/typeahead.js/dist/typeahead.bundle.min.js', 'public/assets/plugins/typeahead-js')

  // Tinymce
  .copyDirectory('node_modules/tinymce', 'public/assets/plugins/tinymce')

  // Ace editor
  .copyDirectory('node_modules/ace-builds/src-min', 'public/assets/plugins/ace-builds')

  // Jquery steps
  .copyDirectory(['node_modules/jquery-steps/build/jquery.steps.min.js', 'node_modules/jquery-steps/demo/css/jquery.steps.css'] , 
    'public/assets/plugins/jquery-steps')

  // Fullcalendar
  .copyDirectory('node_modules/fullcalendar/index.global.min.js', 'public/assets/plugins/fullcalendar')

  // Moment
  .copyDirectory('node_modules/moment/min/moment.min.js', 'public/assets/plugins/moment')
