module.exports = {
  verbose: true,
  moduleNameMapper: {
    '^app/(.*)': '<rootDir>/../app/$1',
    '\\.(jpg|jpeg|png|gif|eot|otf|webp|svg|ttf|woff|woff2|mp4|webm|wav|mp3|m4a|aac|oga)$': '<rootDir>/assetsStubber.js',
    '\\.(css|scss|sass)$': 'identity-obj-proxy',
  },
  setupTestFrameworkScriptFile: '<rootDir>/setup.js',
};
