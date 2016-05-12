module.exports = [

    {
        entry: {
            "node-theme": "./app/components/node-theme.vue"


      },
      output: {
          filename: "./app/bundle/[name].js"
      },
      module: {
          loaders: [
              { test: /\.vue$/, loader: "vue" }
          ]
      }
  }

];
