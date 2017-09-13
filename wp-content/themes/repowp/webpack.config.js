module.exports =

{   entry: "./modules/js/main.js",

    output: {
        path: "./assets/js",
        filename: "main.js"
    },

    module: {

        loaders: [{
            test: /\.jsx?$/,
            exclude: /(node_modules|bower_components)/,
            loader: 'babel',
            query: {
                compact: false,
            },
        },{
            test: /\.modernizrrc$/,
            loader: "modernizr"
        }]
	}
}