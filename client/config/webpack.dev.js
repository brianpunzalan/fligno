const path = require('path');
const merge = require('webpack-merge');
const webpack = require('webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const Dotenv = require('dotenv-webpack');
const common = require('./webpack.common');

const rootPath = path.join(__dirname, '../app');

module.exports = merge(common, {
  mode: 'development',
  devtool: 'cheap-module-source-map',
  output: {
    path: path.join(__dirname, '../app'),
    publicPath: '/',
    filename: 'bundle.[hash].js',
    sourceMapFilename: 'map',
  },
  devServer: {
    hot: true,
    host: 'localhost',
    contentBase: path.join(__dirname, '../app'),
    noInfo: false,
    historyApiFallback: true,
    publicPath: '/',
    port: 3000,
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '[name].css',
      chunkFilename: '[id].css',
    }),
    new HtmlWebpackPlugin({
      hash: true,
      template: path.resolve(rootPath, './index.html'),
    }),
    new webpack.HashedModuleIdsPlugin(),
    new Dotenv({
      path: '../.env.development',
    }),
  ],
});
