/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    // config.extraPlugins = 'syntaxhighlight';
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for a single toolbar row.
	config.toolbarGroups = [
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'forms' },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'tools' },
		{ name: 'others' },
		{ name: 'about' }
	];

	// The default plugins included in the basic setup define some buttons that
	// are not needed in a basic editor. They are removed here.
	// config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Underline,Strike,Subscript,Superscript';

	// Dialog windows are also simplified.
	// config.extraPlugins = "syntaxhighlight";

	config.extraPlugins = "lineutils,widget,codesnippetgeshi,prism,syntaxhighlight";

	config.removeDialogTabs = 'link:advanced';

	config.codeSnippet_theme = 'monokai_sublime';

	// config.codeSnippet_languages = {
	// 	text: 'Text only',
	// 	html: 'HTML',
	// 	javascript: 'JavaScript',
 //    	php: 'PHP',
 //    	xml: 'XML'
	// 	http: 'HTTP',
 //    	c: 'C',
	// 	csharp: 'C#',
	// 	cpp: 'C++',
 //    };
};
