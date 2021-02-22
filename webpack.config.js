const path = require('path');

module.exports = {
    resolve: {
        extensions: ['.js', '.vue'],
        alias: {
            '@src': path.resolve('resources/js'),
            '@test': path.resolve('tests/Javascript')
        }
    },
}
