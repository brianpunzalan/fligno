const path = require('path');
const merge = require('webpack-merge');
const webpack = require('webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const Dotenv = require('dotenv-webpack');
const common = require('./webpack.common');

const rootPath = path.join(__dirname, '../app');

module.exports = merge(common, {
  mode: 'production',
  output: {
    path: path.join(__dirname, '../build'),
    publicPath: '/',
    filename: 'bundle.[contenthash].js',
    sourceMapFilename: 'map',
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
    new CleanWebpackPlugin(),
    new Dotenv({
      path: './.env.development',
    }),
  ],
});
