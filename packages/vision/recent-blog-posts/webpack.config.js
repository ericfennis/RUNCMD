module.exports = [

    {
        entry: {
            'widget-rbp': './app/components/widget-rbp.vue'
        },
        output: {
            filename: './app/bundle/[name].js'
        },
        externals: {
            'lodash': '_',
            'jquery': 'jQuery',
            'uikit': 'UIkit',
            'vue': 'Vue'
        },        
        module: {
            loaders: [
                { test: /\.vue$/, loader: 'vue' }
            ]
        }
    }

];
