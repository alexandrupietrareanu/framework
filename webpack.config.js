// webpack.config.js
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const path = require('path');

module.exports = {
    entry: './assets/scss/app.scss',
    output: {
        // The JS file isn’t our main asset here, but we need to output something.
        path: path.resolve(__dirname, 'public/assets'),
        filename: 'bundle.js',
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader, // extracts CSS to a file
                    'css-loader',                // translates CSS into CommonJS
                    'sass-loader'                // compiles Sass to CSS
                ],
            },
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'app.css',
        }),
    ],
    mode: 'development' // or 'production'
};
