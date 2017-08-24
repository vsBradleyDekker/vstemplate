'use strict';

const webpack = require('webpack');
const merge = require('webpack-merge');
const path = require('path');
const BundleTracker = require('webpack-bundle-tracker');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');

const outputDir = './public/';

const config = {
    context: __dirname,
    entry: {
        'main': './scripts/js/index'
    },

    output: {
        path: path.resolve(outputDir),
        filename: './js/scripts.js',
    },

    module: {
        rules: [
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({ fallback: 'style-loader', use: 'css-loader!sass-loader' })
            },
            {
                test: /\.css$/,
                use: ExtractTextPlugin.extract({ fallback: 'style-loader', use: 'css-loader'})
            },
            {
                test: /\.js$/,
                exclude: /(node_modules)/,
                use: {
                    loader: 'babel-loader',
                }
            },
            {
                test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
                use: 'file-loader?name=fonts/[name].[ext]&publicPath=../'
            }
        ],

    },


    plugins: [
        new CleanWebpackPlugin([outputDir + 'css', outputDir + 'js', outputDir + 'fonts'], {}),
        new BundleTracker({ filename: './webpack-stats.json' }),
        new ExtractTextPlugin('./css/styles.css'),
        new webpack.optimize.OccurrenceOrderPlugin(),
        //new webpack.optimize.UglifyJsPlugin(),
        new webpack.optimize.AggressiveMergingPlugin(),
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery"
        }),
    ]
}

module.exports = config;