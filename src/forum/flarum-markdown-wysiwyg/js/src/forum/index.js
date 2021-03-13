import { extend } from 'flarum/extend';
import TextEditor from 'flarum/components/TextEditor';

import MarkdownEditor from './ckeditor';

app.initializers.add('flarum-markdown', function (app) {
	let index = 1;

	extend(TextEditor.prototype, 'oninit', function () {
		this.textareaId = 'textarea' + (index++);
	});

	extend(TextEditor.prototype, 'view', function (vdom) {
		vdom.children[0].attrs.id = this.textareaId;
	});

	extend(TextEditor.prototype, 'oncreate', function () {
		let textArea = this.$('textarea')[0];
		textArea.classList.remove("Composer-flexible");

		// Put the current context in a variable
		let state = this;
		MarkdownEditor
			.create(textArea)
			.then(editor => {
				state.editor = editor;

				// Make sure it gets resized along with the composer "window"
				editor.ui.element.classList.add("Composer-flexible");

				// TODO: Find out what is stealing the focus
				setTimeout(() => editor.ui.getEditableElement().focus(), 100);


				// Update the textarea when content changes
				editor.model.document.on('change:data', () => {
					// TODO: can we use this event to trick some extensions into working?
					state.oninput(editor.getData(), {});
				});

			})
	});

	extend(TextEditor.prototype, 'onremove', function () {
		this.editor.destroy();
	});
});
