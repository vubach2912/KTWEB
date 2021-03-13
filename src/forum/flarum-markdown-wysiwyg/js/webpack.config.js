const fs = require('fs');
const path = require('path');
const webpack = require('webpack');

const { bundler, styles } = require('@ckeditor/ckeditor5-dev-utils');
const CKEditorWebpackPlugin = require('@ckeditor/ckeditor5-dev-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');

module.exports = function (options = {}) {
	return {
		mode: 'production',

		// Set up entry points for each of the forum + admin apps, but only
		// if they exist.
		entry: function () {
			const entries = {};

			for (const app of ['forum', 'admin']) {
				const file = path.resolve(process.cwd(), app + '.js');
				if (fs.existsSync(file)) {
					entries[app] = file;
				}
			}

			return entries;
		}(),

		optimization: {
			minimizer: [
				new TerserPlugin( {
					sourceMap: true,
					terserOptions: {
						output: {
							// Preserve CKEditor 5 license comments.
							comments: /^!/
						}
					},
					extractComments: false
				} )
			]
		},

		module: {
			rules: [
				{
					test: /\.svg$/,
					use: ['raw-loader']
				},
				{
					test: /\.css$/,
					use: [
						{
							loader: 'style-loader',
							options: {
								injectType: 'singletonStyleTag',
								attributes: {
									'data-cke': true
								}
							}
						},
						{
							loader: 'postcss-loader',
							options: styles.getPostCssConfig({
								themeImporter: {
									themePath: require.resolve('@ckeditor/ckeditor5-theme-lark')
								},
								minify: true
							})
						},
					]
				}

			]
		},

		plugins: [
			new CKEditorWebpackPlugin({
				language: 'en',
				// TODO: Language support
				// additionalLanguages: 'all'
			}),
			new webpack.BannerPlugin({
				banner: bundler.getLicenseBanner(),
				raw: true
			})
		],

		output: {
			path: path.resolve(process.cwd(), 'dist'),
			library: 'module.exports',
			libraryTarget: 'assign',
			devtoolNamespace: require(path.resolve(process.cwd(), 'package.json')).name
		},

		externals: [
			{
				'@flarum/core/forum': 'flarum.core',
				'@flarum/core/admin': 'flarum.core',
				'jquery': 'jQuery',
			},

			function () {
				const externals = {};

				if (options.useExtensions) {
					for (const extension of options.useExtensions) {
						externals['@' + extension] =
							externals['@' + extension + '/forum'] =
							externals['@' + extension + '/admin'] = "flarum.extensions['" + extension + "']";
					}
				}

				return externals;
			}(),

			// Support importing old-style core modules.
			function (context, request, callback) {
				let matches;
				if ((matches = /^flarum\/(.+)$/.exec(request))) {
					return callback(null, 'root flarum.core.compat[\'' + matches[1] + '\']');
				}
				callback();
			}
		],

		devtool: 'source-map'
	};
};
