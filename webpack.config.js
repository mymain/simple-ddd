const Encore = require('@symfony/webpack-encore');
const HtmlWebpackPlugin = require('html-webpack-plugin');

Encore
    .setOutputPath('public/')
    .setPublicPath('/')
    .enableSingleRuntimeChunk()
    .addEntry('main', './assets/js/index.ts')
    .enableVueLoader()
    .enableSassLoader(options => {
        options.implementation = require('sass');
    })
    .enableTypeScriptLoader(options => {
        options.appendTsSuffixTo = [/\.vue$/];
    })
    .addPlugin(new HtmlWebpackPlugin({
        template: './assets/index.html',
    }));

module.exports = Encore.getWebpackConfig();
