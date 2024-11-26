const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const WebpackConcatPlugin = require('webpack-concat-files-plugin');
const glob = require('glob');
const terser = require('terser');
const fs = require('fs');

const themeDir = 'wp-content/themes/silvi';

// Gather SCSS files, including block-based SCSS files
const scssFiles = [
  ...glob.sync(path.resolve(__dirname, themeDir, 'css/libs/**/*.scss')),
  ...glob.sync(path.resolve(__dirname, themeDir, 'css/global/**/*.scss'), {
    ignore: [
      // Exclude config and mixins from the list, these are imported manually
      path.resolve(__dirname, themeDir, 'css/global/_config.scss'),
      path.resolve(__dirname, themeDir, 'css/global/mixins.scss'),
    ],
  }),
  ...glob.sync(path.resolve(__dirname, themeDir, 'css/partials/**/*.scss')),
  ...glob.sync(path.resolve(__dirname, themeDir, 'css/modules/**/*.scss')),
  ...glob.sync(path.resolve(__dirname, themeDir, 'css/templates/**/*.scss')),
];

// General JS files to include and minify
const jsFiles = [
  ...glob.sync(path.resolve(__dirname, themeDir, 'js/libs/**/*.js')),
  ...glob.sync(path.resolve(__dirname, themeDir, 'js/development/**/*.js')),
];

module.exports = {
  mode: 'production',
  // Enable source maps for CSS
  devtool: 'source-map',
  entry: {
    styles: scssFiles, // Global SCSS files
  },
  output: {
    path: path.resolve(__dirname, themeDir),
    filename: 'js/[name].js', // Output JS files (will delete unnecessary styles.js)
  },
  module: {
    rules: [
      {
        test: /\.scss$/, // Process SCSS files
        use: [
          MiniCssExtractPlugin.loader, // Extract CSS into separate files
          {
            loader: 'css-loader',
            options: {
              sourceMap: true, // Enable source maps in css-loader
              url: false, // This disables URL resolution by css-loader
            },
          },
          {
            loader: 'postcss-loader', // Processes CSS with PostCSS plugins like autoprefixer
            options: {
              sourceMap: true, // Enable source maps in postcss-loader
              postcssOptions: {
                plugins: [
                  require('autoprefixer')({
                    overrideBrowserslist: [
                      '> 1%',
                      'last 4 versions',
                      'not ie <= 11',
                    ],
                    grid: true,
                  }),
                ],
              },
            },
          },
          {
            loader: 'sass-loader', // Compiles Sass to CSS
            options: {
              sourceMap: true, // Enable source maps in sass-loader
              additionalData: `
                @use '${path.resolve(
                  __dirname,
                  themeDir,
                  'css/global/_config.scss'
                )}' as *;
                @use '${path.resolve(
                  __dirname,
                  themeDir,
                  'css/global/mixins.scss'
                )}' as *;
              `, // Inject global SCSS variables and mixins into every file
            },
          },
        ],
      },
      {
        test: /\.js$/, // Process JS files
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader', // Transpile JS using Babel
          options: {
            presets: ['@babel/preset-env'],
          },
        },
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: ({ chunk }) => {
        // Output CSS to 'style.css' for global styles
        // Output <blockname>.css for block-specific styles
        if (chunk.name.startsWith('blocks/')) {
          const blockName = chunk.name.split('/')[1];
          return `blocks/${blockName}/${blockName}.css`;
        }
        return 'style.css';
      },
    }),

    new WebpackConcatPlugin({
      bundles: [
        {
          src: jsFiles, // All JS files (including block JS)
          dest: path.resolve(__dirname, themeDir, 'js/scripts.min.js'),
          transforms: {
            after: async (code) => {
              const result = await terser.minify(code); // Minify the concatenated JS
              return result.code;
            },
          },
        },
      ],
    }),

    // Custom plugin to delete the unnecessary js/styles.js files after build
    {
      apply: (compiler) => {
        compiler.hooks.done.tap('DeleteStylesJSPlugin', () => {
          const stylesJsFiles = [
            path.resolve(__dirname, themeDir, 'js/styles.js'),
          ];

          stylesJsFiles.forEach((filePath) => {
            if (fs.existsSync(filePath)) {
              fs.unlinkSync(filePath); // Delete the file if it exists
              console.log(`Deleted ${filePath}`);
            }
          });

          // Delete the entire 'js/blocks' directory and its contents using fs.rmSync
          const blocksDir = path.resolve(__dirname, themeDir, 'js/blocks');
          if (fs.existsSync(blocksDir)) {
            fs.rmSync(blocksDir, { recursive: true, force: true }); // Use rmSync instead of rmdirSync
            console.log(`Deleted ${blocksDir} and all its contents`);
          }
        });
      },
    },

    // Custom plugin to log file changes during watch mode
    {
      apply: (compiler) => {
        compiler.hooks.watchRun.tap('WatchRunPlugin', (compilation) => {
          if (compilation.modifiedFiles) {
            const changedFiles = Array.from(compilation.modifiedFiles);
            if (changedFiles.length > 0) {
              console.log('Detected file changes:', changedFiles);
            }
          } else {
            console.log('No file changes detected.');
          }
        });
      },
    },
  ],
  watchOptions: {
    ignored: [
      path.resolve(__dirname, themeDir, 'js/scripts.min.js'),
      path.resolve(__dirname, themeDir, 'js/scripts.js'),
      path.resolve(__dirname, themeDir, 'js/styles.js'),
      path.resolve(__dirname, themeDir, 'js/styles.js.map'),
    ],
  },
  optimization: {
    minimize: false, // JS minification is handled manually in WebpackConcatPlugin
  },
};
