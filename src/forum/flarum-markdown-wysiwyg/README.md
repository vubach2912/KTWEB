# Markdown WYSIWYG for Flarum

A [Flarum](http://flarum.org) extension that enables a WYSIWYG editing experience for posts. It replaces the built-in Markdown editor with a build of [CKEditor 5](https://github.com/ckeditor/ckeditor5), configured to output pure Markdown. Due to working directly with Markdown source, it is possible to seamlessly switch between it and the original editor without losing any formatting.

As this is a very early version, I suggest you read the Notes section below before using it.

### Installation

Currently, there is no build published on [Packagist](https://packagist.org), so you will have to build and it from source. Running the following in your forum's installation directory should do the trick:

```bash
git clone "https://github.com/franga2000/flarum-markdown-wysiwyg"
composer config "repositories.markdown-wysiwyg" path "flarum-markdown-wysiwyg"
composer require franga2000/flarum-markdown-wysiwyg
cd "flarum-markdown-wysiwyg/js"
npm install && npm run build # Run this any time you pull new source code
```

Make sure to disable the built-in Markdown editor or any other extension that provides an editing interface, then simply enable the extension in the admin panel.

### Notes

All post content is stored in Markdown format, just as it would be if you were using the official Markdown extension, so migrating back to it or in fact any other Markdown-based editor is simply a matter of disabling this extension and enabling the other one. This means that any **extensions that work directly on the content** and don't rely customizing the editor (like Mentions) **will work**.

Since CKEditor 5 **doesn't support Internet Explorer 11**, neither does this plugin, so keep that in mind. In its current state, it is possible that IE11 users **may not be able to access the forum at all**. Graceful degradation to a plain text field may be implemented in the future, but is not yet.

Regarding compatibility with other **extensions that modify the composer** (Emojis, Mentions, etc.): nothing is likely to break, but **those modifications will not work**. I'm looking into improving compatibility with those, but this will take time and cooperation from all sides.

**Images** can currently only be inserted from a URL. Support for uploading images is planned, but not implemented yet.

**Styling** is currently only partially matched. The editor follows the forum color scheme, but the **content will look slightly different in the editor** compared to the final rendered post (blockquotes and code blocks are currently the most obvious). This will be fixed soon.

**Languages** other than English are currently not supported, but support is planned in the future. Translations do exist, so it is possible to build the extensions with a different language by simply replacing the hard-coded language code (search for `'en'` in this repo).
