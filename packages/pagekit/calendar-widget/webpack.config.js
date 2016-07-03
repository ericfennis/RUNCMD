module.exports = [

    {
        entry: {
            'widget-calendar': './app/components/widget-calendar.vue'
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
