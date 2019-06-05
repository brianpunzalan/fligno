const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const rootPath = path.join(__dirname, '../app');

module.exports = {
  context: rootPath,
  entry: {
    js: ['babel-polyfill', './index.js'],
  },
  resolve: {
    extensions: ['.js'],
    modules: [rootPath, 'node_modules'],
  },
  output: {
    path: path.join(__dirname, '../build'),
    publicPath: '/',
    filename: process.env.NODE_ENV === 'production' ? 'bundle.[contenthash].js' : 'bundle.[hash].js',
    sourceMapFilename: 'map',
  },
  module: {
    rules: [
      {
        test: /\.(png|svg|jpg|gif)$/,
        use: ['file-loader'],
      },
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        loaders: ['babel-loader'],
      },
      {
        test: /\.js?$/,
        exclude: /node_modules/,
        enforce: 'pre',
        use: 'eslint-loader',
      },
      {
        test: /(\.css$)|(\.sass$)|(\.scss$)/,
        exclude: /node_modules|\.tpl\./,
        use: [
          process.env.NODE_ENV !== 'production' ? 'style-loader' : MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {
              modules: true,
              importLoaders: 1,
              localIdentName: '[name]__[local]',
              minimize: { safe: true },
            },
          },
          {
            loader: 'postcss-loader',
            options: {
              config: {
                path: path.resolve(__dirname, './postcss.config.js'),
              },
            },
          },
        ],
      },
    ],
  },
};
