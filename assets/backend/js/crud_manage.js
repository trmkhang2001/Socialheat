var tinymceRun ={
  init:function () {
    tinyMCE.init({
      selector: 'textarea.tinymce',
      height: 300,
      entity_encoding : "raw",
      relative_urls: false,
      theme: "modern",
      inline_styles : true, image_advtab: true ,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu  code colorpicker textcolor responsivefilemanager',
        'powerpaste'

      ],
      toolbar: 'paste | insertfile undo redo | styleselect | bold italic | forecolor | backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | link  image fullscreen',
      powerpaste_allow_local_images: true,
      powerpaste_word_import: 'merge',
      powerpaste_html_import: 'merge',
      external_filemanager_path: "/filemanager/",
      filemanager_title:"Browse file" ,
      external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
      filemanager_access_key: 'f970ce5bc016b5c5ca08e2e39c2cc937&foldr=',
    });
  }
} ;
jQuery(document).ready(function($) {
  tinymceRun.init();
  var tinymceSmall = tinyMCE.init({
    selector: 'textarea.tinymce_small',
    height: 150,
    entity_encoding : "raw",
    relative_urls: false,
    theme: "modern",
    inline_styles : true, image_advtab: true ,
    plugins: [
      'advlist autolink lists link image charmap print preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table contextmenu  code colorpicker textcolor responsivefilemanager',
      'powerpaste'

    ],
    toolbar: 'insertfile undo redo | styleselect | bold italic | forecolor | backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | link  fullscreen',
    powerpaste_allow_local_images: true,
    powerpaste_word_import: 'merge',
    powerpaste_html_import: 'merge',
    content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tiny.cloud/css/codepen.min.css'
    ],
    external_filemanager_path: "/filemanager/",
    filemanager_title:"Browse file" ,
    external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
    filemanager_access_key: 'f970ce5bc016b5c5ca08e2e39c2cc937&foldr=',

  });

});