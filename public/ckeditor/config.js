/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */


CKEDITOR.editorConfig = function( config ) {
  config.toolbar = [
    { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
    { name: 'editing', items: [ 'Find', 'Replace'] },  //, '-', 'SelectAll', '-', 'Scayt'
    //{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
    { name: 'document', items: ['Source', '-', 'Print', 'Maximize'] },
    '/',
    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
    { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-',
      'Outdent', 'Indent', '-',
      'Blockquote', '-', // 'CreateDiv', '-',
      'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'
      ] },
    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
    { name: 'insert', items: [ 'Image', 'Table', 'Iframe', 'Flash' ] }, //, 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'
    '/',
    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    { name: 'colors', items: [ 'TextColor', 'BGColor' ] }
  ];

  config.removeDialogTabs = 'image:advance;image:Link';
};
